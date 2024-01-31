@if (Cookie::get('token') === null)
    <script>
        sessionStorage.clear();
        window.location.href = "/login";
    </script>
@else
    @extends('layout.app')

    @section('content')
        @include('components.menubar')
        @include('components.wishlist')
        @include('components.topBrands')
        @include('components.footer')
        <script>
            (async () => {
                await category();
                await wishList();
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
                await brands();
            })()
        </script>
    @endsection
@endif
