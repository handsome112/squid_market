<input type="radio" name="report_" id="toggle-report" />
<input type="radio" name="report_" id="toggle-close" style="display:none" />
<div class="report-panel" style="border-top:1px solid var(--linkedin);height:500px;width:400px">
    <form method="post" action="{{ route('post.reportproduct', ['product' => $product->id]) }}" class="mt-20">
        <label for="toggle-close" style="cursor:pointer;float:right;margin-top:-14px;margin-right:-7px">
            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/close-black.png')
            ); ?> width="20px" />
        </label>
        <div class="h3 mb-20 panel-title">Report product</div>
        @csrf
        <div class="form-group inblock">
            <div class="label">
                <label for="rating">Product</label>
            </div>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"
                placeholder="Product" readonly>
        </div>
        <div class="form-group inblock">
            <div class="label">
                <label for="rating">Cause</label>
            </div>
            <select class="form-control" name="cause">
                @foreach(config('general.reporting_causes') as $index => $cause)
                <option value="{{ $index }}">{{ $cause }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group inblock">
            <div class="label">
                <label for="rating">Report</label>
            </div>
            <textarea class="form-control" id="message" name="message" placeholder="message"
                style="resize:none"></textarea>
        </div>
        <button class="btn btn-success btn-sm" type="submit" style="float:right">Submit</button>
    </form>
</div>