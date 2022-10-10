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
                        <div class="card-body p-5">
                                    <div class="card-title mb-4">
                                        <div class="text-center title-2">
                                            <h3>Message Details</h3>
                                        </div>
                                    </div>
                                    <div class="mb-2 ">
                                    <label for="name">Name - </label>
                                        {{ $message->name }}
                                    </div>
                                    <div class="mb-2 ">
                                        <label for="name">Email - </label>
                                        {{ $message->email }}
                                    </div>
                                    <div class="mb-2 ">
                                        <label for="name">Subject - </label>
                                        {{ $message->subject }}
                                    </div>
                                    <div class="mb-2 ">
                                        <label for="name">Message - </label>
                                        {{ $message->message }}
                                    </div>


                                    <div class=" mt-3 text-end">
                                        <a href="{{ route('admin#userContact') }}">

                                            <button class="btn bg-secondary" type="">
                                                <i class="fa-solid fa-hand-point-left mr-2 " ></i> Back
                                                {{-- onclick="history.back()" js onclick နံ့ရေးလည်း ရ  icon ထဲအမှာ ရေးရ  to go search history  --}}
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
    <!-- END MAIN CONTENT-->
@endsection
