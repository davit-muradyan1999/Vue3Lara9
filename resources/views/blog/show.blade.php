@extends('../admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blog</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-4">
                        <div class="mr-2">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-success">Edit Blog</a>
                        </div>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-outline-danger" value="Delete">
                        </form>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $blog->id }}</td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $blog->title['am'] }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{!! $blog->description['am'] !!}</td>
                                </tr>
                                @if($blog->image)
                                    <tr>
                                        <td>Image</td>
                                        <td><img src="{{ asset('storage/'.$blog->image[0]) }}" width="100" alt=""></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
