@extends('layouts.master')

@section('title','Category')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Posts</h1>
        <a href="{{ url('admin/exportpdf-posts') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Exports PDF</a>
        <a href="{{ url('admin/exportxlsx-posts') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Exports XLSX</a>
        <a href="{{ url('admin/exportdoc-posts') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Exports DOC</a>

        <a href="{{ url('admin/json-posts') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Exports JSON</a>
    </div>
   
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button id="deleteAll" disabled class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-trash fa-sm text-white-50"></i> Delete selected post</button>
                
                     <a href="{{ url('admin/add-post') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Add new post</a>
            
                </div>
                <div class="card-body">
                    <div id="alert">
                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall"></th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                      

                        @forelse ($posts as $post)
                        <tbody>
                            <tr id="{{ 'pid'.$post->id }}">
                                <td><input type="checkbox" name="pid" class="check" value="{{ $post->id }}"></td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <img class="img-thumbnail" src="{{ asset('uploads/posts/thumbnail/small/'.$post->image)}}" width="100" alt="">
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($post->content, 150, $end='...') }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @foreach ($post->tag as $tag)
                                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $post->created_at }}</td>
                                <td>   
                                    @if($post->status == 1)
                                        <span class="badge badge-success">Online</span>
                                    @else
                                        <span class="badge badge-danger">Offline</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/post/'.$post->id)}}">View</a>
                                    <a href="{{ url('admin/edit-post/'.$post->id)}}">Edit</a>
                                    <a href="#" onClick="deletePost({{ $post->id }})">Delete</a>
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

    <script>
    

        function deletePost(id) {

            if(confirm('Delete this post ?')) {
                
                $.ajax({
                    url: '/admin/delete-post/'+id,
                    type:'GET',
                    data:{
                        _token : $("input[name=_token]").val()
                    },
                    success:function(response) {
                        $("#pid"+id).remove();
                        $("#alert").append('<div class="alert alert-success">Post has been deleted</div>')
                    }
                })
            }
        }
    </script>



@endsection

@section('script')
    <script>
        
        $(function() {

            $("#checkall").click(function() {
                $(".check").prop('checked', $(this).prop('checked'));

                if($('input:checkbox[name=pid]').prop('checked') == true){
                    $("#deleteAll").prop('disabled', false);
                } else {
                    $("#deleteAll").prop('disabled', true);
                }
            });
        
            $('.check').click(function() {
                
                if($('input:checkbox[name=pid]:checked').length > 0) {
                    $("#deleteAll").prop('disabled', false);
                } else {
                    $("#deleteAll").prop('disabled', true);
                }
            });

            $("#deleteAll").click(function() {
                
                var array_ids = [];
                $("input:checkbox[name=pid]:checked").each(function() {
                    array_ids.push($(this).val());
                });

                $.ajax({
                    url:'/admin/delete-posts',
                    type:'post',
                    data: {
                        _token: $('input[name=_token').val(),
                        ids : array_ids 
                    },
                    success:function(data) {
                        $.each(array_ids, function(key, val) {
                            $("#pid"+val).remove();
                        });
                        $('.alert-success').remove();
                        $("#alert").append('<div class="alert alert-success">Checked posts has been deleted</div>')
                    },
                    error:function(e) {
                        console.log('Error ! please contact developer');
                    }
                });

            });
        });

    </script>
    
@endsection