<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Tools\Converter;
use Illuminate\Support\Facades\Crypt;
use App\Traits\NotificationTrait;
use App\Traits\{OrderTrait, Payment};
use App\Models\{Order, Feedback, Dispute, DisputeMessage};

class OrderController extends Controller
{
    use Payment, OrderTrait, NotificationTrait;

    /**
     * Checks if the authenticated user is allowed or not to view the purchase
     * @param  Order  $order
     *
     * @return \Illuminate\Http\Response
     */
    private function checkOrder(Order $order)
    {
        if (Gate::denies('order', $order)) {
            return abort(404);
        }
    }

    /**
     * Check if user can access order feedback
     * @param  Feedback $feedback
     *
     * @return \Illuminate\Http\Response
     */
    private function checkFeedback(Feedback $feedback)
    {
        if (Gate::denies('feedback', $feedback)) {
            return abort(404);
        }
    }

    /**
     * Order view
     * @param  Order $order
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewOrder(Order $order)
    {
        if ($order->paidOrder() and $order->status == 'waiting') {
            $order->status = 'purchased';
            $order->save();

            $buyername = $order->buyer->username;
            $this->createNotification(
                $order->seller->id,
                $buyername .
                    ' just placed an order with you <strong>#' .
                    $order->id .
                    '</strong>)',
                Route('sale', ['order' => $order->id])
            );
        }

        $this->checkOrder($order);

        // if ($order->disputed()) {
        //     $disputeMessages = $order->dispute->messages();
        // }

        // if ($order->delivered()) {
        //     $feedback = $order->feedback;
        // }

        return view('user.orderdetails', [
            'order' => $order,
            'totalSent' => \Monerod::getTotalReceived(
                $order->escrow_monero_wallet
            ),
            'toPay' => number_format($order->total_in_monero, 5),
            'user' => $order->buyer,
            // 'feedback' => isset($feedback) ? $feedback : null,
            // 'messages' => isset($disputeMessages) ? $disputeMessages : null,
        ]);
    }

    /**
     * Change the current status of the order to the next stage
     * @param  Order $order
     * @param  $status
     *
     * @return App\Traits\Order
     */
    public function postChangeOrderStatus(Order $order, $status)
    {
        $this->checkOrder($order);

        try {
            if ($status === $order->status) {
                throw new \Exception('The dispute is already in this status!');
            }

            if (
                $order->isSeller() &&
                $order->waiting() &&
                $status === 'accepted'
            ) {
                $this->markAsAccepted($order);
            } elseif (
                $order->isSeller() &&
                $order->purchased() &&
                $status === 'accepted'
            ) {
                $this->markAsAccepted($order);
            } elseif (
                $order->isSeller() &&
                $order->accepted() &&
                $status === 'shipped'
            ) {
                $this->markAsShipped($order);
            } elseif (
                $order->isBuyer() &&
                $order->shipped() &&
                $status === 'delivered'
            ) {
                $this->markAsDelivered($order);
            } elseif (
                ($order->waiting() ||
                    $order->purchased() ||
                    $order->accepted()) &&
                $status === 'canceled'
            ) {
                $this->markAsCanceled($order);
            } elseif (
                !$order->waiting() &&
                !$order->canceled() &&
                $status === 'disputed'
            ) {
                $this->markAsDisputed($order);
            } else {
                throw new \Exception('Oops.. There was an error, try again!');
            }

            session()->flash(
                'success',
                "Order status changed to successfully $status!"
            );
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
        if (
            auth()
                ->user()
                ->isSeller()
        ) {
            return redirect()->route('sale', ['order' => $order->id]);
        } else {
            return redirect()->route('order', ['order' => $order->id]);
        }
    }

    /**
     * Feedback HTTP request
     * @param  Feedback $feedback
     * @param  Request  $request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function postFeedback(Request $request, Order $order)
    {
        $request->validate([
            'products' => 'required|numeric|min:1|max:5',
            'shipping' => 'required|numeric|min:1|max:5',
            'community' => 'required|numeric|min:1|max:5',
            'feedback' => 'required|max:1000',
        ]);

        try {
            $feedback = new Feedback();
            $feedback->order_id = $order->id;
            $feedback->product_id = $order->product->id;
            $feedback->seller_id = $order->seller->id;
            $feedback->buyer_id = $order->buyer->id;
            $feedback->community = $request->community;
            $feedback->products = $request->products;
            $feedback->shipping = $request->shipping;
            $rating =
                ($request->products +
                    $request->shipping +
                    $request->community) /
                3;
            $feedback->rating = $rating;
            if ($rating >= 4) {
                $feedback->type = 'positive';
            } elseif ($rating >= 3) {
                $feedback->type = 'neutral';
            } else {
                $feedback->type = 'negative';
            }
            $feedback->message = $request->feedback;
            $feedback->save();

            $this->checkFeedback($feedback);
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        $this->markAsDelivered($order);

        session()->flash(
            'success',
            'Your feedback has been sent successfully!'
        );
        return redirect()->route('order', [
            'order' => $feedback->order->id,
        ]);
    }

    /**
     * Create dispute message
     * @param  Dispute $dispute
     * @param  Request $request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function viewDispute(Order $order)
    {
        return view('user.dispute-message', [
            'order' => $order,
            'totalSent' => \Monerod::getTotalReceived(
                $order->escrow_monero_wallet
            ),
            'toPay' => number_format($order->total_in_monero, 5),
        ]);
    }

    public function postCreateDisputeMessage(Dispute $dispute, Request $request)
    {
        $this->checkOrder($dispute->order);

        try {
            $request->validate([
                'message' => 'required|max:1000',
            ]);

            #Get auth user
            $user = auth()->user();

            $message = new DisputeMessage();
            $message->dispute_id = $dispute->id;
            $message->user_id = $user->id;
            $message->message = Crypt::encryptString($request->message);
            $message->save();

            if ($user->id == $dispute->buyer_id) {
                $this->createNotification(
                    $dispute->seller->id,
                    'Support has sent a message in dispute <strong>#' .
                        $dispute->id .
                        '</strong>',
                    route('dispute-message', ['order' => $dispute->order->id])
                );
            } elseif ($user->id == $dispute->seller_id) {
                $this->createNotification(
                    $dispute->buyer->id,
                    'Support has sent a message in dispute <strong>#' .
                        $dispute->id .
                        '</strong>',
                    route('dispute-message', ['order' => $dispute->order->id])
                );
            } elseif ($user->id == $dispute->admin_id) {
                $this->createNotification(
                    $dispute->buyer->id,
                    'Support has sent a message in dispute <strong>#' .
                        $dispute->id .
                        '</strong>',
                    route('dispute-message', ['order' => $dispute->order->id])
                );
                $this->createNotification(
                    $dispute->seller->id,
                    'Support has sent a message in dispute <strong>#' .
                        $dispute->id .
                        '</strong>',
                    route('dispute-message', ['order' => $dispute->order->id])
                );
            }
        } catch (\Exception $exception) {
            session()->flash('error', 'Oops... An error occurred!');
        }

        // return redirect()->route('order', ['order' => $dispute->order_id]);
        return redirect()->back();
    }

    /**
     * Finalize early HTTP request
     * @param  Order  $order
     *
     * @return App\Traits\Payment
     */
    public function postFinalizearly(Order $order)
    {
        try {
            $this->checkFinalizearly($order);
            $this->finalizearly();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->route('order', ['order' => $order->id]);
    }

    public function shareFunds50(Dispute $dispute)
    {
        $dispute->status = 'resolved';
        $dispute->save();

        $this->createNotification(
            $dispute->buyer->id,
            'YOU DRAW THE DISPUTE AND 50% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->createNotification(
            $dispute->seller->id,
            'YOU DRAW THE DISPUTE AND 50% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->sharePayment50($dispute->order);
    }
    public function shareFunds100(Dispute $dispute)
    {
        $dispute->status = 'resolved';
        $dispute->winner_id = $dispute->buyer->id;
        $dispute->save();

        $this->createNotification(
            $dispute->buyer->id,
            'HOORAY! YOU WON THE DISPUTE AND 100% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->createNotification(
            $dispute->seller->id,
            'YOU LOOSE A DISPUTE DUE TO LACK OF FACTS <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->cancelPayment($dispute->order);
    }

    public function refund(Dispute $dispute)
    {
        $dispute->status = 'resolved';
        $dispute->winner_id = $dispute->buyer->id;
        $dispute->save();

        $this->createNotification(
            $dispute->buyer->id,
            'YOUR ORDER <strong>#' .
                $dispute->id .
                ' HAS BEEN REFUNDED IN A DISPUTE BY SQUIDVENDOR',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->cancelPayment($dispute->order);

        return redirect()->back();
    }
    public function shareFunds25(Dispute $dispute)
    {
        $dispute->status = 'resolved';
        $dispute->winner_id = $dispute->seller->id;
        $dispute->save();

        $this->createNotification(
            $dispute->buyer->id,
            'YOU LOOSE THE DISPUTE AND 25% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->createNotification(
            $dispute->seller->id,
            'YOU WON THE DISPUTE AND 75% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->sharePayment25($dispute->order);
    }
    public function shareFunds75(Dispute $dispute)
    {
        $dispute->status = 'resolved';
        $dispute->winner_id = $dispute->buyer->id;
        $dispute->save();
        $this->createNotification(
            $dispute->buyer->id,
            'YOU WON THE DISPUTE AND 75% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->createNotification(
            $dispute->seller->id,
            'YOU LOOSE THE DISPUTE AND 25% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );

        $this->sharePayment75($dispute->order);
    }
    public function shareFunds0(Dispute $dispute)
    {
        $dispute->status = 'resolved';
        $dispute->winner_id = $dispute->seller->id;
        $dispute->save();
        $this->createNotification(
            $dispute->buyer->id,
            'YOU LOOSE A DISPUTE DUE TO LACK OF FACTS <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );
        $this->createNotification(
            $dispute->seller->id,
            'HOORAY! YOU WON THE DISPUTE AND 100% FUNDS HAVE BEEN CREDITED TO YOUR ACCOUNT <strong>#' .
                $dispute->id .
                '</strong>',
            route('dispute-message', ['order' => $dispute->order->id])
        );

        $this->sharePayment0($dispute->order);
    }
}