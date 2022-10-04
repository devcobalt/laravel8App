@extends('welcome')


@section('content')


    <div class="col-md-8">
      <h1 class="pb-4 mb-4 fst-italic">
        {{ $category->name }}
      </h1>



      <article class="blog-post">

        @forelse ($posts as $post)
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0">{{ $post->title }}</h3>
            <div class="mb-1 text-muted">Created at : {{ $post->created_at->format('d-m-Y') }}</div>
            <p class="mb-auto">{{ \Illuminate\Support\Str::limit($post->content, 150, $end='...') }}</p>
            <a href="{{ '/shape/'.$category->slug.'/'.$post->slug }}" class="stretched-link">Continue reading</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            @if ($post->image)
             <img src="{{ asset('uploads/posts/thumbnail/medium/'.$post->image) }}" class="img-thumbnail" width="368" alt="">
            @else
              <svg class="bd-placeholder-img" width="368" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: No Picture" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            @endif
          </div>
        </div>

       
        @empty
            <div class="alert alert-info">Non available posts</div>
        @endforelse

        <div>
          {{ $posts->links() }}
        </div>
          


        </article>

    </div>

  
@endsection
