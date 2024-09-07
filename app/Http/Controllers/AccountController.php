<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
    public function index(): View
    {
        $accounts = Account::paginate(10);

        return view('accounts.index', [
            'accounts' => $accounts
        ]);
    }

    public function create(): View
    {
        return view('accounts.create');
    }

    public function store(AccountStoreRequest $request)
    {
        Account::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'api_key' => $request->get('api_key'),
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account added successfully!');
    }

    public function edit(Account $account): View
    {
        return view('accounts.edit', ['account' => $account]);
    }

    public function update(AccountUpdateRequest $request, Account $account)
    {
        $account->update([
            'api_key' => $request->get('api_key'),
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');
    }

    public function delete(Account $account): RedirectResponse
    {
        $account->delete();

        return redirect()->back()->with('success', 'Account deleted successfully!');
    }
}
