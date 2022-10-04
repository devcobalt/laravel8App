@extends('layouts.master')

@section('title','Category')


@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

   


    <!-- Content Row -->
    <div class="row">

      

        <div class="col-lg-12">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                    
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                      

                        @forelse ($categories as $category)
                        <tbody>
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>   
                                    @if($category->status == 1)
                                        <span class="badge badge-success">Online</span>
                                    @else
                                        <span class="badge badge-danger">Offline</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category->id)}}">View</a>
                                    <a href="{{ url('admin/edit-category/'.$category->id)}}">Edit</a>
                                    <a href="{{ url('admin/delete-category/'.$category->id)}}">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-info">No data available</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                    
                </div>
            </div>


        </div>
    </div>



@endsection