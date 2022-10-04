@extends('layouts.master')

@section('title','Surfing Dashboard')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Log Activity List</h1>
   
</div>

 <!-- Content Row -->
 <div class="row">

    <div class="col-lg-12">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date Time</th>
                            <th>Subject</th>
                            <th>URL</th>
                            <th>Method</th>
                            <th>Ip</th>
                            <th width="300px">User Agent</th>
                            <th>User Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($logs->count())
                            @foreach($logs as $key => $log)
                            <tr>
                                <td><span class="badge badge-secondary">{{ $log->created_at }}</span></label></td>
                                <td>{{ $log->subject }}</td>
                                <td class="text-success">{{ $log->url }}</td>
                                <td><span class="badge badge-warning">{{ $log->method }}</span></label></td>
                                <td><span class="badge badge-dark">{{ $log->ip }}</span></label></td>
                                <td class="text-danger">{{ $log->agent }}</td>
                                <td>{{ $log->user_id }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    <div>
                        {{ $logs->links() }}
                    </div>
                
            </div>
        </div>


    </div>
</div>

@endsection