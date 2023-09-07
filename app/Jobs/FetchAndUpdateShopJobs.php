<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchAndUpdateShopJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The shop domain.
     *
     * @var \App\Models\User
     */
    protected $shop;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\User $shop  The shop.
     * @return void
     */
    public function __construct($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job
     */
    public function handle()
    {
        return $this->shop->updateFromGraphApiResponse(
            $this->shop->api()->graph('{
                shop {
                    id
                    name
                    email
                    contactEmail
                    currencyCode
                    currencyFormats {
                        moneyFormat
                        moneyInEmailsFormat
                        moneyWithCurrencyFormat
                        moneyWithCurrencyInEmailsFormat
                    }
                    primaryDomain {
                        host
                    }
                    timezoneOffset
                    ianaTimezone
                    enabledPresentmentCurrencies
                    plan {
                        displayName
                        partnerDevelopment
                        shopifyPlus
                    }
                    billingAddress {
                        city
                        province
                        provinceCode
                        country
                        countryCodeV2
                    }
                }
            }')['body']['data']['shop']
        );
    }
}
