<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Create Digital Prouduct - Squid Market</title>
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            @if($section == 'add')
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/plus-circle.png')
            ); ?> width="17px" style="margin-top:-3px"> Create Digital Listing</h5>
            @elseif($section == 'edit')
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/edit.png')
            ); ?> width="17px" style="margin-top:-3px"> Edit Digital Listing</h5>
            @endif
        </div>
    </div>
</section>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="account-card">
                    <form class="user-form"
                        action="{{ $section == 'edit' ? route('post.digitalproduct', ['section' => $section, 'product' => $product->id]) : route('post.digitalproduct', ['section' => 'add']) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Category<small class="text-danger">*</small></label>
                            <div class="col-sm-8">
                                <select class="form-select" name="category" required>
                                    <option selected>Please Select</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($section=='edit' and $product->category_id
                                        == $category->id)
                                        selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="error inblock">
                                    <small class="text-danger">{{ $errors->first('category') }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Headline<small class="text-danger">*</small></label>
                            <div class="col-sm-8">
                                <input name="name" type="text" class="form-control"
                                    placeholder="Please enter the ad title" @if($section=='edit' )
                                    value="{{ $product->name }}" @endif>
                                @error('name')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Description<small
                                    class="text-danger">*</small></label>
                            <div class="col-sm-8">
                                <textarea name="description"
                                    class="form-control">@if($section == 'edit'){{ $product->description }}@endif</textarea>
                                @error('description')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-4">
                                <label>Product Price</label>
                                <div class="input-group">
                                    <select class="form-select" id="productcurrency" name="productcurrency">
                                        @foreach(config('currencies') as $currency)
                                        <option value="{{ $currency }}" @if($currency==auth()->user()->currency)
                                            selected
                                            @endif>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="productprice" @if($section=='edit' )
                                        value="{{ $product->price }}" @endif>
                                </div>
                                @error('productprice')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('productprice') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Quantity</label>
                                <input type="number" class="form-control" placeholder="Only numbers" name="quantity"
                                    @if($section=='edit' ) value="{{ $product->quantity }}" @endif>
                                @error('quantity')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('quantity') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Measurement</label>
                                <select class="form-select" name="mesure" required>
                                    <option selected>Please Select</option>
                                    <option value="grams" @if($section=='edit' and $product->mesure=='grams')
                                        selected
                                        @endif>Grams</option>
                                    <option value="ounce" @if($section=='edit' and $product->mesure=='ounce')
                                        selected
                                        @endif>Ounce</option>
                                    <option value="eight" @if($section=='edit' and $product->mesure=='eight')
                                        selected
                                        @endif>Eight</option>
                                    <option value="quarter" @if($section=='edit' and $product->mesure=='quarter')
                                        selected @endif>Quarter
                                    </option>
                                    <option value="pounds" @if($section=='edit' and $product->mesure=='pounds')
                                        selected
                                        @endif>Pounds
                                    </option>
                                    <option value="kilos" @if($section=='edit' and $product->mesure=='kilos')
                                        selected
                                        @endif>Kilos</option>
                                    <option value="piece" @if($section=='edit' and $product->mesure=='piece')
                                        selected
                                        @endif>Piece</option>
                                    <option value="item" @if($section=='edit' and $product->mesure=='item') selected
                                        @endif>Item</option>
                                    <option value="box" @if($section=='edit' and $product->mesure=='box') selected
                                        @endif>Box</option>
                                    <option value="cart" @if($section=='edit' and $product->mesure=='cart') selected
                                        @endif>Cart</option>
                                </select>
                                @error('mesure')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('mesure') }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Type of payment</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    @if(auth()->user()->fe == 1)
                                    <div class="col-lg-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" value="fe" name="paymethod"
                                                @if($section=='edit' and $product->paymethod == 'fe') checked @endif>
                                            <label class="form-check-label" for="c1">Finalize Early</label>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" value="escrow" name="paymethod"
                                                @if($section !='edit' ) checked @elseif($section=='edit' and
                                                $product->paymethod == 'escrow') checked
                                            @endif>
                                            <label class="form-check-label" for="c2">Normal Escrow</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Terms & Conditions</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"
                                    name="conditions">@if($section == 'edit'){{ $product->conditions }}@endif</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Autofilled</label>
                            <div class="col-sm-8">
                                <div class="bg-warning p-2 rounded">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="autofilled"
                                            name="autofilled" @if($section=='edit' and $product->autofilled == '1')
                                        checked @endif>
                                        <label class="form-check-label" for="autofilled">
                                            Select if you delivery different asset/product for each quantity. If this
                                            option is checked we send as many lines as the by buyer's selected quantity.
                                            Example: 1 quantity = 1 line, 3 quantity = 3 lines. If this option is
                                            unchecked system send the entire contents of the digital asset textbox.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Digital Asset</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" placeholder="Digital Product's Asset"
                                    name="digitalasset">@if($section == 'edit' and $product->autofilled == '1') {{ $product->digitalasset }} @endif</textarea>
                                @error('digitalasset')
                                <div class="text-danger">
                                    <small class="text-danger">{{ $errors->first('digitalasset') }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="uploadimage" class="form-label">Choose Image</label>
                            <input class="form-control" id="uploadimage" type="file" name="uploadimage">
                            @error('uploadimage')
                            <div class="text-danger">
                                <small class="text-danger">{{ $errors->first('uploadimage') }}</small>
                            </div>
                            @enderror
                        </div>
                        @if($section=='edit')
                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/edit.png')
                            ); ?> width="15px" style="margin-top:-3px"> Edit
                                Product</button>
                        </div>
                        @else
                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/plus-circle.png')
                            ); ?> width="15px" style="margin-top:-3px"> Add
                                Product</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop