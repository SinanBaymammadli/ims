@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="m-0">Create new product</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('product.store') }}">
                    @csrf

                    <div id="product-create-form"></div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
