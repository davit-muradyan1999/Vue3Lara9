@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Product</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"> Title </label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price"> Price </label>
                            <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="price" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="count"> Count </label>
                            <input type="text" name="count" value="{{ old('count') }}" class="form-control" id="count" placeholder="Count">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="imageUpload" name="images[]" multiple class="custom-file-input">
                                    <label class="custom-file-label" for="imageUpload">Choose files</label>
                                </div>
                            </div>
                        </div>

                        <div id="imagePreview" class="row mt-3"></div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <div class="select2-purple">
                                <select name="category_id" id="category" class="select2" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option value="" disabled selected></option>
                                   @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tag">Tags</label>
                            <div class="select2-purple">
                                <select name="tags[]" id="tag" class="select2" multiple="multiple" data-placeholder="Select a Tags" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label mr-4" for="is_published">Is Published:</label>
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="form-check-input mt-1" id="is_admin">
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
