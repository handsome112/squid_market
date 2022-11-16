<input type="radio" name="report_" id="toggle-feedback" />
<input type="radio" name="report_" id="toggle-close" style="display:none" />
<div class="feedback-panel">
    <form method="post" action="{{ route('post.feedback', ['order' => $order->id]) }}" class="mt-20 text-default">
        <label for="toggle-close" style="cursor:pointer;float:right;margin-top:-15px;margin-right:-10px">
            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/close-black.png')
            ); ?> width="20px" />
        </label>
        <div class="h3 mb-10 panel-title">You must leave feedabck first.</div>
        @csrf
        <div class="mb-2 inblock">
            <div class="label">
                <label for="rating">Rating(Between 1 to 5)</label>
            </div>
            <div class="d-flex justify-content-between">
                <input type="number" class="form-control" id="community" name="community" max="5" min="1"
                    placeholder="Communication">
                <input type="number" class="form-control mx-2" id="shipping" name="shipping" max="5" min="1"
                    placeholder="Shipping">
                <input type="number" class="form-control" id="products" name="products" max="5" min="1"
                    placeholder="Products">
            </div>
        </div>
        <!-- <div class="mb-2 inblock">
            <div class="label">
                <label for="type">Type</label>
            </div>
            <select id="type" name="type" class="dropdown-wrapper form-control">
                @foreach(config('general.feedback_type') as $type)
                <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div> -->
        <div class="mb-3">
            <div class="label">
                <label for="feedback">Feedback</label>
            </div>
            <textarea class="form-control" id="feedback" name="feedback" style="resize:none"></textarea>
        </div>
        <button class="btn btn-success btn-sm float-end" type="submit">Send Feedback</button>
    </form>
</div>