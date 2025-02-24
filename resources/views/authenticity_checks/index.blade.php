@extends('../admin')
@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('authenticity.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choose File xlsx:</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

        <hr>

        <h4>Authenticity Checks:</h4>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barcode</th>
                    <th>Title</th>
                    <th>Item</th>
                    <th>Gold</th>
                    <th>Silver</th>
                    <th>Stone</th>
                    <th>Other Materials</th>
                    <th>Exclusive Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <form action="{{ route('authenticity.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td>{{ $product->id }}</td>
                            <td><input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control" required></td>
                            <td><input type="text" name="title" value="{{ $product->title }}" class="form-control"></td>
                            <td><input type="text" name="item" value="{{ $product->item }}" class="form-control"></td>
                            <td><input type="text" name="gold" value="{{ $product->gold }}" class="form-control"></td>
                            <td><input type="text" name="silver" value="{{ $product->silver }}" class="form-control"></td>
                            <td><input type="text" name="stone" value="{{ $product->stone }}" class="form-control"></td>
                            <td><input type="text" name="other_materials" value="{{ $product->other_materials }}" class="form-control"></td>
                            <td><input type="text" name="price_exclusive" value="{{ $product->price_exclusive }}" class="form-control"></td>
                            <td>
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                <a href="{{ route('authenticity.delete', $product->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">Delete</a>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Нет загруженных товаров</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
