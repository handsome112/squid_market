@extends('staff.admin.adminmain')
@section('content')
<title>Admin Edit Categories - Squid Market</title>
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Categories</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        @include('includes.flash.validation')
        @include('includes.flash.success')
        @include('includes.flash.error')
        <div class="h3">Edit {{ $category->name }} category</div>
        <div class="container footnote mt-10 d-flex">
            <div class="h3">Comments :</div>
            <ul>
                <li>The category name must be unique.</li>
                <li>You can only delete a category if it doesn't have any items.</li>
                <li>The slug is by default named after the category.</li>
            </ul>
        </div>
        <form action="{{ route('put.admin.editcategory', ['category' => $category->id]) }}" method="post" class="mt-10">
            @csrf
            @method('PUT')
            <div class="d-flex mb-4">
                <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control bg-dark"
                    style="width:200px">
                <select id="parent_category" name="parent_category"
                    class="dropdown-wrapper form-control-sm bg-dark text-white mx-4">
                    <option value="">None</option>
                    @foreach($allCategories as $cat)
                    <option value="{{ $cat->id }}" @if($cat->id == $category->parent_category) selected
                        @endif>{{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="inblock d-flex">
                <a href="{{ route('admin.categories', ['section' => 'categories']) }}"
                    class="btn btn-sm btn-primary">Back</a>
                <button type="submit" class="btn btn-sm btn-primary mx-4">Edit {{ $category->name }}</button>
            </div>
        </form>
        <ul>
    </div>
</div>


@stop