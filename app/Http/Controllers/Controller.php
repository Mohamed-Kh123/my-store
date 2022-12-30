<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getCookieId($name)
    {
        $id = Cookie::get($name);
        if (!$id) {
            $id = Str::uuid();
            Cookie::queue($name, $id, 60 * 24 * 30);
        }

        return $id;
    }

}
