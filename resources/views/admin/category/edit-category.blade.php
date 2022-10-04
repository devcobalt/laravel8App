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
                    <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                </div>
                <div class="card-body">
                    
                    <form action="{{ url('admin/update-category/'.$category->id)}}" method="POST">
                        <div class="mb-3">
                        @csrf
                        @method('PUT')
                          <label for="category" class="form-label">Category name</label>
                          <input type="text" class="form-control" name="name" value="{{ $category->name }}" id="category" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{ $category->slug }}" id="category" aria-describedby="emailHelp">
                          </div>
                       
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="status" @if($category->status == 1) checked @endif id="flexRadioDefault1"> 
                            <label class="form-check-label" for="flexRadioDefault1">
                              Online
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="status" @if($category->status == 0) checked @endif id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                              Offline
                            </label>
                            
                          </div>
                          <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                    
                </div>
            </div>


        </div>
    </div>



@endsection