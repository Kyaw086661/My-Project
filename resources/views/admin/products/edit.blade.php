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
                                    {{-- <h3>Pizza Details</h3> --}}
                                </div>
                            </div>

                            {{-- <hr> --}}
                            <div class="row">
                                <div class="col-3 offset-1 ">

                                         <img src="{{ asset('storage/'. $pizza->image) }}" alt="John Doe" />

                                </div>
                                <div class="col-8 ">
                                    <h3 class="mb-4">   <i class="fa-solid fa-pizza-slice text-danger mr-3 "></i> {{ $pizza->name }}</h3>
                                    <span class="mb-2 btn btn-dark text-white">  <i class="fa-solid fa-coins text-success"></i> {{ $pizza->category_name }} </span>
                                    <span class="mb-2 btn btn-dark text-white">   <i class="fa-solid fa-money-bill-1-wave text-primary mr-3 "></i> {{ $pizza->price }} Kyats</span>
                                    <span class="mb-2 btn btn-dark text-white">   <i class="fa-solid fa-clock text-success mr-3 "></i> {{ $pizza->waiting_time}} mins</span>
                                    <span class="mb-2 btn btn-dark text-white">    <i class="fa-solid fa-eye text-danger mr-3 "></i>  {{ $pizza->view_count }} </span>
                                    <span class="mb-2 btn btn-dark text-white">   <i class="zmdi zmdi-calendar-check text-warning mr-3 "></i> {{ $pizza->created_at->format('j-M-Y') }}</span>
                                    <h5 class="mb-2 ">   <i class="fa-solid fa-file-lines text-primary mr-3 "></i> Details</h5>
                                    <div class="">{{ $pizza->description }}</div>


                                </div>

                            </div>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    <div class=" mt-3 float-start">
                                        <a href="{{ route('products#listPage') }}">

                                            <button class="btn bg-secondary" type="">
                                                <i class="fa-solid fa-hand-point-left mr-2 " ></i> Back
                                                {{-- onclick="history.back()" js onclick နံ့ရေးလည်း ရ  icon ထဲအမှာ ရေးရ  to go search history  --}}
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                {{-- <div class="col-3 offset-6">
                                    <div class=" mt-3 float-lg-right ">
                                        <a href="{{ route('admin#editPage') }}">
                                            <button class="btn bg-secondary" type="">
                                                <i class="zmdi zmdi-edit mr-2"></i> Edit Profile
                                            </button>
                                        </a>
                                    </div>
                                </div> --}}
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
