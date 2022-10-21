@extends('admin.layouts.master')
@section('title','Order Lists')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    {{-- <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('products#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i> Add Item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div> --}}
                     <!-- start DATA TABLE -->

                     {{-- alert chect box message --}}


                     {{-- for search box  --}}
                     <div class="row">
                        <div class="col-3">
                            <h5 class="text-secondary">Search Key : <span class="text-danger">{{ request('searchKey') }}</span></h5>
                        </div>
                        <form class="form-header col-3 offset-6" action="{{ route('order#list') }}" method="GET">
                            @csrf
                            <input class="form-control" type="text" name="searchKey" value="{{ request('searchKey') }}" placeholder="Search POS numbers" />
                            <button class="btn btn-dark text-white" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>

                        </form>
                        <div class="row d-flex mb-2">
                            <div class="col-10 mt-2">
                                <form action="{{ route('order#changeStatus') }}" method="get">
                                   @csrf
                                   <div class="d-flex input-group">
                                       {{-- <label for="status" class="me-2 mt input-group-text ">Order Status:</label> --}}
                                       <select name="orderStatus" id="orderStatus" class="col-3 form-select">
                                           <option value="">All</option>
                                           <option value="0" @if (request('orderStatus')=='0') selected @endif>Pending</option>
                                           <option value="1" @if (request('orderStatus')== '1') selected @endif>Accept</option>
                                           <option value="2" @if (request('orderStatus')== '2') selected @endif>Reject</option>
                                       </select>
                                       <button type="submit" class="btn-sm btn btn-dark text-white ms-1"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-2 mt-2">
                                <h5 class=" text-right mt-2 "> <i class="fa-solid fa-database mr-2"></i> {{ $order->count() }}  </h5>
                            </div>
                    </div>

                     </div>


                     {{-- data list  --}}
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>

                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>

                            </tr>
                        </thead>

                        <tbody id="dataList">
                            @foreach ($order as $O )
                            <tr class="tr-shadow" >
                                <input type="hidden" class="orderId" value="{{ $O->id }}">
                                <td>{{ $O->user_id }}</td>
                                <td>{{ $O->user_name }}</td>
                                <td>{{ $O->created_at->format('d-M-Y') }}</td>
                                <td><a href="{{ route('order#listCode',$O->order_code) }}" class="text-primary text-decoration-none">{{ $O->order_code }}</a></td>
                                <td class="amount">{{ $O->total_price }} Kyats</td>
                                <td>
                                    <select name="status" id="" class="form-control changeStatus">
                                        <option value="0" class="text-danger" @if($O->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if($O->status == 1) selected @endif>Accept</option>
                                        <option value="2" @if($O->status == 2) selected @endif>Reject</option>

                                    </select>
                                </td>

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

@section("scriptSource")
<script>
    $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //     $status = $('#orderStatus').val();
        //     $.ajax({
        //         type:'get',
        //         url:'http://localhost:8000/order/ajax/status',
        //         dataType:'json',
        //         data:{
        //             'status': $status
        //         },
        //         success:function(response){
        //             // console.log(response);
        //             $list = '';
        //                     for ($i = 0; $i < response.length; $i++) {
        //                         $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        //                         // console.log(response[$i].created_at);
        //                         $dbDate=new Date(response[$i].created_at);
        //                         $finalDate = $months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();
        //                         // console.log($dbDate.getFullYear());
        //                         // console.log($dbDate.getDate());
        //                         // console.log($months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear());
        //                         if(response[$i].status==0){
        //                             $statusMessage = `
        //                             <select name="status" id="" class="form-control changeStatus">
        //                                 <option value="0" selected >Pending</option>
        //                                 <option value="1"  >Accept</option>
        //                                 <option value="2"  >Reject</option>

        //                             </select>`;
        //                         }else if(response[$i].status==1){
        //                             $statusMessage= `
        //                             <select name="status" id="" class="form-control changeStatus">
        //                                 <option value="0"  >Pending</option>
        //                                 <option value="1" selected >Accept</option>
        //                                 <option value="2"  >Reject</option>

        //                             </select>`;
        //                         }else if(response[$i].status==2){
        //                             $statusMessage= `
        //                             <select name="status" id="" class="form-control changeStatus">
        //                                 <option value="0"  >Pending</option>
        //                                 <option value="1"  >Accept</option>
        //                                 <option value="2" selected >Reject</option>

        //                             </select>`;
        //                         }

        //                         $list +=
        //                             `
        //                     <tr class="tr-shadow" >
        //                         <input type="hidden" class="orderId" value="${response[$i].id}">
        //                         <td> ${response[$i].user_id} </td>
        //                         <td> ${response[$i].user_name} </td>
        //                         <td> ${$finalDate} </td>
        //                         <td> ${response[$i].order_code} </td>
        //                         <td class="amount"> ${response[$i].total_price} Kyats</td>
        //                         <td>${$statusMessage}</td>

        //                     </tr>
        //                         `;

        //                     }
        //                     // console.log($list);
        //                     $('#dataList').html($list);
        //     }
        //  })
        // })
        // direct change status
        $('.changeStatus').change(function(){
            $currentStatus = $(this).val();
            $parentNote = $(this).parents("tr");
            $orderId = $parentNote.find('.orderId').val();
            // console.log($orderId);
            // console.log($parentNote.find('.amount').html());
            $data = {
                'status' :$currentStatus,
                'orderId':$orderId,
            };
            // console.log($data);
            $.ajax({
                type:'get',
                // url:'http://localhost:8000/order/ajax/changeStatus',
                url:'/order/ajax/changeStatus',

                data: $data,
                dataType:'json',
                success:function(response){

                }
            })
            // location.reload();// if you want to reload after change status
        })
    })
</script>

@endsection
