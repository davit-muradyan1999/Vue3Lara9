@extends('../admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                            <input type="text" name="full_name" value="{{ $user->full_name }}" class="form-control" id="exampleInputEmail1" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" value="{{ $user->password }}" class="form-control" id="exampleInputEmail1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control" id="exampleInputEmail1" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label mr-4" for="is_admin">Is Admin:</label>
                            <input type="hidden" name="is_admin" value="0">
                            <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }} class="form-check-input mt-1" id="is_admin">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label mr-4" for="is_private">Is Private:</label>
                            <input type="hidden" name="is_private" value="0">
                            <input type="checkbox" name="is_private" value="1" {{ $user->is_private ? 'checked' : '' }} class="form-check-input mt-1" id="is_private">
                        </div>
                </div>

                <div class="card-footer" style="background-color: transparent !important;">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
