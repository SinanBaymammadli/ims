@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->has('permission'))
                        <div class="alert alert-danger alert-animated" role="alert">
                            <strong>{{ $errors->first('permission') }}</strong>
                        </div>
                    @endif

                    @foreach ($alerts as $alert)
                        <div class="alert alert-danger" role="alert">
                            Only <strong>{{ $alert->amount }} {{ $alert->name }}</strong> remaining.
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
