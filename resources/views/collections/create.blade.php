@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Collection</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('collections.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name AM</label>
                            <input type="text" name="name[am]" value="{{ old('name.am') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name AM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name EN</label>
                            <input type="text" name="name[en]" value="{{ old('name.am') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name EN">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name RU</label>
                            <input type="text" name="name[ru]" value="{{ old('name.am') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name RU">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="imageUpload" name="image" class="custom-file-input">
                                    <label class="custom-file-label" for="imageUpload">Choose files</label>
                                </div>
                            </div>
                        </div>


                        <div id="imagePreview" class="row mt-3"></div>
                        <div class="form-group">
                            <div class="select2-purple">
                                <select name="products[]" class="select2" multiple="multiple" data-placeholder="Select a Products" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    @foreach($products as $item)
                                        <option value="{{$item->id}}">{{$item->title['am']}}</option>
                                    @endforeach
                                </select>
                            </div>
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
@section('script')
    <script>
        $(document).ready(function () {
            $('#imageUpload').on('change', function () {
                $('#imagePreview').empty();

                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewHtml = `
                        <div class="col-md-3 position-relative mb-3">
                            <img src="${e.target.result}" class="img-fluid rounded" alt="Image preview">
                            <button type="button" class="btn btn-danger btn-sm remove-image" style="position: absolute; top: 5px; right: 5px;">&times;</button>
                        </div>`;
                        $('#imagePreview').append(previewHtml);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Удаление изображения из превью
            $('#imagePreview').on('click', '.remove-image', function () {
                $(this).parent().remove();
            });
        });
    </script>
@endsection
