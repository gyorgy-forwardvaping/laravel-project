<x-admin-master>
    @section('content')
        <h1>Create</h1>
        <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="enter title">
            </div>
            <div class="form-group">
                <label for="post_image">Image</label>
                <input type="file" name="post_image" id="post_image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="body">Content</label>
                <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>