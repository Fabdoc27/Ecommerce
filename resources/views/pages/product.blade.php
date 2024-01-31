@extends('layout.app')
@section('content')
    @include('components.menubar')
    @include('components.productDetails')
    @include('components.productReview')
    @include('components.topBrands')
    @include('components.footer')
    <script>
        (async () => {
            await category();
            await productDetails();
            await productReview();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await brands();
        })()
    </script>
@endsection
