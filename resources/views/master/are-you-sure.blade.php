@extends('master.main')
@section('no-content')

@section('title', 'Are you SURE')

<body class="bg-dark d-flex h-100 justify-content-center align-items-center">
    <div class="container">
        <div class="account-card col-lg-4 mx-auto" style="margin-top: 180px">
            <div class="icon-box text-center">
                <i class="bi-emoji-smile-upside-down"></i>
                <h2 class="text-uppercase mt-3 mb-3">Are You Sure?</h2>
                <h3>Are you sure you want to remove this product from your cart?</h3>
                <div class="mt-3 d-flex" style="justify-content: space-around;">
                    <form action="{{ route('post.removetocart', ['product' => $product->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Yes, I want</button>
                    </form>
                    <a href="{{ route('cart') }}" class="btn btn-primary btn-sm">No, I don't want</a>
                </div>
            </div>
        </div>
    </div>
</body>

@stop