@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Users</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" id="exampleInputEmail1" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputEmail1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" id="exampleInputEmail1" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label mr-4" for="is_published">Is Admin:</label>
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="form-check-input mt-1" id="is_published">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label mr-4" for="is_private">Is Private:</label>
                            <input type="checkbox" name="is_private" value="1" {{ old('is_private') ? 'checked' : '' }} class="form-check-input mt-1" id="is_private">
                        </div>
                    </div>

                    <div class="card-footer" style="background-color: transparent !important;">
                        <button type="submit" class="btn btn-outline-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
