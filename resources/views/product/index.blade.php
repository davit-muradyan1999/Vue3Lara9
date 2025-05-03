@extends('../admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">

            {!! session('success') !!}
        </div>
    @endif
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('products.create') }}" class="btn btn-outline-primary">Add Product</a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                      <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td><a href="{{ route('products.show', $item->id) }}">{{ $item->id }}</a></td>
                                        <td> {{ $item->title['am'] }} </td>
                                        <td>
                                            @if ($item->images)
                                                <img src="{{ asset('storage/'.$item->images[0]) }}" width="50" height="50" alt="First Image">
                                            @endif
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
    </section>
@endsection
