@extends('layouts.master')

@section('css')
    {!! Theme::css('plugins/cropper/cropper.css') !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/flags.authy.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/form.authy.css"/>
    <style>
        #image_source {
            cursor: pointer;
        }
    </style>
@endsection

@section('editable_content')
    @include('partials.page_header',['content'=>''])

    @php \Actions::do_action('pre_content', null, null) @endphp

    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <div class="col-lg-4">
                <aside class="user-info-wrapper">
                    <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
                        <div class="info-label" data-toggle="tooltip" title="You currently have 290 Reward Points to spend">
                            <i class="icon-medal"></i>290 points
                        </div>
                    </div>
                    <div class="user-info">
                        <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="img/account/user-ava.jpg"
                                                                                          alt="User"></div>
                        <div class="user-data">
                            <h4>Daniel Adams</h4><span>Joined February 06, 2017</span>
                        </div>
                    </div>
                </aside>
                <nav class="list-group"><a class="list-group-item with-badge" href="account-orders.html"><i
                                class="icon-bag"></i>Orders<span class="badge badge-primary badge-pill">6</span></a><a
                            class="list-group-item active" href="account-profile.html"><i class="icon-head"></i>Profile</a><a
                            class="list-group-item" href="account-address.html"><i class="icon-map"></i>Addresses</a><a
                            class="list-group-item with-badge" href="account-wishlist.html"><i
                                class="icon-heart"></i>Wishlist<span class="badge badge-primary badge-pill">3</span></a><a
                            class="list-group-item with-badge" href="account-tickets.html"><i class="icon-tag"></i>My
                        Tickets<span class="badge badge-primary badge-pill">4</span></a></nav>
            </div>
            <div class="col-lg-8">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <form class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-fn">First Name</label>
                            <input class="form-control" type="text" id="account-fn" value="Daniel" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-ln">Last Name</label>
                            <input class="form-control" type="text" id="account-ln" value="Adams" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-email">E-mail Address</label>
                            <input class="form-control" type="email" id="account-email" value="daniel.adams@mail.com"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-phone">Phone Number</label>
                            <input class="form-control" type="text" id="account-phone" value="+7(805) 348 95 72" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-pass">New Password</label>
                            <input class="form-control" type="password" id="account-pass">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-confirm-pass">Confirm Password</label>
                            <input class="form-control" type="password" id="account-confirm-pass">
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="custom-control custom-checkbox d-block">
                                <input class="custom-control-input" type="checkbox" id="subscribe_me" checked>
                                <label class="custom-control-label" for="subscribe_me">Subscribe me to Newsletter</label>
                            </div>
                            <button class="btn btn-primary margin-right-none" type="button" data-toast
                                    data-toast-position="topRight" data-toast-type="success"
                                    data-toast-icon="icon-circle-check" data-toast-title="Success!"
                                    data-toast-message="Your profile updated successfuly.">Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop