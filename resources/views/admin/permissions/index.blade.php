<x-admin-master>
    @section('content')
    @if (auth()->user()->userHasRole('Admin'))
    <div class="row">
        @if(session()->has('permission-deleted'))
            <div class="alert alert-danger">{{ session('permission-deleted') }}</div>
        @elseif(session()->has('permission-created'))
            <div class="alert alert-success">{{ session('permission-created') }}</div>
        @endif
        <div class="col-sm-3">
            <form action="{{ route('permissions.store') }}" method="post">
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
                <button type="submit" class="btn btn-primary btn-block">save new permission</button>
            </form>
        </div>
        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">permissions</h6>
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
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td><a href="{{ route('permissions.show', $permission->id) }}">{{ $permission->name }}</a></td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>
                                        <form action="{{ route('permissions.destroy',$permission) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>

                                    </td>
                                    {{-- <td>{{ $permission->created }}</td>
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