<x-admin-master>
    @section('content')
    @if (auth()->user()->userHasRole('Admin'))
    @if(session()->has('permission-updated'))
            <div class="alert alert-success">{{ session('permission-updated') }}</div>
        
        @elseif(session()->has('permission-not-changed'))
            <div class="alert alert-warning">{{ session('permission-not-changed') }}</div>
        @elseif(session()->has('permission-add'))
            <div class="alert alert-info">{{ session('permission-add') }}</div>
        @elseif(session()->has('permission-remove'))
            <div class="alert alert-info">{{ session('permission-remove') }}</div>
        @endif
    <div class="row mb-5">
        <div class="col-sm-6">
            <h1>Edit role: {{ $permission->name }}</h1>
            <form action="{{ route('permissions.update', $permission) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $permission->name }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    @endif
    @endsection
</x-admin-master>