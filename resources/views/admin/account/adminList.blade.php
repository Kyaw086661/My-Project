@extends('admin.layouts.master')
@section('title','Admin List')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                     <!-- start DATA TABLE -->

                     {{-- alert chect box message --}}

                     @if (session('deleteSuccess'))
                     <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="zmdi zmdi-delete"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                     </div>
                     @endif
                     {{-- alert chect box message end  --}}
                     {{-- for search box  --}}
                     <div class="row">
                        <div class="col-3">
                            <h5 class="text-secondary">Search Key : <span class="text-danger">{{ request('searchKey') }}</span></h5>
                        </div>
                        <form class="form-header col-2 offset-7" action="{{ route('admin#list') }}" method="GET">
                            @csrf
                            <input class="form-control" type="text" name="searchKey" value="{{ request('searchKey') }}" placeholder="Search admin..." />
                            <button class="btn btn-dark text-white" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                     </div>
                     {{-- for total  --}}
                     <div class="text-end">
                        <div class="mt-2">
                            <h3> <i class="fa-solid fa-database"></i> {{ $admin->total() }} </h3>
                        </div>
                     </div>

                     {{-- data list  --}}
                   {{-- @if ($categories->count() != 0) --}}
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th> Role </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $adminList )
                            <tr class="tr-shadow">
                                <td class="col-2">
                                   @if ($adminList->image == null)
                                        @if ($adminList->gender == "male")
                                            <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm" alt="">
                                         @else
                                            <img src="{{ asset('image/default_user_female.jpeg') }}" class="img-thumbnail shadow-sm" alt="">
                                        @endif

                                    @else
                                         <img src="{{ asset('storage/'.$adminList->image) }}" alt="">
                                     @endif
                                </td>
                                <input type="hidden" value="{{ $adminList->id  }}" name="" id="userId">
                                <td>{{ $adminList->name }}</td>
                                <td>{{ $adminList->email }}</td>
                                <td>{{ $adminList->gender }}</td>
                                <td>{{ $adminList->phone }}</td>
                                <td>{{ $adminList->address }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if (Auth::user()->id == $adminList->id)
                                            {{-- <h5>Can't delete</h5> --}}
                                        @else


                                            <a href="{{ route('admin#changeRole',$adminList->id) }}">
                                                <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                    <i class="fa-solid fa-person-circle-minus me-2"></i>
                                                </button>
                                            </a>
                                            <select title="change role" class="changeRole" class="form-control">

                                                <option value="admin" @if ($adminList->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if ($adminList->role == 'user') selected @endif>User</option>
                                            </select>

                                            <a href="{{ route('admin#delete',$adminList->id) }}">
                                                <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{-- for pagination link  --}}
                    <div class="mt-2">
                        {{ $admin->links() }}

                        {{-- {{ $adminList->appends(request()->query())->links() }} --}}
                    </div>
                </div>
                {{-- @else
                <h3 class="text-black-50 text-center">There is no category here !! </h3>
                   @endif --}}
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
        $('.changeRole').change(function(){
            // console.log('change role')
            $changeRole = $(this).val();
            $parentNote = $(this).parents("tr");
            $userId = $parentNote.find('#userId').val();
            // $userId=$('#userId').val();
            // console.log($userId)
            // console.log($changeRole)
            $.ajax({
                type:'get',
                url:'http://localhost:8000/admin/ajax/changeRole',
                data:{
                    'role':$changeRole,
                    'userId':$userId,

                },
                dataType:'json',
                success:function(response){

                }
            })
            location.reload();
        })


    })
</script>

@endsection
