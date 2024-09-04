<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LinkService;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $url = url('/');
        return view('index', ['url' => $url]);
    }

    public function user(){
        $url = url('/user');
        return view('user', ['url' => $url]);
    }

    public function produk(){
        return view('user.produk');
    }

    public function checkout(){
        return view('user.checkout');
    }

    protected $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function link()
    {
        $appUrl = $this->linkService->getAppUrl();
        return view('', compact('appUrl'));
    }
}
