<?php

namespace App\Http\Controllers;

use App\Models;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $user_articles = Models\Article::with('user')->whereIn('id', [$id])->get();

        return \view('home', ['user_articles' => $user_articles]);
    }
}
