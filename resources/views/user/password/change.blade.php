@extends('user.layouts.master')
@section('content')
    <div class="row">
        @if (session('changeSuccess'))
            <div class="col-6 offset-3 mt-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small><i class="zmdi zmdi-lock"></i>
                        {{ session('changeSuccess') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
        </div>
        @endif
        @if (session('notMatch'))
            <div class="col-6 offset-3 mt-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small><i class="zmdi zmdi-lock"></i>
                        {{ session('notMatch') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
        </div>
        @endif
        <div class="col-6 offset-3">
            <div class="main-content ">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('user#changePassword') }}" method="post"
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Current Password</label>
                                            <input id="cc-pament" name="currentPassword" type="password" value=""
                                                class="form-control @error('currentPassword') is-invalid @enderror
                                            @if (session('notMatch')) is-invalid @endif"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter current password...">
                                            @error('currentPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @if (session('notMatch'))
                                                <div class="invalid-feedback">
                                                    {{ session('notMatch') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newPassword" type="password" value=""
                                                class="form-control @error('newPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter new password...">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password" value=""
                                                class="form-control @error('confirmPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Confirm password...">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-dark text-white btn-block">
                                                <i class="zmdi zmdi-lock mr-2"></i>
                                                <span id="payment-button-amount"><i class="fa-solid fa-key me-1"></i> Change Password</span>

                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
