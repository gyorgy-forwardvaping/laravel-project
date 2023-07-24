<x-home-master>
    @section('content')
    @if(session('comment-add'))
    <div class="alert alert-success">{{ session('comment-add') }}</div>
  @endif
    
    <h1 class="my-4">Page Heading
        <small>Secondary Text</small>
      </h1>

      
        <!-- Title -->
        <h1 class="mt-4">{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">{{ $post->user->name }}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{ $post->updated_at }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ $post->post_image }}" alt="">

        <hr>

        <!-- Post Content -->
        {{ $post->body }}
        
        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form method="post" action="{{ route('post.comment', $post->id) }}">
              @csrf
              @method('POST')
              <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        @if (count($post->activeComments))
        @foreach ($post->activeComments as $comment)
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" width="50px" height="50px" src="{{ $comment->user->avatar }}" alt="">
          <div class="media-body">
            <h5 class="mt-0">{{ $comment->user->name }}</h5>
            {{ $comment->comment }}
          </div>
        </div>
        @endforeach
        @else
          <div class="alert alert-light" role="alert">
            No comments to show at the moment.
          </div>
        @endif
        {{-- <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <!-- Comment with nested comments -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div> --}}
    @endsection
    
</x-home-master>

