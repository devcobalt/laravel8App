@extends('welcome')


@section('content')


    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic">
        Latest Posts
      </h3>

      @forelse ($latest_posts as $post)
                  
      <article class="blog-post">

        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-success">{{ $post->category->name }}</strong>
              <h3 class="mb-0">{{ $post->title }}</h3>
              <div class="mb-1 text-muted">Created at ; {{ $post->created_at }}</div>
              <p class="mb-auto">{{ \Illuminate\Support\Str::limit($post->content, 150, $end='...') }}</p>
              
              <p>
                @foreach ($post->tag as $tag)
              <span class="badge bg-secondary">{{ $tag->name }}</span>
              @endforeach
              </p>
              <a href="{{ '/shape/'.$post->category->slug.'/'.$post->slug }}" class="stretched-link">Continue reading</a>
            
            </div>
            <div class="col-auto d-none d-lg-block">
              @if ($post->image)
              <img src="{{ asset('uploads/posts/thumbnail/medium/'.$post->image) }}" class="img-thumbnail" width="368" alt="">
          
              @else
              <svg class="bd-placeholder-img" width="368" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: No Picture" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            
              @endif
                </div>
          </div>
        </article>
      
      @empty
        <div class="alert alert-info">No posts available</div>
      @endforelse

    </div>

    

 
@endsection
