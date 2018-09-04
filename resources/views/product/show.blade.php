@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                About

                {{-- @if(auth()->user() && auth()->user()->can("delete-products"))
                    <button type="button" class="btn btn-sm btn-danger" data-product-id="{{ $product->id }}" data-toggle="modal" data-target="#deleteProductModal">
                        <i class="far fa-trash-alt"></i>Delete
                    </button>
                @endif --}}

                @if(auth()->user() && auth()->user()->can("update-products"))
                    <a class="btn btn-sm btn-warning" href="{{ route('product.edit', ['id' => $product->id]) }}">
                        <i class="far fa-edit"></i>Edit
                    </a>
                @endif
            </div>
            <div class="card-body">
                <h2>Adi: {{ $product->name }}</h2>
                <p>Miqdar: {{ $product->amount }}</p>
                <p>Alis qiymeti: {{ $product->purchase_price / 100 }}</p>
                <p>Satis qiymeti: {{ $product->sale_price / 100 }}</p>

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
