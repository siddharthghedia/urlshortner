<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Url;
use App\Services\UrlService;
use Hashids\Hashids;

class URLController extends Controller
{
    private UrlService $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index()
    {
        return view('url-shortner.index');
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
