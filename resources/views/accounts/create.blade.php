@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cloudflare Account Create</h1>

        <div class="card mb-4">
            <div class="card-header">Add Account</div>
            <div class="card-body">
                <form action="{{ route('accounts.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Account Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('name') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="api_key">API Key</label>
                        <input type="text" name="api_key" class="form-control @error('api_key') is-invalid @enderror" value="{{ old('api_key') }}">
                        @error('api_key')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Account</button>
                </form>
            </div>
        </div>
    </div>
@endsection
