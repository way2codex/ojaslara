<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Store;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Article::with('category')->latest()->paginate(6);
        return view('welcome', compact('data'));
    }
    public function page($page)
    {
        $store_data = [];
        $view = 'page.' . $page;
        if (view()->exists($view)) {
            $store_id = store_id();
            $store_data = Store::where('id', $store_id)->first();
        } else {
            $view = '404';
        }
        return view($view, compact('store_data'));
    }
    public function category($category_id)
    {
        $data = Article::with('category')
            ->where('category_id', $category_id)
            ->orderBy('id','desc')
            ->latest()
            ->paginate(6);
        return view('welcome', compact('data'));
    }
    public function article($id)
    {
        $data = Article::with(['category','article_widget'])
            ->where('id', $id)
            ->first();
        $related_data = Article::with('category')
            ->where('category_id', $data['category_id'])
            ->limit(4)
            ->get();
        $prev_next_data = Article::limit(2)->inRandomOrder()->get();
        return view('article', compact('data', 'related_data', 'prev_next_data'));
    }
}
