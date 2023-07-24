<x-admin-master>
    @section('content')
    @if(session('comment-approve'))
    <div class="alert alert-success">{{ session('comment-approve') }}</div>
    @elseif(session('comment-disapprove'))
    <div class="alert alert-warning">{{ session('comment-disapprove') }}</div>
    @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Comment</th>
                      <th>Post</th>
                      <th>Created</th>
                      <th>Updated</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Comment</th>
                      <th>Post</th>
                      <th>Created</th>
                      <th>Updated</th>
                      <th>Action</th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                        <td>{{ $comment->updated_at->diffForHumans() }}</td>
                        <td>
                            @if($comment->status == 1)
                            <form method="post" action="{{ route('admin.comments.approve', $comment->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-success fullwidth">Approve</button>
                                </div>
                            </form>
                            <form method="post" action="{{ route('admin.comments.disapprove', $comment->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-danger">Disapprove</button>
                                </div>
                            </form>
                            @elseif($comment->status == 2)
                            <span class="badge text-bg-success">Approved</span>
                            @else
                            <span class="badge text-bg-danger">Disapproved</span>
                            @endif
                        </td>
                      </tr>    
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        {{-- {{ $users->links() }} --}}
    @endsection
</x-admin-master>