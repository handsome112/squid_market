@extends('staff.admin.adminmain')
@section('content')
<title>Admin Vendors - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<!-- Products Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Products</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex">
        <input class="form-control bg-secondary border-0 mb-3" style="width:300px;margin-left:auto" type="search"
            placeholder="Search">
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Listed On</th>
                        <th scope="col">Product</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Total Sold $</th>
                        <th scope="col">Feedbacks</th>
                        <th scope="col">Category</th>
                        <th scope="col">Violation</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->created_at->format('m/d/y') }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->seller->username }}</td>
                        <td>0</td>
                        <td>$0</td>
                        <td>0</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->checkViolate() }}</td>
                        <td>@if($product->deleted == 0)@elseif($product->featured == 0 and $product->deleted != 0)<label
                                for="{{ $product->id }}" class="btn btn-sm btn-primary">Make
                                Featured</label> @elseif($product->deleted != 0) <label for="un{{ $product->id }}"
                                class="btn btn-sm btn-primary">Remove Feature</label> @endif</td>
                        <td>@if($product->deleted != 0)
                            <label for="del{{ $product->id }}" class="btn btn-sm btn-primary">Delete</label> @else
                            <label for="" class="btn btn-sm btn-primary">Deleted</label> @endif
                            <input type="radio" id="del{{ $product->id }}" name="delfeatured" class="toggle-delfeature"
                                hidden>
                            <input type="radio" id="toggle-close-del" name="delfeatured" hidden>
                            <div class="delfeatured-panel text-center">
                                <form method="post" action="{{ route('delpromote', ['product' => $product->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO DELETE THIS PRODUCT?</h5>
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-del" class="btn btn-primary btn-sm">No I don't</label>
                                    </div>
                                </form>
                            </div>

                            <input type="radio" id="un{{ $product->id }}" name="unfeatured" class="toggle-unfeature"
                                hidden>
                            <input type="radio" id="toggle-close-un" name="unfeatured" hidden>
                            <div class="unfeatured-panel text-center">
                                <form method="post" action="{{ route('unpromote', ['product' => $product->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO UNFEATURE THIS PRODUCT ON
                                        HOMEPAGE?</h5>
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-un" class="btn btn-primary btn-sm">No I don't</label>
                                    </div>
                                </form>
                            </div>

                            <input type="radio" id="{{ $product->id }}" name="featured" class="toggle-feature" hidden>
                            <input type="radio" id="toggle-close" name="featured" hidden>
                            <div class="featured-panel text-center">
                                <form method="post" action="{{ route('promote', ['product' => $product->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO PROMOTE THIS PRODUCT ON
                                        HOMEPAGE?</h5>
                                    <div class="mb-3">
                                        <span>Choose Slot:</span>
                                        <select class="dropdown-wrapper form-control-sm bg-dark text-white slot_select"
                                            name="slotnum">
                                            @for ($i =1; $i <= 24; $i++) <option value="{{ $i }}">SLOT {{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close" class="btn btn-primary btn-sm">No I don't</label>
                                    </div>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="color:red;text-align:center;">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Products End -->
@stop