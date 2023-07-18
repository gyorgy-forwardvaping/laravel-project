<x-admin-master>
    @section('content')
    @if (auth()->user()->userHasRole('Admin'))
    @if(session()->has('role-updated'))
            <div class="alert alert-success">{{ session('role-updated') }}</div>
        
        @elseif(session()->has('role-not-changed'))
            <div class="alert alert-warning">{{ session('role-not-changed') }}</div>
        @elseif(session()->has('permission-add'))
            <div class="alert alert-info">{{ session('permission-add') }}</div>
        @elseif(session()->has('permission-remove'))
            <div class="alert alert-info">{{ session('permission-remove') }}</div>
        @endif
    <div class="row mb-5">
        <div class="col-sm-6">
            <h1>Edit role: {{ $role->name }}</h1>
            <form action="{{ route('roles.update', $role) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            @if ($permissions->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                    {{-- <th>Delete</th> --}}
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                    {{-- <th>Delete</th> --}}
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td><input type="checkbox" 
                                        @foreach($role->permissions as $role_permission)
                                            @if($role_permission->slug == $permission->slug)
                                                checked
                                            @endif
                                        @endforeach >
                                    </td>  
                                    <td>{{ $permission->id }}</td>
                                    <td><a href="{{ route('permissions.show', $permission->id) }}">{{ $permission->name }}</a></td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>
                                        <form method="post" action="{{ route('roles.permission.attach', $role) }}">
                                          @csrf
                                          @method('PUT')
                                          <input type="hidden" name="permission" value="{{ $permission->id }}">
                                          <button type="submit" class="btn btn-primary" @if($role->permissions->contains($permission)) disabled @endif>Attach</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('roles.permission.detach', $role) }}">
                                          @csrf
                                          @method('PUT')
                                          <input type="hidden" name="permission" value="{{ $permission->id }}">
                                          <button class="btn btn-danger"  @if(!$role->permissions->contains($permission)) disabled @endif>Detach</button></td>
                                        </form>
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('permissions.destroy',$permission) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>    
                            @endforeach
    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
    </div>
    @endif
    @endsection
</x-admin-master>