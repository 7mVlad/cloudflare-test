<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainStoreRequest;
use App\Http\Requests\UpdateSslModeRequest;
use App\Models\Account;
use App\Services\CloudflareService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DomainController extends Controller
{
    protected CloudflareService $cloudflareService;

    public function __construct(CloudflareService $cloudflareService)
    {
        $this->cloudflareService = $cloudflareService;
    }

    public function index(Account $account): View
    {
        $domains = $this->cloudflareService->getDomains($account);

        return view('domains.index', [
            'domains' => $domains,
            'account' => $account,
        ]);
    }

    public function create(Account $account): View
    {
        return view('domains.create', [
            'account' => $account,
        ]);
    }

    public function store(DomainStoreRequest $request, Account $account): RedirectResponse
    {
        $this->cloudflareService->addDomain($account, $request->get('domain'));

        return redirect()->route('domains.index', $account)->with('success', 'Domain added successfully!');
    }

    public function editSsl(Account $account, string $domain): View
    {
        $ssl = $this->cloudflareService->getDomainSsl($domain, $account);

        return view('domains.editSsl', [
            'account' => $account,
            'domain' => $domain,
            'ssl' => $ssl,
        ]);
    }

    public function updateSSL(UpdateSslModeRequest $request, Account $account, string $domainId): RedirectResponse
    {
        $this->cloudflareService->updateSSL($account, $domainId, $request->get('ssl_mode'));

        return redirect()->route('domains.index', $account)->with('success', 'SSL settings updated!');
    }
}
