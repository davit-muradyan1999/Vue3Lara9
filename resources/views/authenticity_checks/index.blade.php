@extends('../admin')
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('authenticity.add') }}" class="btn btn-outline-primary">Add Auth Check</a>
    </div>
    <div class="card-body">

        <form action="{{ route('authenticity.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-25">
                <label for="file">Choose File (.xlsx):</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="file" required onchange="document.getElementById('fileLabel').innerText = this.files[0].name">
                        <label class="custom-file-label" for="file" id="fileLabel">Choose file</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Document</button>
        </form>

        <hr>

        <h4>Authenticity Checks:</h4>

        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>item ID</th>
                        <th>Barcode</th>
                        <th>Title</th>
                        <th>Item</th>
                        <th>Gold</th>
                        <th>Silver</th>
                        <th>Stone</th>
                        <th>Other Materials</th>
                        <th>Handcrafted</th>
                        <th>Exclusive Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authCheck as $item)
                        <tr>
                            <form action="{{ route('authenticity.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <select name="product_id" class="form-control">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                {{ $product->title['am'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="barcode" value="{{ $item->barcode }}" class="form-control" required></td>
                                <td><input type="text" name="title" value="{{ $item->title }}" class="form-control"></td>
                                <td><input type="text" name="item" value="{{ $item->item }}" class="form-control"></td>
                                <td><input type="text" name="gold" value="{{ $item->gold }}" class="form-control"></td>
                                <td><input type="text" name="silver" value="{{ $item->silver }}" class="form-control"></td>
                                <td><input type="text" name="stone" value="{{ $item->stone }}" class="form-control"></td>
                                <td><input type="text" name="other_materials" value="{{ $item->other_materials }}" class="form-control"></td>
                                <td><input type="text" name="handcrafted" value="{{ $item->handcrafted }}" class="form-control"></td>
                                <td><input type="text" name="price_exclusive" value="{{ $item->price_exclusive }}" class="form-control"></td>
                                <td class="d-flex">
                                    <button type="submit" class="btn btn-sm btn-success mr-2">Update</button>
                                    <a href="{{ route('authenticity.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">Delete</a>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
