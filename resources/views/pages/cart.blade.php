@extends('layout.app')

@section('content')
    @include('components.menubar')
    @include('components.cartList')
    @include('components.topBrands')
    @include('components.footer')
    <script>
        (async () => {
            await category();
            await cartList();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await brands();
        })()
    </script>
@endsection
