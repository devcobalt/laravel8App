@extends('welcome')


@section('title',$post->title)


@section('content')


<div class="col-md-8">
    <article class="blog-post">
        <h2 class="blog-post-title mb-1">{{ $post->title }}</h2>
        <p class="blog-post-meta">Created at : {{ $post->created_at->format('d-m-Y') }}</p>

        <p>{{ $post->content }}</p>
         
          </article>

          <nav class="blog-pagination" aria-label="Pagination">
            <a class="btn btn-outline-primary rounded-pill" href="#">Back</a>
          </nav>

    
  </div>


@endsection