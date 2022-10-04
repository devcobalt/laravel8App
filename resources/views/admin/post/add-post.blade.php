@extends('layouts.master')

@section('title','Add post')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Posts</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add new post</h6>
                </div>
                <div class="card-body">

                  @if($errors->any())
                    <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                          <div>{{ $error }}</div>
                      @endforeach   
                    </div>
                  @endif
                    
                    <form action="{{ url('admin/add-post')}}" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            @csrf
                            <label for="category" class="form-label">Category name</label>
                            <select class="form-control" name="category_id">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>  
                               @endforeach
                            </select> 
                              
                        </div>

                        <div class="mb-3">
                          <label for="tag" class="form-label">Tag</label>
                          <select name="tag[]" class="form-control" multiple aria-label="multiple select example" id="tag">
                            @foreach ($tags as $tag)
                              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                            
                          </select>
                        </div>

                        <div class="mb-3">
                          <label for="category" class="form-label">Title</label>
                          <input type="text" value="{{ old('title')}}" class="form-control" name="title" id="category" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                          <label for="category" class="form-label">Slug</label>
                          <input type="text" value="{{ old('slug')}}"  class="form-control" name="slug" id="category" aria-describedby="emailHelp">
                        </div>
                       
                        <div class="mb-3">
                          <label for="exampleFormControlFile1">Picture</label>
                          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                         <div class="mb-3">
                            <label for="exampleFormControlTextarea1">Content</label>
                            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3">{{ old('content')}}</textarea>
                        </div>

                        
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="1" name="status" id="flexRadioDefault1" checked>
                          <label class="form-check-label" for="flexRadioDefault1">
                            Online
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2">
                          <label class="form-check-label" for="flexRadioDefault2">
                            Offline
                          </label>
                          
                        </div>
                        <br>
                        <h3>SEO</h3>
                        <hr>
                        <div class="mb-3">
                          <label for="metakeyword" class="form-label">Meta keyword</label>
                          <textarea class="form-control" name="meta_keyword" id="metakeyword" rows="3"></textarea>
                       </div>
                      
                      <div class="mb-3">
                          <label for="exampleFormControlTextarea1">Meta description</label>
                          <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>

                          <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                    
                </div>
            </div>


        </div>
    </div>



@endsection