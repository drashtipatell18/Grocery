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
                    <div class="text-center">{{ isset($coupon) ? 'Edit Coupon' : 'Create Coupon' }}</div>
                </h5>

                <!-- General Form Elements -->
                <form action="{{ isset($coupon) ? '/coupon/update/' . $coupon->id : '/coupon/insert' }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $coupon->name ?? '') }}">
                            @error('name')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Coupon Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                name="coupon_code" value="{{ old('coupon_code', $coupon->coupon_code ?? '') }}">
                            @error('coupon_code')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="coupon_description" class="col-sm-2 col-form-label">Coupon Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('coupon_description') is-invalid @enderror" name="coupon_description" rows="4">{{ old('coupon_description', $coupon->coupon_description ?? '') }}</textarea>
                            @error('coupon_description')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                name="discount" value="{{ old('discount', $coupon->discount ?? '') }}">
                            @error('discount')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Discount Type</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('discount_type') is-invalid @enderror" name="discount_type">
                                <option value="">Select Discount Type</option>
                                <option value="percentage" {{ old('discount_type', $coupon->discount_type ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed_amount" {{ old('discount_type', $coupon->discount_type ?? '') == 'fixed_amount' ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                            @error('discount')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" value="{{ old('start_date', $coupon->start_date ?? '') }}">
                            @error('start_date')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Expiry Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror"
                                name="expiry_date" value="{{ old('expiry_date', $coupon->expiry_date ?? '') }}">
                            @error('expiry_date')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Minimum Order Amount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('minimum_order_amount') is-invalid @enderror"
                                name="minimum_order_amount" value="{{ old('minimum_order_amount', $coupon->minimum_order_amount ?? '') }}">
                            @error('minimum_order_amount')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        @if (isset($coupon) && $coupon->image)
                            <img id="oldImage" src="{{ asset('images/' . $coupon->image) }}" alt="Uploaded Document"
                                width="100" class="cat_image">
                            <input type="hidden" class="form-control" name="oldimage" value="{{ $coupon->image }}">
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
                                @if (isset($coupon))
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
