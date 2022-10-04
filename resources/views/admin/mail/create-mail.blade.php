@extends('layouts.master')


    
@section('title','Create new mail')

@section('content')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Mails</h1>
                </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create new mail</h6>
                    </div>
                    <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach   
                        </div>
                    @endif
                        
                        <form action="{{ url('admin/send-mail')}}" method="POST">
                          

                            <div class="mb-3">
                                @csrf
                            <label for="category" class="form-label">To</label>
                            <input type="text" value="{{ old('to')}}" class="form-control" name="to" id="category" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                            <label for="category" class="form-label">Title</label>
                            <input type="text" value="{{ old('title')}}"  class="form-control" name="title" id="category" aria-describedby="emailHelp">
                            </div>
                        
                            <div class="mb-3">
                                <label for="category" class="form-label">Object</label>
                                <input type="text" value="{{ old('subject')}}"  class="form-control" name="subject" id="category" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1">Body</label>
                                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3">{{ old('body')}}</textarea>
                            </div>

                            
                          

                            <br>
                            <button type="submit" class="btn btn-primary">Send mail</button>
                        </form>
                        
                    </div>
                </div>


            </div>
        </div>



    
@endsection

