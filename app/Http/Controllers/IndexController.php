<?php

namespace App\Http\Controllers;

use Ixudra\Curl\Facades\Curl;
use GuzzleHttp\Handler\CurlFactory;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    function index() {
        echo 'gunduzi';
    }

}
