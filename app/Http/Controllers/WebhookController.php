<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseResponse;
use Illuminate\Support\Facades\Response;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;

/**
 * Class WebhookController
 */
class WebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web', 'auth.webhook']);
    }

    /**
     * Handles an incoming webhook.
     *
     * @param Request $request The request object.
     * @param string  $type    The type of webhook
     *
     * @return ResponseResponse
     */
    public function __invoke(Request $request, string $type = ''): ResponseResponse
    {
        if (! $type) {
            $type = $request->query('topic');
        }

        if (! $type) {
            abort(403);
        }

        /**
         * Get the job class and dispatch
         *
         * @var $jobClass \Illuminate\Foundation\Bus\Dispatchable
         */
        $jobClass = '\\App\Webhooks\\'.str_replace(' ', '', ucwords(str_replace('_', ' ',  str_replace('/', ' ', str_replace('-', ' ', $type))))).'Webhook';

        if (! class_exists($jobClass)) {
            abort(404, "Missing webhook handler for $type");
        }

        $jobData = json_decode($request->getContent());

        $jobClass::dispatch(
            ShopDomain::fromNative($request->header('x-shopify-shop-domain')),
            $jobData
        );

        return Response::make('', 201);
    }

    public function status()
    {
        return true;
    }
}
