@extends('../admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create About</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"> Title AM</label>
                            <input type="text" name="title[am]" value="{{ old('title.am') }}" class="form-control" id="title" placeholder="Title AM">
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
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="imageUpload" name="image" class="custom-file-input">
                                    <label class="custom-file-label" for="imageUpload">Choose files</label>
                                </div>
                            </div>
                        </div>


                        <div id="imagePreview" class="row mt-3"></div>
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
                .create(document.querySelector('#editor_am'))
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
