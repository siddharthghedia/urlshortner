<?php

namespace App\Services;

use App\Models\Click;
use App\Models\Url;
use Hashids\Hashids;

class UrlService
{
    public function saveUrl(Url $url, $longUrl, $private): Url
    {
        $url->long_url = $longUrl;
        $url->private = $private ?? 0;
        $url->save();

        return $url;
    }

    public function generateShortUrl(int $id): string
    {
        $hashId = new Hashids(env('APP_NAME'), 6);
        $encodedValue = $hashId->encode($id);
        
        return $encodedValue;
    }

    public function saveClick(Click $click, $urlId): Click
    {
        $click->url_id = $urlId;
        $click->save();

        return $click;
    }
}
