<x-admin-master>
    @section('content')
    @if (auth()->user()->userHasRole('Admin'))
    <div class="row">
        @if(session()->has('role-deleted'))
            <div class="alert alert-danger">{{ session('role-deleted') }}</div>
        @elseif(session()->has('role-created'))
            <div class="alert alert-success">{{ session('role-created') }}</div>
        @endif
        <div class="col-sm-3">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <div>
                        @error('name')
                        <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">save new role</button>
            </form>
        </div>
        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                    {{-- <th>Created</th> --}}
                                    {{-- <th>Updated</th> --}}
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                    {{-- <th>Created</th> --}}
                                    {{-- <th>Updated</th> --}}
                                    
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></td>
                                    <td>{{ $role->slug }}</td>
                                    <td>
                                        <form action="{{ route('roles.destroy',$role) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>

                                    </td>
                                    {{-- <td>{{ $role->created }}</td>
                                    <td>{{ $role->id }}</td> --}}
                                </tr>    
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection
</x-admin-master>