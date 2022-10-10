@extends('admin.layouts.master')
@section('title','Category List')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content mt-4">

        @if (session('accountUpdate'))
        <div class="col-4 offset-4">
           <div class="alert alert-success alert-dismissible fade show" role="alert">
               <small><i class="zmdi zmdi-lock"></i> {{ session('accountUpdate') }}</small>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
        </div>
        @endif

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="text-center title-2">
                                    <h3>Account Info</h3>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == "male")
                                                 <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                            @else
                                                     <img src="{{ asset('image/default_user_female.jpeg') }}" class="img-thumbnail shadow-sm" alt="">
                                             @endif
                                    @else
                                         <img src="{{ asset('storage/'. Auth::user()->image) }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <h5 class="mb-2">   <i class="zmdi zmdi-account mr-3 text-danger"></i> {{ Auth::user()->name }}</h5>
                                    <h5 class="mb-2">   <i class="zmdi zmdi-email mr-3 text-warning"></i> {{ Auth::user()->email }}</h5>
                                    <h5 class="mb-2">   <i class="zmdi zmdi-phone mr-3 text-success"></i> {{ Auth::user()->phone }}</h5>
                                    <h5 class="mb2">    <i class="zmdi zmdi-male-female mr-3 text-success"></i> {{ Auth::user()->gender }} </h5>
                                    <h5 class="mb-2">   <i class="zmdi zmdi-my-location mr-3 text-secondary"></i> {{ Auth::user()->address }}</h5>
                                    <h5 class="mb-2">   <i class="zmdi zmdi-calendar-check mr-3 text-primary"></i> {{ Auth::user()->created_at->format('j-M-Y') }}</h5>

                                </div>

                            </div>
                            <div class="col-4 offset-8">
                                <div class=" mt-3 float-end">
                                    <a href="{{ route('admin#editPage') }}">
                                        <button class="btn bg-secondary" type="">
                                            <i class="zmdi zmdi-edit mr-2"></i> Edit Profile
                                        </button>
                                    </a>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
