<?php

namespace App\Http\Controllers;

use App\Models;

class ArticleMetaDataController extends Controller
{
    public function index()
    {
        $article_meta_data = Models\Article::with('user', 'image', 'thumbnail')->get();

        return \view('welcome', ['article_meta_data' => $article_meta_data]);
    }
}
