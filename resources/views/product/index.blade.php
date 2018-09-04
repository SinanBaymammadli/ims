@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Products</h4>

                @if(auth()->user()->can("create-products"))
                    <a class="btn btn-success" href="{{ route('product.create') }}">
                        <i class="fas fa-plus"></i>
                        Add new
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-hover" id="product-table-js">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Min required <br> amount</th>
                            <th scope="col">Purchase price <br>(AZN)</th>
                            <th scope="col">Sale price <br>(AZN)</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->amount }}</td>
                                <td>{{ $product->min_required_amount }}</td>
                                <td>{{ $product->purchase_price / 100 }}</td>
                                <td>{{ $product->sale_price / 100 }}</td>
                                <td>
                                    {{-- @if(auth()->user()->can("delete-products"))
                                        <button type="button" class="btn btn-sm btn-danger" data-product-id="{{ $product->id }}" data-toggle="modal" data-target="#deleteProductModal">
                                            <i class="far fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    @endif --}}

                                    @if(auth()->user()->can("update-products"))
                                        <a class="btn btn-sm btn-warning" href="{{ route('product.edit', ['id' => $product->id]) }}">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->user()->can("read-products"))
                                        <a class="btn btn-sm btn-info" href="{{ route('product.show', ['id' => $product->id]) }}">
                                            <i class="far fa-eye"></i>
                                            View
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extra')
    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('product.destroy', ['id' => 0]) }}" method="post" id="deleteProductForm">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
