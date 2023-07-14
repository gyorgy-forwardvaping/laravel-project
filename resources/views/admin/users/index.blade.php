<x-admin-master>
    @section('content')
    @if(session('user-delete'))
    <div class="alert alert-success">{{ session('user-delete') }}</div>
  @elseif(session('create'))
    <div class="alert alert-success">{{ session('create') }}</div>
  @elseif(session('update_success'))
    <div class="alert alert-success">{{ session('update_success') }}</div>
  @elseif(session('update_fail'))
    <div class="alert alert-danger">{{ session('update_fail') }}</div>
  @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Registered</th>
                      <th>Updated</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Registered</th>
                      <th>Updated</th>
                      <th>Delete</th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>@if($user->avatar) <img width="60px" height="60px" class="img-profile rounded-circle" src="{{ asset($user->avatar) }}"> @else -@endif</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                              </form>
                        </td>
                        
                        
                      </tr>    
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        {{ $users->links() }}
    @endsection
</x-admin-master>