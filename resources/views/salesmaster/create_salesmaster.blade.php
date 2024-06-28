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
                    <div class="text-center">{{ isset($salesmaster) ? 'Edit SalesMaster' : 'Create SalesMaster' }}</div>
                </h5>
                <!-- General Form Elements -->
                <form action="{{ isset($salesmaster) ? '/salesmaster/update/' . $salesmaster->id : '/salesmaster/insert' }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">User Name</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">Select User</option>
                                @foreach ($users as $id => $name)
                                    <option value="{{ $id }}" {{ old('user_id', $salesmaster->user_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Coupon Name</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('coupon_id') is-invalid @enderror" name="coupon_id">
                                <option value="">Select Coupon</option>
                                @foreach ($coupons as $id => $coupon)
                                    <option value="{{ $id }}" {{ old('coupon_id', $salesmaster->coupon_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $coupon }}
                                    </option>
                                @endforeach
                            </select>
                            @error('coupon_id')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">User Address Name</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('user_address_id') is-invalid @enderror" name="user_address_id">
                                <option value="">Select User Address</option>
                                @foreach ($useraddress as $id => $useraddres)
                                    <option value="{{ $id }}" {{ old('user_address_id', $salesmaster->user_address_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $useraddres }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_address_id')
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
                                name="discount" value="{{ old('discount', $salesmaster->discount ?? '') }}">
                            @error('discount')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Order Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control @error('order_date') is-invalid @enderror"
                                name="order_date" value="{{ old('order_date', $salesmaster->order_date ?? '') }}">
                            @error('order_date')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Sub Total</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('sub_total') is-invalid @enderror"
                                name="sub_total" value="{{ old('sub_total', $salesmaster->sub_total ?? '') }}">
                            @error('sub_total')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Total Amount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('total_amount') is-invalid @enderror"
                                name="total_amount" value="{{ old('total_amount', $salesmaster->total_amount ?? '') }}">
                            @error('total_amount')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-10 text-center">
                            <button type="submit" class="btn btn-gradient-success ">
                                @if (isset($salesmaster))
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
