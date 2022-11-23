@extends('admin.layouts.master')
@section('title','Update Pizza')

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
                                        {{-- <a href="{{ route('products#listPage') }}">

                                        </a> --}}
                                    </div>

                                <div class="text-center title-2">
                                    <h3>Update Pizza</h3>
                                </div>
                            </div>
                            <hr>

                            <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">

                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}" id="">
                                             <img src="{{ asset('storage/'. $pizza->image) }}" alt="">

                                        <div class="mt-3">
                                            <input type="file" class="form-control @error('pizzaImage') is-invalid @enderror " name="pizzaImage" id="">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName',$pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza name...">
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" value="{{ old('pizzaPrice', $pizza->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza pizzaPrice...">
                                            @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter WaitingTime...">
                                            @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                            <div class="form-group">
                                                <label for="" class="control-label mb-1">Category</label>
                                               <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" id="">
                                                <option value="{{ old('pizzaCategory') }}">Choose Category..</option>
                                                @foreach ($category as $c )
                                                    <option value="{{ $c->id }}" @if($pizza->category_id == $c->id ) selected  @endif> {{ $c->name }}</option>
                                                @endforeach

                                            </select>
                                               @error('pizzaCategory')
                                               <div class="invalid-feedback">
                                                   {{ $message }}
                                               </div>
                                           @enderror
                                            </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Your Pizza Description" id="" cols="20" rows="5">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="viewCount" type="text" value="{{ old('viewCount', $pizza->view_count) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>

                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="createdDate" type="text" value="{{ old('createdDate', $pizza->created_at->format('d-M-Y')) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>

                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn bg-secondary float-end">
                                                {{-- <input type="submit" class="btn btn-secondary" value="Update" name="" id=""> --}}
                                               Update <i class="zmdi zmdi-edit ml-2 text-warning"></i>

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
