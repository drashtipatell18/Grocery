@extends('layouts.main')
@section('content')
    <style>
        .file-upload-default {
            visibility: hidden;
            position: absolute;
        }

        .form-group .file-upload-info {
            background: transparent;
        }

        .cat_image {
            margin-left: 18%;
        }
    </style>
    <div class="col-lg-8 align-content" style="margin-left: auto;margin-right: auto">
        <div class="card section-center">
            <div class="card-body">

                <h5 class="card-title">
                    <div class="text-center">{{ isset($subcategory) ? 'Edit Sub Category' : 'Create Sub Category' }}</div>
                </h5>

                <!-- General Form Elements -->
                <form action="{{ isset($subcategory) ? '/subcategory/update/' . $subcategory->id : '/subcategory/store' }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-10">
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $subcategory->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_name')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Sub Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror"
                                name="subcategory_name"
                                value="{{ old('subcategory_name', $subcategory->subcategory_name ?? '') }}">
                            @error('subcategory_name')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        @if (isset($subcategory) && $subcategory->image)
                            <img id="oldImage" src="{{ asset('images/' . $subcategory->image) }}" alt="Uploaded Document"
                                width="100" class="cat_image">
                            <input type="hidden" class="form-control" name="oldimage" value="{{ $subcategory->image }}">
                        @endif
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-10 text-center">
                            <button type="submit" class="btn btn-gradient-success ">
                                @if (isset($subcategory))
                                    Update
                                @else
                                    Save
                                @endif
                            </button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.file-upload-browse').on('click', function() {
                var file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });
            $('.file-upload-default').on('change', function() {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
        });
    </script>
@endpush
