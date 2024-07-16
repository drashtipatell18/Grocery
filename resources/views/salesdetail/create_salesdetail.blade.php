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
                    <div class="text-center">{{ isset($salesdetail) ? 'Edit Sales Details' : 'Create Sales Details' }}</div>
                </h5>
                <!-- General Form Elements -->
                <form action="{{ isset($salesdetail) ? '/salesdetail/update/' . $salesdetail->id : '/salesdetail/insert' }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Blade template -->
                    <div class="row mb-3">
                        <label for="sales_master_id" class="col-sm-2 col-form-label">Sales Master Id</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('sales_master_id') is-invalid @enderror" name="sales_master_id" id="sales_master_id">
                                <option value="">Select Sales Master Id</option>
                                @foreach ($salesmasters as $salesmaster)
                                    <option value="{{ $salesmaster }}"
                                        {{ old('sales_master_id', $salesdetail->sales_master_id ?? '') == $salesmaster ? 'selected' : '' }}>
                                        {{ $salesmaster }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sales_master_id')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label for="product_id" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('product_id') is-invalid @enderror" name="product_id" id="product_id">
                                <option value="">Select Product</option>
                                @foreach ($products as $id => $product)
                                    <option value="{{ $id }}"
                                        {{ old('product_id', $salesdetail->product_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $product }}
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

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                name="quantity" value="{{ old('quantity', $salesdetail->quantity ?? '') }}">
                            @error('quantity')
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                name="amount" value="{{ old('amount', $salesdetail->amount ?? '') }}">
                            @error('amount')
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
                                name="discount" value="{{ old('discount', $salesdetail->discount ?? '') }}">
                            @error('discount')
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
                                name="total_amount" value="{{ old('total_amount', $salesdetail->total_amount ?? '') }}">
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
                                @if (isset($salesdetail))
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
