<?php

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Article;
use App\Models\Store;

if (!function_exists('all_category')) {
    function all_category()
    {
        $all_category_data = Category::get();
        return $all_category_data;
    }
}
if (!function_exists('popular_article')) {
    function popular_article($limit)
    {
        $popular_article_data = Article::limit($limit)->inRandomOrder()->get();
        return $popular_article_data;
    }
}
if (!function_exists('store_data')) {
    function store_data()
    {
        if (env('APP_ENV') == 'local') {
            $store_id = env('STORE_ID', 0);
            $store_data = Store::where('id', $store_id)->first();
            return $store_data;
        }

        if (env('APP_ENV') == 'prod') {
            $store_data = Store::where('website', str_replace('www.', '', $_SERVER['HTTP_HOST']))->first();
            return $store_data;
        }
    }
}
if (!function_exists('store_id')) {
    function store_id()
    {
        if (env('APP_ENV') == 'local') {
            $store_id = env('STORE_ID', 0);
            return $store_id;
        }

        if (env('APP_ENV') == 'prod') {
            $store_data = Store::where('website', str_replace('www.', '', $_SERVER['HTTP_HOST']))->first();
            return $store_data['id'];
        }
    }
}
