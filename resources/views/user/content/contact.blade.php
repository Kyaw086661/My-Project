@extends('user.layouts.master')
@section('content')

    <!-- Cart Start -->
    <div class="container-fluid ">
        <div class="row px-xl-5">
            <div class="col-lg-6 offset-3 table-responsive mb-3 ">
                <div class="card">
                    <div class="card-body px-xl-5">
                        <div class="card-title mb-4 ">
                            <div class="text-center title-2">
                                <h3>Connect to admin</h3>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('user#contact') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="row mb-3">
                                    <div class="col-6">

                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Enter your name...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Enter your emal...">
                                    @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="">
                                        <label for="subject">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" name="subject" placeholder="Enter your subject...">
                                    @error('subject')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="">
                                        <label for="message">Message</label>
                                        <textarea name="message"  class="form-control @error('message') is-invalid @enderror" cols="20" rows="7" placeholder="Enter your message...">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 mt-3 offset-8">
                                   <button type="submit" class="btn btn-dark form-control">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection




