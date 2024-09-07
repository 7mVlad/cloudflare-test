<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Facades\Http;

class CloudflareService
{
    const string CLOUDFLARE_URL = 'https://api.cloudflare.com';

    public function getDomains(Account $account): array
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-Auth-Email' => $account->email,
                'X-Auth-Key' => $account->api_key,
            ])->get(self::CLOUDFLARE_URL . "/client/v4/zones");

        return $response->json()['result'] ?? [];
    }

    public function addDomain(Account $account, string $domain): array
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-Auth-Email' => $account->email,
                'X-Auth-Key' => $account->api_key,
            ])
            ->post(self::CLOUDFLARE_URL . "/client/v4/zones", [
                'name' => $domain,
                'account' => [
                    'id' => $this->getAccountId($account)
                ],
            ]);

        return $response->json();
    }

    // Получить домен по ID
    public function getDomainById($domainId)
    {
        $response = Http::get("https://api.cloudflare.com/client/v4/zones/{$domainId}");
        return $response->json()['result'];
    }

    public function getDomainSsl(string $domainId, Account $account): array
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-Auth-Email' => $account->email,
                'X-Auth-Key' => $account->api_key,
            ])
            ->get(self::CLOUDFLARE_URL . "/client/v4/zones/{$domainId}/settings/ssl");

        return $response->json('result');
    }

    public function updateSSL(Account $account, string $domainID, string $sslMode): array
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-Auth-Email' => $account->email,
                'X-Auth-Key' => $account->api_key,
            ])
            ->patch(self::CLOUDFLARE_URL . "/client/v4/zones/{$domainID}/settings/ssl", [
                'value' => $sslMode
            ]);

        return $response->json();
    }

    private function getAccountId(Account $account): string
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'X-Auth-Email' => $account->email,
                'X-Auth-Key' => $account->api_key,
            ])
            ->get(self::CLOUDFLARE_URL . "/client/v4/accounts");

        return $response->json()['result'][0]['id'];
    }
}
