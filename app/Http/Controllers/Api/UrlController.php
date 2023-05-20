<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUrlRequest;
use App\Models\Url;
use App\Services\UrlService;

class UrlController extends Controller
{
    private UrlService $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function shorten(SaveUrlRequest $request)
    {
        $url = $this->urlService->saveUrl(new Url(), $request->get('long_url'), $request->get('private'));

        $shortUrl = $this->urlService->generateShortUrl($url->id);

        $url->short_url = $shortUrl;
        $url->save();

        return response()->json([
            'success' => true,
            'message' => 'Url has been successfully shorten.',
            'data' => $url,
        ]);
    }
}
