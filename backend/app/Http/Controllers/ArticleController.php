<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Array[{ guid, title, pubDate, category }]
        $articles = Article::all()->map(fn(Article $article) => [
            'id' => $article->id,
            'title' => $article->title,
            'link' => $article->link,
            'comments' => $article->comments,
            'pubDate' => $article->pubDate,
            'category' => json_decode($article->category),
            'guid' => $article->guid,
            'description' => $article->description,
        ]);
        return response()->json($articles);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // { guid, title, link, description, category }
        return response()->json([
            'id' => $article->id,
            'title' => $article->title,
            'link' => $article->link,
            'comments' => $article->comments,
            'pubDate' => $article->pubDate,
            'category' => json_decode($article->category),
            'guid' => $article->guid,
            'description' => $article->description,
        ]);
    }
}
