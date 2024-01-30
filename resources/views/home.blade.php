@extends('layout.app')
@section('content')
    @include('components.menubar')
    @include('components.bannerSlider')
    @include('components.topCategories')
    @include('components.exclusiveProducts')
    @include('components.topBrands')
    @include('components.footer')
    <script>
        (async () => {
            await category();
            await bannerSlider();
            await topCategory();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await Popular();
            await New();
            await Top();
            await Special();
            await Trending();
            await Discount();
            await brands();
        })()
    </script>
@endsection
