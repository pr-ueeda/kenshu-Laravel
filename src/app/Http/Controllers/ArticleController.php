<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $article_data = Models\User::select()
            ->join('user_articles', 'user_articles.user_id', '=', 'users.id')
            ->join('articles', 'user_articles.article_id', '=', 'articles.id')
            ->join('article_images', 'article_images.article_id', 'articles.id')
            ->join('images', 'images.id', 'article_images.image_id')
            ->join('article_tags', 'article_tags.article_id', 'articles.id')
            ->join('tags', 'tags.id', 'article_tags.tag_id')
            ->join('thumbnails', 'thumbnails.image_id', 'images.id')
            ->where('articles.id', '=', $id)
            ->get();

        return \view('article', ['article_data' => $article_data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
