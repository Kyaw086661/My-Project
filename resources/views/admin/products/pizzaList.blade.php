@extends('admin.layouts.master')
@section('title','Products List')

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
                                <h2 class="title-1">Products List</h2>

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
                        <form class="form-header col-3 offset-6" action="{{ route('products#listPage') }}" method="GET">
                            @csrf
                            <input class="form-control" type="text" name="searchKey" value="{{ request('searchKey') }}" placeholder="Search for datas &amp; reports..." />
                            <button class="btn btn-dark text-white" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                     </div>


                     {{-- data list  --}}

                   @if ($pizzaData->count() != 0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th> Image</th>
                                <th>Pizza Name</th>
                                <th>Price</th>
                                <th> Category</th>
                                <th>Viewer</th>
                                <th>Waiting Time</th>
                                <th> <h5 class=" text-right"> <i class="fa-solid fa-database mr-2"></i>  {{ $pizzaData->total() }} </h5></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pizzaData as $pizza )
                            <tr class="tr-shadow">
                                <td class="col-2"><img src="{{ asset('storage/'. $pizza->image) }}" class="img-thumbnail shadow-sm" alt=""></td>
                                <td>{{ $pizza->name }}</td>
                                <td>{{ $pizza->price }} $</td>
                                <td>{{ $pizza->category_name }}</td>
                                <td><i class="fa-solid fa-eye"></i> {{ $pizza->view_count }}</td>
                                <td>{{ $pizza->waiting_time }} weeks</td>
                                <td>
                                    <div class="table-data-feature">

                                       <a href="{{ route('products#updatePage',$pizza->id) }}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">

                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                       </a>
                                        <a href="{{ route('products#edit',$pizza->id) }}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="View">

                                                <i class="zmdi zmdi-eye "></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('products#delete', $pizza->id) }}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>

                    </table>
                    {{-- for pagination link  --}}
                    <div class="mt-2">
                        {{ $pizzaData->links() }}
                    </div>
                </div>
                @else
                 <h3 class="text-black-50 text-center">There is no pizza here!!</h3>
                   @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection
