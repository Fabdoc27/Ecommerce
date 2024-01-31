@extends('layout.app')
@section('content')
    @include('components.menubar')
    @include('components.verify')
    @include('components.footer')
    <script>
        (async () => {
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        })()
    </script>
@endsection
