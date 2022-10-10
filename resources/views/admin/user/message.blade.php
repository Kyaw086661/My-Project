@extends('admin.layouts.master')
@section('title','Customer Message')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                  <div class="col-2 offset-10 mt-2 ">
                        <h5 class=" text-right mt-2 "> <i class="fa-solid fa-database mr-2"></i> Total-{{ $userMessage->total() }}  </h5>
                    </div>

                     {{-- data list  --}}
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                        </thead>

                        <tbody id="dataList">
                           @foreach ($userMessage as $message)
                           <tr>
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{ route('admin#contactDelete',$message->id) }}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">

                                            <i class="fa-solid fa-trash-can me-2 text-danger"></i>
                                        </button>

                                    </a>

                                    <a href="{{ route('admin#viewContact',$message->id) }}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>

                        </tr>
                           @endforeach
                        </tbody>

                    </table>
                    <div class="mt-3">
                        {{ $userMessage->links() }}
                    </div>
                </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection


