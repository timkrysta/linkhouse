<?php

namespace App\Services;

use App\Models\Article;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LinkhouseFeedService
{
    private $linkhouseFeedUrl = 'https://linkhouse.pl/feed';


    public function updateFeed()
    {
        $response = $this->fetchFeed();
        $xmlData = $response->body();
        $articles = $this->parseFeed($xmlData);

        if ($success = true) {
            $this->clearArticles();
            $this->seedArticles($articles);
        }
    }

    private function fetchFeed()
    {
        return Http::get($this->linkhouseFeedUrl);
    }

    private function parseFeed(string $xmlData)
    {
        $xml = simplexml_load_string($xmlData);


        $items = [];

        foreach ($xml->channel->item as $item) {
            $categories = [];
            foreach ($item->category as $category) {
                $categories[] = (string) $category;
            }

            $itemData = [
                'title' => (string)$item->title,
                'link' => (string)$item->link,
                'comments' => (string)$item->comments,
                'pubDate' => new DateTime($item->pubDate),
                'category' => json_encode($categories),
                'guid' => (string)$item->guid,
                'description' => (string)$item->description,
                //'html_content' => (string) $item->children('content', true)->encoded,
            ];

            $items[] = $itemData;
        }
        return $items;
    }

    private function clearArticles()
    {
        Article::truncate();
    }

    private function seedArticles($articles)
    {
        $table = with(new Article)->getTable();
        DB::table($table)->insert($articles);
    }
}
