@extends('layout.app')
@section('content')
    @include('components.menubar')
    @include('components.policyList')
    @include('components.footer')
    <script>
        (async () => {
            await category();
            await policy()
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await TopBrands();
        })()
    </script>
@endsection
