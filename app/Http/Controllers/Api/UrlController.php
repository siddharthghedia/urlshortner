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

    public function getPublicUrlList()
    {
        $urls = Url::withCount('clicks')
            ->where('private', 0)
            ->orderBy('created_at', 'DESC')
            ->simplePaginate(20);

        $urls->getCollection()->transform(function ($url) {
            $url->short_url = route('url.redirect', $url->short_url);
            return $url;
        });

        return response()->json([
            'success' => true,
            'message' => 'List of public urls.',
            'data' => $urls,
        ]);
    }
}
