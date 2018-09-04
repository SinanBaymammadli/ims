@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Invoice #{{ $invoice->id }}

                <div>
                    @if(auth()->user() && auth()->user()->can("delete-invoices"))
                        <button type="button" class="btn btn-sm btn-danger" data-invoice-id="{{ $invoice->id }}" data-toggle="modal" data-target="#deleteInvoiceModal">
                            <i class="far fa-trash-alt"></i>
                            Delete
                        </button>
                    @endif

                    {{-- @if(auth()->user() && auth()->user()->can("update-invoices"))
                        <a class="btn btn-sm btn-warning" href="{{ route('invoice.edit', ['id' => $invoice->id]) }}">
                            <i class="far fa-edit"></i>
                            Edit
                        </a>
                    @endif --}}

                    <button class="btn btn-sm btn-primary" id="js-print-btn">
                        <i class="fas fa-print"></i>
                        Print
                    </button>
                </div>
            </div>
            <div class="card-body" id="print">
                <table class="invoice-table" border="1" style="width: 100%; border-collapse: collapse;" cellpadding="5">
                    <tr>
                        <td colspan="2">Company Name</td>
                        <td colspan="2">Invoice #{{ $invoice->id }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Client name: {{ $invoice->client->name }}</td>
                        <td colspan="2">Date: {{ $invoice->created_at }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center">Products</td>
                    </tr>
                    <tr>
                        <td>Adi</td>
                        <td>Miqdar</td>
                        <td>Qiymet</td>
                        <td>Cem</td>
                    </tr>
                    @foreach ($invoice->orders as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->amount * $order->price / 100 }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: right">Umumi cem: {{ $invoice->total / 100 }}</td>
                    </tr>
                </table>
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
