@extends('user.layouts.master')
@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-9 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Pizza Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($cartList as $list )
                       <tr>
                        {{-- <input type="hidden" name="" value="{{ $list->pizza_price }}" id="price"> --}}

                        <td class="align-middle" ><img src="{{ asset('storage/'.$list->pizza_image) }}" alt="" style="width: 50px" class="mr-2 h-auto shadow-sm"></td>
                        <td class="align-middle">
                            {{ $list->pizza_name }}

                            <input type="hidden" name="" id="cartId" value="{{ $list->id }}">
                            <input type="hidden" name="" id="productId" value="{{ $list->product_id }}">
                            <input type="hidden" name="" id="userId" value="{{ $list->user_id }}">
                        </td>
                        <td class="align-middle" id="price">{{ $list->pizza_price }}Kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="qty" value="{{ $list->qty }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle col-3" id="total">{{ $list->pizza_price * $list->qty }} Kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" id="btnRemove"><i class="fa fa-times"></i></button></td>
                    </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-dark p-2 form-control text-white pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium" id="delivery">2500 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{ $totalPrice + 2500 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-2" id="orderId">
                            <span class="text-white">Proceed To Checkout</span>
                        </button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-2" id="clearBtn">
                            <span class="text-white">Clear Order</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection
    @section('scriptSource')
        <script>
            $(document).ready(function(){

                // when + button click
                $('.btn-plus').click(function(){
                    // mouseleave //
                    // console.log('Plus');
                    $parentNote = $(this).parents("tr");
                    $price = Number($parentNote.find('#price').text().replace('Kyats',''));
                    $qty = Number($parentNote.find('#qty').val());
                    $total=$price*$qty;
                    // console.log($price);
                    // console.log($total);
                    // console.log($price +" "+ $qty);
                    $parentNote.find('#total').html($total+"Kyats");
                    summaryCalculation()
                //     $totalPrice= 0;
                // $('#dataTable tr').each(function(index,row){
                //     $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));//*1
                // });
                // // console.log($totalPrice);

                //  $('#subTotal').html(`${$totalPrice} Kyats`);
                //  $('#finalTotal').html(`${$totalPrice + 2500} Kyats`)

                });

                //when - button click
                $('.btn-minus').click(function(){
                    // console.log('minus');
                    $parentNote = $(this).parents("tr");
                    $price= Number($parentNote.find('#price').text().replace('Kyats',''));//text ,html val get
                    $qty = $parentNote.find('#qty').val();
                    // console.log($price)
                    $total = $price * $qty;
                    $parentNote.find('#total').html($total+"Kyats");
                    summaryCalculation()
                    // $totalPrice= 0;
                    // $('#dataTable tr').each(function(index,row){
                    //    $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
                    // })
                    // $('#subTotal').html(`${$totalPrice} Kyats`);
                    // $('#finalTotal').html(`${$totalPrice + 2500} Kyats`)
                });
                //when cross button click
                $('.btnRemove').click(function(){
                    $parentNote = $(this).parents("tr");
                    $productId = $parentNote.find("#productId").val( );
                    $cartId = $parentNote.find('#cartId').val();
                    // console.log($productId);
                    $.ajax({
                        type:'get',
                        url:'http://localhost:8000/user/ajax/clear/current/product',
                        data:{'productId': $productId, 'cartId' : $cartId},
                        dataType:'json',
                    })
                    $parentNote.remove();
                    summaryCalculation()
                    // $totalPrice= 0;
                    // $('#dataTable tr').each(function(index,row){
                    //    $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
                    // })
                    // $('#subTotal').html(`${$totalPrice} Kyats`);
                    // $('#finalTotal').html(`${$totalPrice + 2500} Kyats`)

                })

                // when click proceed to check out for order
                $('#orderId').click(function(){
                    $orderList = [];
                    $random = Math.floor(Math.random() * 10000000001)
                    // console.log($random);
                    $('#dataTable tbody tr ').each(function(index,row){
                        $orderList.push({
                            'user_id' : $(row).find('#userId').val(),
                            'product_id' : $(row).find('#productId').val(),
                            'qty' : $(row).find('#qty').val(),
                            'total' : $(row).find('#total').text().replace('Kyats','')*1,
                            'order_code' : 'POS'+ $random,

                        });
                    })
                    // console.log($orderList);
                    $.ajax({
                        type : 'get',
                        url :'http://localhost:8000/user/ajax/order',
                        data: Object.assign({},$orderList),
                        dataType :'json',
                        success : function(response){
                            // console.log(response);
                            if(response.status== 'true'){
                                window.location.href="http://localhost:8000/user/homePage";
                            }
                        }
                    })
                });
                 // clear order from cart
                 $('#clearBtn').click(function(){
                        $('#dataTable tbody tr').remove();
                        $('#subTotal').html("0 Kyats");
                        $('#finalTotal').html("2500 Kyats");
                        // $('#delivery').html("0 Kyats");
                        $.ajax({
                            type : 'get',
                            url:'http://localhost:8000/user/ajax/clear/cart',
                            dataType:'jsom',
                        })


                    });



                // calculate final price
                function summaryCalculation(){
                    $totalPrice= 0;
                    $('#dataTable tbody tr').each(function(index,row){
                       $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
                    })
                    $('#subTotal').html(`${$totalPrice} Kyats`);
                    $('#finalTotal').html(`${$totalPrice + 2500} Kyats`)
                }
            })
        </script>
    @endsection

