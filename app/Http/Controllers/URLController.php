<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenRequest;
use App\Services\UrlService;
use App\Models\Url;
use App\Models\Click;
use Hashids\Hashids;

class UrlController extends Controller
{
    private UrlService $urlService;
    
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index() 
    {
        $urls = Url::withCount('clicks')->where('private', 0)->orderBy('created_at', 'DESC')->paginate(20);
        return view('url-shortner.index', compact('urls'));
    }

    public function shorten(UrlShortenRequest $request) 
    {
        $url = $this->urlService->saveUrl(new Url(), $request->get('long_url'), $request->get('private'));
        $shortUrl = $this->urlService->generateShortUrl($url->id);
        $url->short_url = $shortUrl;
        $url->save();

        return redirect()->back()->with('short-url', $url->short_url);
    }

    public function redirect($hashValue)
    {
        $hashId = new Hashids(env('APP_NAME'), 6);
        $decodedValue = $hashId->decode($hashValue);
        
        $url = Url::find($decodedValue[0]);

        if (!$url) {
            abort(404);
        }

        $this->urlService->saveClick(new Click(), $url->id);

        return redirect()->to($url->long_url);
    }
}
