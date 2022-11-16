<input type="radio" name="report_" id="toggle-report" />
<input type="radio" name="report_" id="toggle-close" style="display:none" />
<div class="report-panel" style="border-top:1px solid var(--linkedin)">
    <form method="post" action="{{ route('post.reportvendor', ['vendor' => $seller->id]) }}" class="mt-20 text-default">
        <label for="toggle-close" style="cursor:pointer;float:right;margin-top:-10px;">
            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/close-black.png')
            ); ?> width="20px" />
        </label>
        <div class="h3 mb-10 panel-title">Report {{ $seller->username }}</div>
        @csrf
        <div class="form-group inblock">
            <div class="label">
                <label for="rating">Suspect User</label>
            </div>
            <input type="text" class="form-control" id="suspect" name="suspect" value="{{ $seller->username }}"
                placeholder="Suspect User" readonly>
        </div>
        <div class="form-group inblock">
            <div class="label">
                <label for="type">Report Content</label>
            </div>
            <textarea class="form-control" id="report" name="message" placeholder="message..."
                style="resize: none;height:250px"></textarea>
        </div>

        <button class="btn btn-success btn-sm" type="submit" style="float:right">Submit</button>
    </form>
</div>