@extends('user.layouts.master')
@section('content')
     <!-- MAIN CONTENT-->
     @if (session('changeSuccess'))
            <div class="col-4 offset-7 mt-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small><i class="zmdi zmdi-lock"></i>
                        {{ session('changeSuccess') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
        </div>
        @endif
     <div class="main-content mt-2">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="text-center title-2">
                                    <h3>Account Profile</h3>
                                </div>
                            </div>
                            <hr>

                            <form action="{{ route('account#change',Auth::user()->id) }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == "male")
                                                    <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                                @else
                                                    <img src="{{ asset('image/default_user_female.jpeg') }}" class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                        @else
                                             <img src="{{ asset('storage/' .Auth::user()->image) }}" class="img-thumbnail shadow-sm" alt="" />
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror " name="image" id="">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" value="{{ old('phone', Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Gender</label>
                                           <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                            <option value="{{ old('gender') }}">Choose your gender..</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected  @endif >Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                           </select>
                                           @error('gender')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Your Address" id="" cols="20" rows="3">{{ old('address',Auth::user()->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" value="{{ old('role', Auth::user()->role) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>

                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn bg-secondary float-end">
                                                {{-- <input type="submit" class="btn btn-secondary" value="Update" name="" id=""> --}}
                                               Change <i class="zmdi zmdi-edit ml-2 text-warning"></i>

                                            </button>
                                        </div>

                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
