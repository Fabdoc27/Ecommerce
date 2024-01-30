@extends('layout.app')
@section('content')
    @include('components.menubar')
    @include('components.byCategoryList')
    @include('components.topBrands')
    @include('components.footer')
    <script>
        (async () => {
            await category();
            await categoryProductList();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await brands();
        })()
    </script>
@endsection
