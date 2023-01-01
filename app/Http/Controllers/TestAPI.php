<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestAPI extends Controller
{
    public function posts_api()
    {
        $data = Http::get('https://jsonplaceholder.typicode.com/posts');

        dd($data->json());
    }
}
