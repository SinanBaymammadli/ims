@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                About
            </div>
            <div class="card-body">
                <h2>{{ $invoice->id }}</h2>


                @if(auth()->user() && auth()->user()->can("delete-invoices"))
                    <button type="button" class="btn btn-sm btn-danger" data-invoice-id="{{ $invoice->id }}" data-toggle="modal" data-target="#deleteInvoiceModal">
                        <i class="far fa-trash-alt"></i>
                        Delete
                    </button>
                @endif

                @if(auth()->user() && auth()->user()->can("update-invoices"))
                    <a class="btn btn-sm btn-warning" href="{{ route('invoice.edit', ['id' => $invoice->id]) }}">
                        <i class="far fa-edit"></i>
                        Edit
                    </a>
                @endif

                <p>{{ $invoice->client->name }}</p>
                <p>{{ $invoice->total }}</p>

                @foreach ($invoice->orders as $order)
                    <p>{{ $order->product->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('extra')
    <!-- Delete Invoice Modal -->
    <div class="modal fade" id="deleteInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="deleteInvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteInvoiceModalLabel">Delete Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('invoice.destroy', ['id' => 0]) }}" method="post" id="deleteInvoiceForm">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
