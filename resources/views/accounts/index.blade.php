@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Cloudflare Accounts</h1>

        <a href="{{ route('accounts.create') }}" class="btn  btn-primary mb-5">Create account</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2>Accounts List</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Account Name</th>
                <th>Email</th>
                <th>Api key</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->email }}</td>
                    <td>{{ $account->api_key }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('domains.index', $account->id) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px;">Domains</a>
                            <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-success btn-sm" style="margin-right: 5px;">Edit</a>

                            <form action="{{ route('accounts.delete', $account->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>

            {{ $accounts->links() }}
        </table>
    </div>
@endsection
