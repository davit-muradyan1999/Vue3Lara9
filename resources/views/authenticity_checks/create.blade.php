@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Auth Check</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('authenticity.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product">Choose Product</label>
                            <select name="product_id" id="product" class="form-control">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->title['am'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" id="barcode" class="form-control" value="{{ old('barcode') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" name="item" id="item" class="form-control" value="{{ old('item') }}">
                        </div>
                        <div class="form-group">
                            <label for="gold">Gold</label>
                            <input type="text" name="gold" id="gold" class="form-control" value="{{ old('gold') }}">
                        </div>
                        <div class="form-group">
                            <label for="silver">Silver</label>
                            <input type="text" name="silver" id="silver" class="form-control" value="{{ old('silver') }}">
                        </div>
                        <div class="form-group">
                            <label for="stone">Stone</label>
                            <input type="text" name="stone" id="stone" class="form-control" value="{{ old('stone') }}">
                        </div>
                        <div class="form-group">
                            <label for="other_materials">Other Materials</label>
                            <input type="text" name="other_materials" id="other_materials" class="form-control" value="{{ old('other_materials') }}">
                        </div>
                        <div class="form-group">
                            <label for="handcrafted">Handcrafted</label>
                            <input type="text" name="handcrafted" id="handcrafted" class="form-control" value="{{ old('handcrafted') }}">
                        </div>
                        <div class="form-group">
                            <label for="price_exclusive">Exclusive Price</label>
                            <input type="text" name="price_exclusive" id="price_exclusive" class="form-control" value="{{ old('price_exclusive') }}">
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
