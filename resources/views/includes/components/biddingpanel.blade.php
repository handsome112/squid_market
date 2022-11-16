<input type="radio" name="slot" id="toggle-bidding{{$i}}" class="toggle-bidding" hidden />
<input type="radio" name="slot" id="toggle-close" style="display:none" />
<div class="bidding-panel" style="border-top:1px solid var(--linkedin)">
    <form method="post" action="{{ route('post.bidding') }}" class="mt-20 text-default">
        <label for="toggle-close" style="cursor:pointer;float:right;margin-top:-25px;">
            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/close-black.png')
            ); ?> width="20px" />
        </label>
        <div class="h3 mb-3 mt-3">Bid For SLOT {{ $i }}</div>
        @csrf
        <div class="mb-2 inblock">
            <div class="label float-start">
                <label for="rating">Slot Number</label>
            </div>
            <input type="text" class="form-control" id="slotnum" name="slotnum" value="{{ $i }}"
                placeholder="Slot Number" readonly>
        </div>
        <div class="mb-2 inblock">
            <div class="label float-start">
                <label for="rating">Choose Product</label>
            </div>
            <select class="form-control" name="product">
                @forelse(auth()->user()->products()->get(['id', 'name']) as $product)
                <option value="{{$product->id}}">{{ $product->name }}</option>
                @empty
                <option value="no">You have no any products!</option>
                @endforelse
            </select>
        </div>

        <div class="mb-2 inblock">
            <div class="label float-start">
                <label for="rating">Pay With Balance</label>
            </div><br>
            <div class="d-flex align-items-center justify-content-between">
                @if(auth()->user()->balance() * \App\Tools\Converter::moneroLastPrice() >= $highestPrice)
                <input type="text" class="form-control" style="width:55%" id="price_b" name="price_b"
                    placeholder="amount to bid as XMR" />
                <button class="btn btn-success btn-sm" style="width:153px" type="submit" value="balance" name="bid">Bid
                    with Balance</button>
                @else
                <div class="text-light" style="background-color: lightcoral; border-radius:5px">
                    You don't have enough funds in your market wallet to bid, we advise you use direct pay.
                </div>
                @endif
            </div>
        </div>
        <div class="mb-2 inblock">
            <div class="label float-start">
                <label for="type">Payment Address</label>
            </div><br>
            <div class="qr-text">
                {{ auth()->user()->bid_monero_wallet }}
            </div>
        </div>

        <div class="mb-1 inblock">
            <div class="label float-start">
                <label for="type">Amount You Sent</label>
            </div><br>
            <div class="d-flex align-items-center justify-content-between">
                <input type="text" class="form-control" style="width:55%" id="price" name="price" value="0" readonly />
                <a href="" class="btn btn-success btn-sm" type="submit"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                    public_path('img/icons/refresh.png')
                ); ?> width="15" height="15" alt="refresh"></a>
                <button class="btn btn-success btn-sm" type="submit" value="direct" name="bid">Direct Bid</button>
            </div>
        </div>
        <div class="text-light" style="background-color: lightcoral; border-radius:5px">(You must deposit at least
            {{ $highestPrice + 1 }}
            {{ auth()->user()->currency }} as bid
            price.)
        </div>
    </form>
</div>