@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Domains Management</h1>

        <a href="{{ route('domains.create', $account->id) }}" class="btn  btn-primary mb-5">Add domain</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2>Domains List</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Domain Name</th>
                <th>SSL Mode</th>
            </tr>
            </thead>
            <tbody>
            @foreach($domains as $domain)
                <tr>
                    <td>{{ $domain['name'] }}</td>
                    <td>
                        <a href="{{ route('domains.ssl-edit', [$account->id, $domain['id']]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px;">Edit ssl</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
