<x-admin-master>
    @section('content')
        

        <div class="row">
          <div class="col-sm-6">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Profile - {{ $user->name }}</h6>
              </div>
              <div class="card-body">
                <form method="post" action="{{ route('user.profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img width="60px" height="60px" class="img-profile rounded-circle" src="{{ asset($user->avatar) }}">
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control"
                        value="">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                        value="{{ $user->username }}">

                        @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                        value="{{ $user->name }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                        value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                        value="">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        value="">
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        {{-- </div>
        <div class="row"> --}}
            <div class="col-sm-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              {{-- <th>Option</th> --}}
                              <th>ID</th>
                              <th>Name</th>
                              <th>Slug</th>
                              <th>Attach</th>
                              <th>Detach</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              {{-- <th>Option</th> --}}
                              <th>ID</th>
                              <th>Name</th>
                              <th>Slug</th>
                              <th>Attach</th>
                              <th>Detach</th>
                              
                            </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                {{-- <td><input type="checkbox" value="{{ $role->id }}" name="selectRole" 
                                  @foreach($user->roles as $user_role)
                                    @if($user_role->slug == $role->slug)
                                      checked
                                    @endif
                                  @endforeach
                                  ></td>                               --}}
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                  <form method="post" action="{{ route('user.role.attach', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{ $role->id }}">
                                    <button type="submit" class="btn btn-primary" @if($user->roles->contains($role)) disabled @endif>Attach</button>
                                  </form>
                                </td>
                                <td>
                                  <form method="post" action="{{ route('user.role.detach', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{ $role->id }}">
                                    <button class="btn btn-danger"  @if(!$user->roles->contains($role)) disabled @endif>Detach</button></td>
                                  </form>
                                </td>
                              </tr>    
                            @endforeach
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>