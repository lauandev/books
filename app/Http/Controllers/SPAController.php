<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SPAController extends Controller
{
    /**
     * SPA Index.
     *
     * @return Factory|View
     */
    public function index(){
        return view('app');
    }
}
