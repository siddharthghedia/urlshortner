<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenRequest;
use App\Services\UrlService;
use App\Models\Url;

class UrlController extends Controller
{
    private $urlService;

    public function __construct(UrlService $urlService) 
    {
        $this->urlService = $urlService;
    }

    public function index() 
    {
        $urls = Url::with('clicks')->orderBy('created_at', 'DESC')->paginate(20);
        return view('url-shortner.index', compact('urls'));
    }

    public function shorten(UrlShortenRequest $request) 
    {
        $url = $this->urlService->saveUrl(new Url(), $request->get('long_url'), $request->get('private'));
        $shortUrl = $this->urlService->generateShortUrl($url->id);
        $url->short_url = $shortUrl;
        $url->save();

        return redirect()->back();
    }
}
