@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cloudflare Account Edit</h1>

        <div class="card mb-4">
            <div class="card-header">Edit account:  {{ $account->email }}</div>
            <div class="card-body">
                <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Account Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $account->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $account->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="api_key">API Key</label>
                        <input type="text" name="api_key" class="form-control @error('api_key') is-invalid @enderror" value="{{ old('api_key') ?? $account->api_key }}">
                        @error('api_key')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
