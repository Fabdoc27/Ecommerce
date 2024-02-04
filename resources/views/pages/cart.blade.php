@if (Cookie::get('token') === null)
    <script>
        sessionStorage.clear();
        window.location.href = "/login";
    </script>
@else
    @extends('layout.app')

    @section('content')
        @include('components.menubar')
        @include('components.cartList')
        @include('components.paymentMethodList')
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
@endif
