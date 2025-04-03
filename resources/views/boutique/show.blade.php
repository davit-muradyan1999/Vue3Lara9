@extends('../admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Boutique</h1>
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
                            <a href="{{ route('boutiques.edit', $boutique->id) }}" class="btn btn-outline-success">Edit Boutique</a>
                        </div>
                        <form action="{{ route('boutiques.destroy', $boutique->id) }}" method="post">
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
                                    <td>{{ $boutique->id }}</td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $boutique->title['am'] }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{!! $boutique->description['am'] !!}</td>
                                </tr>
                                @if($boutique->image)
                                    <tr>
                                        <td>Image</td>
                                        <td><img src="{{ asset('storage/'.$boutique->image[0]) }}" width="100" alt=""></td>
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
