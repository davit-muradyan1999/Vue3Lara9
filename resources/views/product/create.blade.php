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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group">


                            <label for="title"> Title AM</label>
                            <input type="text" name="title[am]" value="{{ old('title.am') }}" class="form-control" id="title" placeholder="Title AM" required>
                        </div>
                        <div class="form-group">
                            <label for="title"> Title EN</label>
                            <input type="text" name="title[en]" value="{{ old('title.en') }}" class="form-control" id="title" placeholder="Title EN">
                        </div>
                        <div class="form-group">
                            <label for="title"> Title RU</label>
                            <input type="text" name="title[ru]" value="{{ old('title.ru') }}" class="form-control" id="title" placeholder="Title RU">
                        </div>
                        <div class="form-group">
                            <label for="description">Description AM</label>
                            <textarea class="form-control" id="editor_am" name="description[am]" rows="3">{{ old('description.am') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description EN</label>
                            <textarea class="form-control" id="editor_en" name="description[en]" rows="3">{{ old('description.en') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description RU</label>
                            <textarea class="form-control" id="editor_ru" name="description[ru]" rows="3">{{ old('description.ru') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="count"> Count </label>
                            <input type="text" name="count" value="{{ old('count') }}" class="form-control" id="count" placeholder="Count">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="imageUpload" name="images[]" multiple class="custom-file-input" required>
                                    <label class="custom-file-label" for="imageUpload">Choose files</label>
                                </div>
                            </div>
                        </div>

                        <div id="imagePreview" class="row mt-3"></div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <div class="select2-purple">
                                <select name="category_id" id="category" class="select2" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                    <option value="" disabled selected></option>
                                   @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title['am']}}</option>
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
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="form-check-input mt-1" id="is_published">
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

        ClassicEditor
            .create(document.querySelector('#editor_am'), {
            validation: {
                required: true
            }
    })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor_en'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor_ru'))
            .catch(error => {
                console.error(error);
            });

    });
</script>
@endsection
