<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Converter;
use App\Http\Requests\Seller\{BecomeSellerRequest, SellerProfileRequest};
use App\Models\{Order, Product, Bid, Slot};
use Illuminate\Support\Facades\Gate;

class SellerController extends Controller
{
    /**
     * Become seller view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewBecome()
    {
        #Get auth user
        $user = auth()->user();
        if (!$user->isSeller()) {
            return view('seller.joinsquid', [
                'user' => $user,
                'totalReceived' => \Monerod::getTotalReceived(
                    $user->become_monero_wallet
                ),
                'sellerFee' => Converter::getSellerFee(),
                // 'key' => auth()->user()->pgp_key,
            ]);
        }

        return abort(404);
    }

    /**
     * Become seller HTTP request
     * @param  BecomeSellerRequest $request
     *
     * @return App\Http\Requests\Seller\BecomeSellerRequest
     */
    public function postBecome(BecomeSellerRequest $request)
    {
        try {
            return $request->become();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Return dashboard view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewDashboard()
    {
        #Get auth user
        $user = auth()->user();
        return view('seller.dashboard', [
            'products' => $user->products()->paginate(1),
            'seller' => $user,
        ]);
    }

    /**
     * Edit seller profile HTTP request
     * @param  SellerProfileRequest $request
     *
     * @return App\Http\Requests\Seller\SellerProfileRequest
     */
    public function putDashboard(SellerProfileRequest $request)
    {
        try {
            return $request->edit();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Sales view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewSales($status)
    {
        #Get auth user
        $user = auth()->user();

        if (
            !is_null($status) and
            in_array($status, config('general.order_status'))
        ) {
            return view('seller.sales', [
                'status' => $status,
                'user' => $user,
                'sales' => $user
                    ->sales()
                    ->where('status', $status)
                    ->paginate(25),
            ]);
        } elseif ($status === 'all') {
            return view('seller.sales', [
                'status' => $status,
                'user' => $user,
                'sales' => $user
                    ->sales()
                    ->where('status', '!=', 'waiting')
                    ->paginate(25),
            ]);
        } else {
            return abort(404);
        }
    }

    private function checkOrder(Order $order)
    {
        if (Gate::denies('order', $order)) {
            return abort(404);
        }
    }

    public function viewSale(Order $order)
    {
        $this->checkOrder($order);

        if ($order->disputed()) {
            $disputeMessages = $order->dispute->messages();
        }

        if ($order->delivered()) {
            $feedback = $order->feedback;
        }

        return view('seller.saledetails', [
            'order' => $order,
            'totalSent' => \Monerod::getTotalReceived(
                $order->escrow_monero_wallet
            ),
            'toPay' => number_format($order->total_in_monero, 5),
            'user' => $order->seller,
            'feedback' => isset($feedback) ? $feedback : null,
            'messages' => isset($disputeMessages) ? $disputeMessages : null,
        ]);
    }

    public function postBid(Request $request)
    {
        #Get user id
        $user = auth()->user()->id;
        if ($request->product == 'no') {
            session()->flash('error', 'You have no any products');
            return redirect()->back();
        }
        if ($request->bid == 'direct') {
            $product = Product::where('id', $request->product)->first();
            $balanceWallet =
                \Monerod::getTotalReceived($product->bid_monero_wallet) *
                Converter::moneroLastPrice();

            if ($balanceWallet > Bid::highestPrice($request->slotnum)) {
                $bid = new Bid();
                $bid->product_id = $product->id;
                $bid->price = $balanceWallet;
                $bid->slotnum = $request->slotnum;
                $bid->save();
            } else {
                session()->flash(
                    'error',
                    'Deposit more than highest price at the address!'
                );
                return redirect()->back();
            }

            session()->flash(
                'success',
                'You have successfully bid to Slot' . $request->slotnum . '!'
            );
            return redirect()->back();
        } elseif ($request->bid == 'balance') {
            session()->flash(
                'error',
                'YOU DO NOT HAVE ENOUGH FUNDS IN YOUR MARKET WALLET TO BID, WE ADVISE YOU USE DIRECT PAY'
            );
            return redirect()->back();
        }
    }
}