<x-admin-master>
    @section('content')
        <h1>All Post</h1>
  @if(session('delete'))
    <div class="alert alert-danger">{{ session('delete') }}</div>
  @elseif(session('create'))
    <div class="alert alert-success">{{ session('create') }}</div>
  @elseif(session('update_success'))
    <div class="alert alert-success">{{ session('update_success') }}</div>
  @elseif(session('update_fail'))
    <div class="alert alert-danger">{{ session('update_fail') }}</div>
  @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></td>
                        <td><img src="{{ asset($post->post_image) }}" height="40px"></td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans()  }}</td>
                        <td>
                          @can('view', $post)

                          <form action="{{ route('post.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                          </form>
                          
                          @endcan
                        </td>
                      </tr>    
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
        </div>
          {{ $posts->links() }}
    @endsection

    @section('scripts')
     <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{ asset('js/datatables-script.js') }}"></script> --}}
    @endsection
</x-admin-master>