<?php

namespace App\Traits;

use App\Models\{Order, Feedback, Dispute};

trait OrderTrait
{
    use Payment, NotificationTrait;

    /**
     * Mark the order as accepted
     * @param  Order  $order
     *
     * @return App\Models\Order
     */
    private function markAsAccepted(Order $order)
    {
        if (!$order->paidOrder()) {
            throw new \Exception(
                'The buyer has not yet sent the funds to the payment/escrow wallet!'
            );
        }

        if ($order->paymethod == 'fe') {
            $this->finalizearly($order);

            $order->status = 'accepted';
            $order->save();
            $buyerId = $order->buyer->id;
            $orderId = $order->id;
            $link = route('order', ['order' => $order->id]);
            $sellername = $order->seller->username;

            $this->createNotification(
                $buyerId,
                $sellername .
                    ' has accepted your order <strong>#' .
                    $order->id .
                    '</strong>.',
                $link
            );
        } else {
            $order->status = 'accepted';
            $order->save();

            $buyerId = $order->buyer->id;
            $orderId = $order->id;
            $link = route('order', ['order' => $order->id]);
            $sellername = $order->seller->username;

            $this->createNotification(
                $buyerId,
                $sellername .
                    ' has accepted your order <strong>#' .
                    $order->id .
                    '</strong>.',
                $link
            );
        }
    }

    /**
     * Mark the order as shipped
     * @param  Order  $order
     *
     * @return App\Models\Order
     */
    private function markAsShipped(Order $order)
    {
        $order->status = 'shipped';
        $order->save();

        $buyerId = $order->buyer->id;
        $orderId = $order->id;
        $link = route('order', ['order' => $order->id]);
        $sellername = $order->seller->username;

        $this->createNotification(
            $buyerId,
            $sellername .
                ' has shipped out your order <strong>#' .
                $order->id .
                '</strong>.',
            $link
        );
    }

    /**
     * Mark the order as delivered
     * @param  Order  $order
     *
     * @return App\Models\Order
     */
    private function markAsDelivered(Order $order)
    {
        if ($order->paymethod != 'fe') {
            $this->releasePayment($order);
        }
        $order->status = 'delivered';
        $order->save();

        // $feedback = new Feedback();
        // $feedback->order_id = $order->id;
        // $feedback->product_id = $order->product->id;
        // $feedback->buyer_id = $order->buyer->id;
        // $feedback->seller_id = $order->seller->id;
        // $feedback->save();

        $sellerId = $order->seller->id;
        $orderId = $order->id;
        $link = route('sale', ['order' => $order->id]);
        $buyername = $order->buyer->username;

        $this->createNotification(
            $sellerId,
            $buyername .
                ' has marked your sales as delivered <strong>#' .
                $order->id .
                '</strong>.',
            $link
        );

        $link = route('detailfeedback_p', ['product' => $order->product->id]);
        $this->createNotification(
            $sellerId,
            $buyername .
                ' has left a ' .
                $order->feedback->type .
                ' feedback for your sales <strong>#' .
                $order->id .
                '</strong>.',
            $link
        );
    }

    /**
     * Mark the order as canceled
     * @param  Order  $order
     *
     * @return App\Models\Order
     */
    private function markAsCanceled(Order $order)
    {
        if ($order->paidOrder()) {
            $this->cancelPayment($order);
        }
        $order->status = 'canceled';
        $order->save();

        $orderId = $order->id;

        if (auth()->user()->id == $order->seller->id) {
            $link = route('order', ['order' => $order->id]);
            $username = auth()->user()->username;
            $this->createNotification(
                $order->buyer->id,
                $username .
                    ' has rejected order <strong>#' .
                    $order->id .
                    '</strong>',
                $link
            );
        } elseif (auth()->user()->id == $order->buyer->id) {
            $link = route('sale', ['order' => $order->id]);
            $username = auth()->user()->username;
            $this->createNotification(
                $order->seller->id,
                $username .
                    ' has cancelled order <strong>#' .
                    $order->id .
                    '</strong>',
                $link
            );
        }
    }

    /**
     * Mark the order as disputed
     * @param  Order  $order
     *
     * @return App\Models\Order
     */
    private function markAsDisputed(Order $order)
    {
        if (!$order->delivered()) {
            $this->cancelPayment($order);
        }

        $order->status = 'disputed';
        $order->save();

        $dispute = new Dispute();
        $dispute->order_id = $order->id;
        $dispute->product_id = $order->product->id;
        $dispute->buyer_id = $order->buyer->id;
        $dispute->seller_id = $order->seller->id;
        $dispute->excutor_id = auth()->user()->id;
        $dispute->save();

        if (auth()->user()->id == $order->seller->id) {
            $userId = $order->buyer->id;
            $link = route('order', ['order' => $order->id]);
        } elseif (auth()->user()->id == $order->buyer->id) {
            $userId = $order->seller->id;
            $link = route('sale', ['order' => $order->id]);
        }

        $this->createNotification(
            $userId,
            'You have new dispute for order <strong>#' .
                $order->id .
                '</strong>',
            $link
        );
    }
}