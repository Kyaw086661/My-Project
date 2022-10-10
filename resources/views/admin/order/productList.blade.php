@extends('admin.layouts.master')
@section('title','Order Lists')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                     {{-- data list  --}}
                   <div class="table-responsive table-responsive-data2">
                    <a href="{{ route('order#list') }}" class="text-dark text-decoration-none">
                        <i class="fa-solid fa-left-long"></i> Back
                    </a>
                    <div class="col-6 mt-2">
                        <div class="card">
                            <div class="card-header text-center"><h3><i class="fa-solid fa-book-open-reader me-2"></i>Order Info</h3></div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                                    <div class="col">{{ strtoUpper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-regular fa-calendar-check me-2"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-money-bill-1-wave me-2"></i>Total Price</div>
                                    <div class="col">{{ $order->total_price }} Kyats</div>
                                </div>
                                <span class="text-warning"><small><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Charges</small></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                {{-- <th>User Name</th> --}}
                                <th>Product Image</th>
                                <th>User Id</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                {{-- <th>Order Code</th> --}}
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>

                        <tbody id="dataList">
                            @foreach ($orderList as $list)
                           <tr class="tr-shadow">


                            {{-- <td>{{ $list->user_name }}</td> --}}
                            <td class="col-2"><img src="{{ asset('storage/'.$list->product_image) }}" class="img-thumbnail shadow-sm" alt=""></td>
                            <td>{{ $list->user_id }}</td>
                            <td>{{ $list->product_name }}</td>
                            <td>{{ $list->created_at->format('F-j-Y') }}</td>

                            <td>{{ $list->qty }}</td>
                            <td>{{ $list->total }}</td>

                           </tr>

                            @endforeach
                        </tbody>

                    </table>
                    {{-- for pagination link  --}}
                    <div class="mt-2">
                        {{-- {{ $order->links() }} --}}
                    </div>
                </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection

