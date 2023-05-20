<?php

namespace App\Services;

use App\Models\Url;
use Hashids\Hashids;
use RuntimeException;

class UrlService
{
    public function saveUrl(Url $url, $longUrl, $private): Url
    {
        $url->long_url = $longUrl;
        $url->private = $private;
        $url->save();

        return $url;
    }

    public function generateShortUrl(int $id): string
    {
        $hashId = new Hashids(env('APP_NAME'), 6);
        $encodedValue = $hashId->encode($id);
        
        return $encodedValue;
    }
}
