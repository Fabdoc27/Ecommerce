@if (Cookie::get('token') === null)
    <script>
        sessionStorage.clear();
        window.location.href = "/login";
    </script>
@else
    @extends('layout.app')
    @section('content')
        @include('components.menubar')
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-tab-pane"
                                type="button" role="tab" aria-controls="order-tab-pane"
                                aria-selected="false">Orders</button>
                        </li>
                    </ul>

                    <div class="tab-content mb-4" id="myTabContent">
                        <div class="tab-pane active" id="profile-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            @include('components.profileDetails')
                        </div>
                        <div class="tab-pane show" id="order-tab-pane" role="tabpanel" aria-labelledby="order-tab"
                            tabindex="0">
                            @include('components.orderHistory')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('components.footer')
        <script>
            (async () => {
                await profileDetails();
                await orderHistories();
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            })()
        </script>
    @endsection
@endif
