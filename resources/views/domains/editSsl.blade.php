@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ssl mode</h1>

        <div class="card mb-4">
            <div class="card-header">Update ssl mode</div>
            <div class="card-body">
                <form action="{{ route('domains.update-ssl', [$account->id, $domain]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="ssl_mode">SSL Mode</label>
                        <select name="ssl_mode" class="form-control @error('ssl_mode') is-invalid @enderror">
                            @foreach(\App\Enums\SslMode::cases() as $sslmode)
                                <option value="{{ $sslmode->value }}" @if($ssl['value'] == $sslmode->value) selected @endif>{{ $sslmode->name }}</option>
                            @endforeach
                        </select>
                        @error('ssl_mode')
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
