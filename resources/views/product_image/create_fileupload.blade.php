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
                    <div class="text-center">{{ isset($productImage) ? 'Edit Product Image' : 'Create Product Image' }}</div>
                </h5>

                <!-- General Form Elements -->
                <form action="{{ isset($productImage) ? '/productImage/update/' . $productImage->id : '/productImage/store' }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('product_id') is-invalid @enderror" name="product_id">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product_id', $productImage->product_id ?? '') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        @if (isset($productImage) && $productImage->image)
                            <img id="oldImage" src="{{ asset('storage/product_images/' . $productImage->image) }}" alt="Uploaded Document"
                                width="100" class="cat_image">
                            <input type="hidden" class="form-control" name="oldimage" value="{{ $productImage->image }}">
                        @endif
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                        </div>
                        @error('image')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-10 text-center">
                            <button type="submit" class="btn btn-gradient-success ">
                                @if (isset($productImage))
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
