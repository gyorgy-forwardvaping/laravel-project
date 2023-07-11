<x-admin-master>
    @section('content')
        <h1>Edit Post {{ $post->title }}</h1>
        <form method="post" action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control" placeholder="enter title">
            </div>
            <div class="form-group">
                <label for="post_image">Image</label>
                <input type="file" value="{{ $post->post_image }}" name="post_image" id="post_image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="post_current_image">Current image</label>
                <div>
                    <img height="100px" src="{{ $post->post_image }}">
                </div>
            </div>
            <div class="form-group">
                <label for="body">Content</label>
                <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ $post->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>