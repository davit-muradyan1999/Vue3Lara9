@extends('../admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Product</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="title" value="{{ $product->title }}" class="form-control" id="exampleInputEmail1" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="editor" name="description" rows="3">{{ $product->title }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="exampleInputEmail1" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <input type="text" name="count" value="{{ $product->count }}" class="form-control" id="exampleInputEmail1" placeholder="Count">
                    </div>
                    @if ($product->images)
                        <div id="existingImages" class="row mt-3">
                            @foreach($product->images as $image)
                                <div class="col-md-3 position-relative mb-3">
                                    <img src="{{ asset( 'storage/' . $image) }}" class="img-fluid rounded" alt="Image preview">
                                    <button type="button" class="btn btn-danger btn-sm remove-image" data-path="{{ $image }}" style="position: absolute; top: 5px; right: 5px;">&times;</button>
                                </div>
                            @endforeach
                        </div>
                    @endif

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
                        <div class="select2-purple">
                            <select name="category_id" class="select2" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                <option value="" disabled selected></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="select2-purple">
                            <select name="tags[]" class="select2" multiple="multiple" data-placeholder="Select a Tags" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ $product->tags->contains($tag->id) ? 'selected' : '' }}>{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label mr-4" for="is_published">Is Admin:</label>
                        <input type="checkbox" name="is_published" value="1" {{ $product->is_published ? 'checked' : '' }} class="form-check-input mt-1" id="is_admin">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label mr-4" for="is_private">Is Private:</label>
                        <input type="checkbox" name="is_private" value="1" {{ $product->is_private ? 'checked' : '' }} class="form-check-input mt-1" id="is_private">
                    </div>
                </div>


                <input type="hidden" name="delete_images" id="deleteImages">

                <div class="card-footer" style="background-color: transparent !important;">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        // Превью новых загружаемых изображений
        $('#imageUpload').on('change', function () {
            $('#imagePreview').empty();

            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewHtml = `
                        <div class="col-md-3 position-relative mb-3">
                            <img src="${e.target.result}" class="img-fluid rounded" alt="Image preview">
                            <button type="button" class="btn btn-danger btn-sm remove-new-image" style="position: absolute; top: 5px; right: 5px;">&times;</button>
                        </div>`;
                    $('#imagePreview').append(previewHtml);
                };
                reader.readAsDataURL(file);
            });
        });

        // Удаление новых загружаемых изображений из превью
        $('#imagePreview').on('click', '.remove-new-image', function () {
            $(this).parent().remove();
        });

        // Удаление существующих изображений
        let deleteImages = [];

        $('#existingImages').on('click', '.remove-image', function () {
            const imagePath = $(this).data('path');
            deleteImages.push(imagePath);
            $('#deleteImages').val(deleteImages.join(','));
            $(this).parent().remove();
        });
    });
</script>
@endsection
