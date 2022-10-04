@php
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=file.doc");
@endphp
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <h2>Latest Posts</h2>
   
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Created at</th>
                <th>Status</th>
            </tr>
        </thead>
      

        @forelse ($posts as $post)
        <tbody>
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td>   
                    @if($post->status == 1)
                        Online
                    @else
                        Offline
                    @endif
                </td>
                
            </tr>
        @empty
            <tr>
                <td colspan="2">
                    No data available
                </td>
            </tr>
        @endforelse
    </tbody>
    </table>
  </body>
</html>