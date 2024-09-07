@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Domain</h1>

        <div class="card mb-4">
            <div class="card-header">Add Domain</div>
            <div class="card-body">
                <form action="{{ route('domains.store', $account->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="domain">Domain Name</label>
                        <input type="text" name="domain" class="form-control @error('domain') is-invalid @enderror">
                        @error('domain')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Domain</button>
                </form>
            </div>
        </div>
    </div>
@endsection
