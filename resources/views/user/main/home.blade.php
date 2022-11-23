@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by
                        categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark px-3">
                            {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                            <label class="mt-2 text-white " for="">Categories</label>
                            <span class="badge font-weight-normal">{{ count($category) }}</span>
                        </div>

                        <hr>
                        <div class=" d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('user#home') }}" class="text-black"> <label class="label" for="price-1">All</label></a>

                         </div>

                        @foreach ($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3">

                               <a href="{{ route('user#filter',$c->id) }}" class="text-black"> <label class="label" for="price-1">{{ $c->name }}</label></a>

                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('cart#list') }}">
                                <button type="button" class="btn btn-dark position-relative">
                                    <i class="fa-solid fa-cart-plus mr-2"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($cart) }}
                                    </span>
                                  </button></a>

                                  <a href="{{ route('user#history') }}" class="ms-3">
                                    <button type="button" class="btn btn-dark position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}
                                        </span>
                                      </button></a>

                            </div>




                            <div class="ml-2">
                                <div class="btn-group ">

                                    <select name="sorting" id="sortingOption" class="form-control btn btn-dark">
                                        <option value="">Sort By...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                        @foreach ($pizza as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden w-auto h-auto">
                                    <img class="img-fluid w-100" style=""
                                        src="{{ asset('storage/' . $p->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#details',$p->id) }}"><i
                                                class="fa-solid fa-circle-info"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $p->price }} $</h5>
                                        {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="pt-1"><i class="fa-solid fa-eye me-2"></i>{{ $p->view_count }} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        @else
                            <h3 class="text-danger text-center fs-2 shadow-sm py-3 col-8 offset-2"><i> Oops! there is no pizza here ! </i><i class="fa-solid fa-face-sad-tear text-warning ms-3"></i></h3>
                        @endif
                    </div>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $.ajax({
            //     type: 'get',
            //     url: '/user/ajax/pizza/list',
            //     dataType:'json',
            //     success:function(response){
            //         console.log(response);
            //     }
            // })
            $('#sortingOption').change(function() {
                // console.log('this is changing');
                $eventOption = $('#sortingOption').val();
                console.log($eventOption);
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',

                        success: function(response) {
                            // console.log(response);
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $list +=
                                    `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden w-auto h-auto">
                                <img class="img-fluid w-100 " style="height:" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>

                                </div>
                                </div>
                            </div>
                                `;

                            }
                            // console.log($list);
                            $('#dataList').html($list);

                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',

                        success: function(response) {
                            // console.log(response);
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $list +=
                                    `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden w-auto h-auto">
                                <img class="img-fluid w-100 " style="height:" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>

                                </div>
                                </div>
                            </div>
                                `;

                            }
                            // console.log($list);
                            $('#dataList').html($list);

                        }
                    })
                } else {
                    console.log('sorting yor data')
                }
            })
        })
    </script>
@endsection
