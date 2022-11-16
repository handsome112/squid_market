<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Create Physical Product -Squid Market</title>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            @if($section == 'add')
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/plus-circle.png')
            ); ?> width="17px" style="margin-top:-3px"> Create Physical Listing</h5>
            @elseif($section == 'edit')
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/edit.png')
            ); ?> width="17px" style="margin-top:-3px"> Edit Physical Listing</h5>
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
                        action="{{ $section == 'edit' ? route('post.physicalproduct', ['section' => $section, 'product' => $product->id]) : route('post.physicalproduct', ['section' => 'add']) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Category<small class="text-danger">*</small></label>
                            <div class="col-sm-8">
                                <select class="form-select dropdown-wrapper" id="category" name="category" required>
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
                                <input type="text" class="form-control" id="name" name="name"
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
                                <textarea class="form-control"
                                    name="description">@if($section == 'edit') {{ $product->description }} @endif</textarea>
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
                                    <input type="text" class="form-control" id="productprice" name="productprice"
                                        @if($section=='edit' ) value="{{ $product->price }}" @endif>
                                </div>
                                @error('productprice')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('productprice') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Quantity</label>
                                <input type="number" class="form-control" placeholder="Only numbers" id="quantity"
                                    name="quantity" @if($section=='edit' ) value="{{ $product->quantity }}" @endif>
                                @error('quantity')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('quantity') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Measurement</label>
                                <select class="form-select" id="mesure" name="mesure" required>
                                    <option selected>Please Select</option>
                                    <option value="grams" @if($section=='edit' and $product->mesure=='grams') selected
                                        @endif>Grams</option>
                                    <option value="ounce" @if($section=='edit' and $product->mesure=='ounce') selected
                                        @endif>Ounce</option>
                                    <option value="eight" @if($section=='edit' and $product->mesure=='eight') selected
                                        @endif>Eight</option>
                                    <option value="quarter" @if($section=='edit' and $product->mesure=='quarter')
                                        selected @endif>Quarter
                                    </option>
                                    <option value="pounds" @if($section=='edit' and $product->mesure=='pounds') selected
                                        @endif>Pounds
                                    </option>
                                    <option value="kilos" @if($section=='edit' and $product->mesure=='kilos') selected
                                        @endif>Kilos</option>
                                    <option value="piece" @if($section=='edit' and $product->mesure=='piece') selected
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
                                    name="conditions">@if($section == 'edit') {{ $product->conditions }} @endif</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="form-group col-md-6">
                                <label>Shipping From</label>
                                <select class="form-select" id="ships_from" name="ships_from">
                                    @foreach(config('countries') as $key => $shipsFrom)
                                    <option value="{{ $key }}" @if($section=='edit' and $product->ships_from == $key)
                                        selected
                                        @endif>{{ $shipsFrom }}</option>
                                    @endforeach
                                </select>
                                @error('ships_from')
                                <div class="error inblock">
                                    <small class="text-danger">{{ $errors->first('ships_from') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Shipping To</label>
                                <select class="form-select" id="ships_to" name="ships_to">
                                    @foreach(config('countries') as $key => $shipsTo)
                                    <option value=" {{ $key }}" @if($section=='edit' and $product->ships_to == $key)
                                        selected
                                        @endif>{{ $shipsTo }}</option>
                                    @endforeach
                                </select>
                                @error('ships_to')
                                <div class="error inblock">
                                    <small class="text-danger">{{ $errors->first('ships_to') }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        @php
                        if ($section == 'edit') {
                        $ships_with = json_decode(
                        $product->ships_with,
                        true
                        );
                        $ships_price = json_decode(
                        $product->ships_price,
                        true
                        );
                        $ships_time = json_decode(
                        $product->ships_time,
                        true
                        );
                        }
                        @endphp
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Shipping</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" id="ships1">
                                    </div>
                                    <input type="text" class="form-control" name="ships_with[1]"
                                        placeholder="Shipping With?" @if($section=='edit' ) value="{{ $ships_with[1] }}"
                                        @endif>
                                    <input type="number" name="ships_time[1]" class="form-control" @if($section=='edit'
                                        ) value="{{ $ships_time[1] }}" @endif placeholder="Days">
                                    <input type="text" class="form-control" name="ships_price[1]" placeholder="Price"
                                        @if($section=='edit' ) value="{{ $ships_price[1] }}" @endif>
                                    <select class="form-select">
                                        @foreach(config('currencies') as $currency)
                                        <option value="{{ $currency }}" @if($currency==auth()->user()->currency)
                                            selected
                                            @endif>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox">
                                    </div>
                                    <input type="text" class="form-control" name="ships_with[2]"
                                        placeholder="Shipping With?" @if($section=='edit' ) value="{{ $ships_with[2] }}"
                                        @endif>
                                    <input type="number" name="ships_time[2]" class="form-control" @if($section=='edit'
                                        ) value="{{ $ships_time[2] }}" @endif placeholder="Days">
                                    <input type="text" class="form-control" name="ships_price[2]" placeholder="Price"
                                        @if($section=='edit' ) value="{{ $ships_price[2] }}" @endif>
                                    <select class="form-select">
                                        @foreach(config('currencies') as $currency)
                                        <option value="{{ $currency }}" @if($currency==auth()->user()->currency)
                                            selected
                                            @endif>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox">
                                    </div>
                                    <input type="text" class="form-control" name="ships_with[3]"
                                        placeholder="Shipping With?" @if($section=='edit' ) value="{{ $ships_with[3] }}"
                                        @endif>
                                    <input type="number" name="ships_time[3]" class="form-control" @if($section=='edit'
                                        ) value="{{ $ships_time[3] }}" @endif placeholder="Days">
                                    <input type="text" class="form-control" name="ships_price[3]" placeholder="Price"
                                        @if($section=='edit' ) value="{{ $ships_price[3] }}" @endif>
                                    <select class="form-select">
                                        @foreach(config('currencies') as $currency)
                                        <option value="{{ $currency }}" @if($currency==auth()->user()->currency)
                                            selected
                                            @endif>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
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