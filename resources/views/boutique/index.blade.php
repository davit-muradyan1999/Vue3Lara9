@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Boutiques</h1>
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
                            <a href="{{ route('boutiques.create') }}" class="btn btn-outline-primary">Add Boutique</a>
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
                                    @foreach ($boutiques as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ route('blogs.show', $item->id) }}">{{ $item->title['am'] }}</a></td>
                                        @if($item->image)
                                            <td><img src="{{ asset('storage/'.$item->image[0]) }}" alt="" width="50" height="50"></td>
                                        @endif
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
