@extends('user.layouts.master')
@section('content')

    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-9 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-3" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($order as $O)
                       <tr>
                        <td class="align-middle" >{{ $O->created_at->format('d-M-Y') }}</td>
                       <td class="align-middle" >{{ $O->order_code }}</td>
                       <td class="align-middle " >{{ $O->total_price }} $</td>
                       <td class="align-middle" >
                        @if ($O->status == 0)
                            <span class="text-warning"><i class="fa-solid fa-clock-rotate-left me-2"></i> Pending...</span>
                        @elseif($O->status == 1)
                        <span class="text-success"> <i class="fa-solid fa-check me-2" ></i>Success...</span>
                        @elseif($O->status == 2)
                        <span class="text-danger"><i class="fa-solid fa-circle-exclamation me-2"></i>Reject...</span>

                        @endif
                       </td>
                       </tr>

                       @endforeach
                    </tbody>
                </table>
                <span>{{ $order->links() }}</span>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection



