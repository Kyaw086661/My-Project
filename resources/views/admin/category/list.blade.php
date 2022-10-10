@extends('admin.layouts.master')
@section('title','Category List')

@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i> Add Category item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
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
                        <form class="form-header col-3 offset-6" action="{{ route('category#list') }}" method="GET">
                            @csrf
                            <input class="form-control" type="text" name="searchKey" value="{{ request('searchKey') }}" placeholder="Search for datas &amp; reports..." />
                            <button class="btn btn-dark text-white" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                     </div>
                     {{-- for total  --}}
                     {{-- <div class="row">
                        <div class="col-2 offset-10 bg-white text-center">
                            <h3> <i class="fa-solid fa-database"></i> {{ $categories->total() }} </h3>
                        </div>
                     </div> --}}

                     {{-- data list  --}}
                   @if ($categories->count() != 0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th> <h5 class=" text-right"> <i class="fa-solid fa-database mr-2"></i>  {{ $categories->total() }} </h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category )
                            <tr class="tr-shadow">
                                <td>{{ $category -> id }}</td>
                                <td>{{ $category -> name }}</td>

                                <td>
                                    {{ $category -> created_at ->format('j-M-Y') }}
                                </td>
                                <td>
                                    <div class="table-data-feature">

                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">

                                            <i class="zmdi zmdi-eye "></i>
                                        </button> --}}

                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button> --}}
                                        <a href="{{ route('category#edit',$category->id) }}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('category#delete',$category->id) }}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                        {{-- <button class="item me-1" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{-- for pagination link  --}}
                    <div class="mt-2">
                        {{ $categories->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
                @else
                <h3 class="text-black-50 text-center">There is no category here !! </h3>
                   @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection
