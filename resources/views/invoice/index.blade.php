@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Invoices</h4>

                @if(auth()->user()->can("create-invoices"))
                    <a class="btn btn-success" href="{{ route('invoice.create') }}">
                        <i class="fas fa-plus"></i>
                        Add new
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-hover" id="invoice-table-js">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Client name</th>
                            <th scope="col">Total (AZN)</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Sale type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td scope="row">{{ $invoice->id }}</td>
                                <td scope="row">{{ $invoice->client->name }}</td>
                                <td scope="row">{{ $invoice->total / 100 }}</td>
                                <td scope="row">{{ $invoice->payment_metdod ? "Nagd" : "Nisye" }}</td>
                                <td scope="row">{{ $invoice->is_sale ? "Satis" : "Alis" }}</td>
                                <td scope="row">{{ $invoice->created_at }}</td>
                                <td>
                                    @if(auth()->user()->can("delete-invoices"))
                                        <button type="button" class="btn btn-sm btn-danger" data-invoice-id="{{ $invoice->id }}" data-toggle="modal" data-target="#deleteInvoiceModal">
                                            <i class="far fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    @endif

                                    @if(auth()->user()->can("update-invoices"))
                                        <a class="btn btn-sm btn-warning" href="{{ route('invoice.edit', ['id' => $invoice->id]) }}">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->user()->can("read-invoices"))
                                        <a class="btn btn-sm btn-info" href="{{ route('invoice.show', ['id' => $invoice->id]) }}">
                                            <i class="far fa-eye"></i>
                                            View
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                    </tfoot>
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
