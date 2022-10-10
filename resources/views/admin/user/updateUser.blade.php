@extends('admin.layouts.master')
@section('title','Update User')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content mt-2">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title mb-4 ">

                                    <div class="">
                                        <button type="" class="btn bg-secondary float-start " onclick="history.back()">
                                            <i class="fa-solid fa-hand-point-left mr-2 " ></i>  Back
                                        </button>
                                    </div>

                                <div class="text-center title-2">
                                    <h3>Update User Info</h3>
                                </div>
                            </div>
                            <hr>

                            <form action="{{ route('admin#updateUserRole',$account->id) }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                                @if ($account->gender == "male")
                                                    <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                                @else
                                                    <img src="{{ asset('image/default_user_female.jpeg') }}" class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                        @else
                                             <img src="{{ asset('storage/' .$account->image) }}" alt="" />
                                        @endif


                                    </div>

                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled  name="name" type="text" value="{{ old('name',$account->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Role</label>
                                            {{-- <input id="cc-pament" name="role" type="text" value="{{ old('role', $account->role) }}" class="form-control" aria-required="true" aria-invalid="false" disabled> --}}

                                            <select name="role" id="" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin' ) selected @endif>Admin</option>
                                                <option value="user" @if ($account->role == 'user' ) selected  @endif>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled  name="email" type="email" value="{{ old('email', $account->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" disabled  name="phone" type="number" value="{{ old('phone', $account->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Gender</label>
                                           <select name="gender"   class="form-control @error('gender') is-invalid @enderror" id="">
                                            <option value="{{ old('gender') }}">Choose your gender..</option>
                                            <option value="male" @if ($account->gender == 'male') selected  @endif >Male</option>
                                            <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                           </select>
                                           @error('gender')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Address</label>
                                            <textarea name="address"  disabled class="form-control @error('address') is-invalid @enderror" placeholder="Enter Your Address" id="" cols="20" rows="3">{{ old('address',$account->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
