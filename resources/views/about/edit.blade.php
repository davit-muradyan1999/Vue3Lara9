@extends('../admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit About</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('abouts.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <label for="title"> Title AM</label>
                    <input type="text" name="title[am]" value="{{ $about->title['am'] }}" class="form-control" id="exampleInputEmail1" placeholder="Title AM">
                </div>
                <div class="form-group">
                    <label for="title"> Title EN</label>
                    <input type="text" name="title[en]" value="{{ $about->title['en'] }}" class="form-control" id="exampleInputEmail1" placeholder="Title EN">
                </div>
                <div class="form-group">
                    <label for="title"> Title RU</label>
                    <input type="text" name="title[ru]" value="{{ $about->title['ru'] }}" class="form-control" id="exampleInputEmail1" placeholder="Title RU">
                </div>
                <div class="form-group">
                    <label for="description">Description AM</label>
                    <textarea class="form-control" id="description" name="description[am]" rows="3">{{ $about->description['am'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description EN</label>
                    <textarea class="form-control" id="description" name="description[en]" rows="3">{{ $about->description['en'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description RU</label>
                    <textarea class="form-control" id="description" name="description[ru]" rows="3">{{ $about->description['ru'] }}</textarea>
                </div>
                    @if ($about->image)
                        <div id="existingImages" class="row mt-3">
                            <div class="col-md-3 position-relative mb-3">
                                <img src="{{ asset( 'storage/' . $about->image[0]) }}" class="img-fluid rounded" alt="Image preview">
                                <button type="button" class="btn btn-danger btn-sm remove-image" data-path="{{ $about->image[0] }}" style="position: absolute; top: 5px; right: 5px;">&times;</button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="imageUpload" name="image"  class="custom-file-input">
                                <label class="custom-file-label" for="imageUpload">Choose files</label>
                            </div>
                        </div>
                    </div>

                    <div id="imagePreview" class="row mt-3"></div>
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
