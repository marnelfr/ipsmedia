<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __invoke()
    {
        return [
            'success' => true,
            'message' => __('messages.welcome'),
            'data' => [
                'service' => 'Unlocking Achievements API',
                'version' => '1.0',
                'language' => app()->getLocale(),
                'support' => 'marnelginola@gmail.com'
            ]
        ];
    }
}
