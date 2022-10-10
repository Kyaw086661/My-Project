@extends('admin.layouts.master')
@section('title','User Lists')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                     {{-- for search box  --}}
                     {{-- <div class="row">
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
                            <div class="col-2 offset-10 mt-2 ">
                                <h5 class=" text-right mt-2 "> <i class="fa-solid fa-database mr-2"></i> Total- {{ $users->total() }} </h5>
                            </div>


                     </div> --}}

                     <div class="col-2 offset-10 mt-2 ">
                        <h5 class=" text-right mt-2 "> <i class="fa-solid fa-database mr-2"></i> Total- {{ $users->total() }} </h5>
                    </div>

                     {{-- data list  --}}
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>

                                <th>Image</th>
                                <th>Name</th>
                                {{-- <th>Email </th> --}}
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>

                            </tr>
                        </thead>

                        <tbody id="dataList">
                           @foreach ($users as $user)
                           <tr>
                            <td class="col-1">
                                @if ($user->image == null)
                                        @if ($user->gender == "male")
                                            <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                        @else
                                                <img src="{{ asset('image/default_user_female.jpeg') }}" class="img-thumbnail shadow-sm" alt="">
                                        @endif
                                @else
                                    <img src="{{ asset('storage/'. $user->image) }}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                @endif
                            </td>
                            <input type="hidden" id="userId" value="{{ $user->id }}">
                            <td>{{ $user->name }}</td>
                            {{-- <td>{{ $user->email }}</td> --}}
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td >
                                <select class="form-control-sm changeStatus">

                                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if($user->role == 'user') selected @endif>User</option>

                                </select>
                                {{-- <a href="{{ route('admin#deleteUser',$user->id) }}">

                                    <i title="delete" class="fa-solid fa-trash-can ms-2 text-danger"></i>
                                </a> --}}

                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{ route('admin#deleteUser',$user->id) }}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">

                                            <i class="fa-solid fa-trash-can me-2 text-danger"></i>
                                        </button>

                                    </a>

                                    <a href="{{ route('admin#updateUser', $user->id) }}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Update">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>

                        </tr>
                           @endforeach
                        </tbody>

                    </table>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.changeStatus').change(function(){
                $currentStatus = $(this).val();
                $parentNote = $(this).parents("tr");
                $userId = $parentNote.find('#userId').val();
                console.log($userId);
                $data = {
                    'userId' : $userId,
                    'role':$currentStatus,
                };

                $.ajax({
                    type:'get',
                    url:'http://localhost:8000/admin/change/role',
                    dataType:'json',
                    data:$data,
                    success:function(response){

                    }
                })
                location.reload();
            })
        })
    </script>
@endsection

