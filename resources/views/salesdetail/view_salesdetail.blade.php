@extends('layouts.main')
@section('content')
    <style>
        .search-container {
            position: relative;
            display: inline-block;
        }

        .search-container i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .search-container input {
            padding-left: 30px;
            /* Add padding to the left to make space for the icon */
        }
    </style>
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Sales Details List</h5>
                    <a href="{{ route('create.salesdetail') }}"><button type="button" class="btn btn-gradient-info btn-sm"><i
                                class="bi bi-plus-lg me-1"></i>Add Sales Details</button></a>
                </div>
                <table class="table datatable1">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Sales Master Name</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Quantity </th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Total Amount</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesdetails as $index => $salesdetail)
                            <tr class="">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $salesdetail->salesMaster->id }}</td>
                                <td class="text-center">{{ $salesdetail->product->name }}</td>
                                <td class="text-center">{{ $salesdetail->quantity }}</td>
                                <td class="text-center">{{ $salesdetail->amount }}</td>
                                <td class="text-center">{{ $salesdetail->discount }}</td>
                                <td class="text-center">{{ $salesdetail->total_amount }}</td>
                                <td class="text-center">
                                    <a href="{{ route('edit.salesdetail', $salesdetail->id) }}"
                                        class="btn btn-gradient-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('destroy.salesdetail', $salesdetail->id) }}"
                                        class="btn btn-gradient-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this ?');"><i
                                            class="bi bi-trash3-fill"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let datatable = new simpleDatatables.DataTable($(".datatable1")[0])
            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-dager").fadeOut(1000);
            }, 1000);
        });
    </script>
@endpush