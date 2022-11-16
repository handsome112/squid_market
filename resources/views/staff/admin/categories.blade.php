@extends('staff.admin.adminmain')
@section('content')
<title>Admin Categories - Squid Market</title>
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Categories</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        @include('includes.flash.validation')
        @include('includes.flash.success')
        @include('includes.flash.error')
        <div class="h3">Add New Category</div>
        <div class="container footnote mt-10 d-flex">
            <div class="h3">Comments :</div>
            <ul>
                <li>The category name must be unique.</li>
                <li>You can only delete a category if it doesn't have any items.</li>
                <li>The slug is by default named after the category.</li>
            </ul>
        </div>
        <form action="{{ route('post.admin.addcategories') }}" method="post" class="mt-10 d-flex align-items-center">
            @csrf
            <input type="text" id="name" name="name" class="form-control bg-dark border-0" style="width:200px">
            <select id="parent_category" name="parent_category"
                class="dropdown-wrapper form-control-sm bg-dark text-white mx-4">
                @foreach($allCategories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Create Category</button>
        </form>
        <ul>
            @forelse($rootsCategories as $category)
            <li><a
                    href="{{ route('admin.editcategory', ['category' => $category->id, 'section' => 'categories']) }}">{{ $category->name }}</a>
                <span class="footnote">{{ $category->totalProducts() }}</span>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('delete.admin.category', ['category' => $category->id]) }}"
                    class="link-danger">Delete</a>
            </li>
            @if(!empty($category->subcategories))
            @include('includes.components.subcategorieslist', ['subcategories' => $category->subcategories])
            @endif
            @empty
            <div class="h3">Hmm... It seems that the market still doesn't have any categories!</div>
            @endforelse
        </ul>
    </div>
</div>
@stop