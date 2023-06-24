<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Store;
use App\Models\StoreLinks;
use App\Models\ArticleWidget;
use Illuminate\Support\Str;
use DataTables;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ck_article_upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $image = $filenametostore;
            $request->file('upload')->move("uploads/ck/", $image);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/ck/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
    public function index()
    {
        return view('admin.home');
    }
    public function home()
    {
        return view('admin.home');
    }
    public function store()
    {
        return view('admin/store/index');
    }
    public function add_store()
    {
        return view('admin/store/add');
    }
    public function edit_store($store_id)
    {
        $store_data = Store::with('store_links')
            ->where('id', $store_id)->first();
        return view('admin/store/edit', compact('store_id', 'store_data'));
    }
    public function save_store(Request $request)
    {
        $file = $request->file('logo');
        $image = $request->post('name') . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
        $file->move("uploads/category/", $image);

        $data = Store::create(
            [
                'name' => $request->post('name'),
                'logo' => $image,
                'website' => $request->post('website'),
                'website_url' => $request->post('website_url'),
                'email' => $request->post('email'),
                'tag_id' => $request->post('tag_id'),
                'phone' => $request->post('phone'),
                'payment' => $request->post('payment'),
                'pan_card' => $request->post('pan_card'),
                'about_us_tag' => $request->post('about_us_tag'),
                'header_script' => $request->post('header_script'),
                'sidebar_script' => $request->post('sidebar_script'),
                'footer_script' => $request->post('footer_script'),
                'article_header_script' => $request->post('article_header_script'),
                'article_footer_script' => $request->post('article_footer_script'),
                'status' => $request->post('status')
            ]
        );
        if ($data) {
            return redirect()->route('admin.store')->with('success', 'Data Added Successfully.');
        }
    }
    public function update_store(Request $request)
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = $request->post('name') . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/category/", $image);
        } else {
            $image = $request->post('old_logo');
        }
        $data = Store::where('id', $request->post('id'))
            ->update(
                [
                    'name' => $request->post('name'),
                    'logo' => $image,
                    'website' => $request->post('website'),
                    'website_url' => $request->post('website_url'),
                    'email' => $request->post('email'),
                    'tag_id' => $request->post('tag_id'),
                    'phone' => $request->post('phone'),
                    'payment' => $request->post('payment'),
                    'pan_card' => $request->post('pan_card'),
                    'about_us_tag' => $request->post('about_us_tag'),
                    'header_script' => $request->post('header_script'),
                    'sidebar_script' => $request->post('sidebar_script'),
                    'footer_script' => $request->post('footer_script'),
                    'article_header_script' => $request->post('article_header_script'),
                    'article_footer_script' => $request->post('article_footer_script'),
                    'status' => $request->post('status')
                ]
            );
        if ($data) {
            return redirect()->route('admin.store')->with('success', 'Data Added Successfully.');
        }
    }

    public function get_store(Request $request)
    {
        $data = Store::select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('logo', function ($row) {
                return "<img src='" . asset('uploads/category') . '/' . $row['logo'] . "' style='width:50px; height:50px;' />";
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a href="' . route('admin.store_links', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Links</a>';
                $btn .= '<a href="' . route('admin.edit_store', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-warning btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
    }
    public function store_links($store_id)
    {
        $store_data = Store::with('store_links')
            ->where('id', $store_id)->first();
        return view('admin/store/store_links', compact('store_id', 'store_data'));
    }
    public function save_store_links(Request $request)
    {
        $all_links = $request->post('links');
        $store_id = $request->post('store_id');
        $store_links = array_filter(explode("\r\n", $all_links));
        StoreLinks::where('store_id', $store_id)->forceDelete();
        foreach ($store_links as $key => $link_item) {
            $data = StoreLinks::create(
                [
                    'url' => $link_item,
                    'store_id' => $store_id,
                    'status' => 'active',
                ]
            );
        }
        return redirect()->back();
    }
    public function category()
    {
        return view('admin/category/index');
    }
    public function get_category(Request $request)
    {
        $data = Category::select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return "<img src='" . asset('uploads/category') . '/' . $row['image'] . "' style='width:50px; height:50px;' />";
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a href="' . route('admin.edit_category', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-warning btn-sm">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    public function edit_category($category_id)
    {
        $category_data = Category::where('id', $category_id)->first();
        return view('admin/category/edit', compact('category_id', 'category_data'));
    }
    public function update_category(Request $request)
    {
        $name = $request->post('name');
        $slug = Str::slug($request->post('name'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/category/", $image);
        } else {
            $image = $request->post('old_image');
        }

        $data = Category::where('id', $request->post('id'))
            ->update(
                [
                    'name' => $name,
                    'image' => $image,
                    'slug' => $slug,
                ]
            );
        if ($data) {
            return redirect()->route('admin.category')->with('success', 'Data Added Successfully.');
        }
    }
    public function add_category()
    {
        return view('admin/category/add');
    }
    public function save_category(Request $request)
    {
        $name = $request->post('name');
        $file = $request->file('image');
        $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
        $file->move("uploads/category/", $image);
        $slug = Str::slug($request->post('name'));

        $data = Category::create(
            [
                'name' => $name,
                'image' => $image,
                'slug' => $slug,
            ]
        );
        if ($data) {
            return redirect()->route('admin.category')->with('success', 'Data Added Successfully.');
        }
    }

    public function article()
    {

        return view('admin/article/index');
    }
    public function get_article(Request $request)
    {
        $data = Article::orderBy('id', 'desc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return "<img src='" . asset('uploads/article') . '/' . $row['image'] . "' style='width:50px; height:50px;' />";
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a target="_BLANK" href="' . route('admin.add_article_widget', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Widgets</a>';
                $btn .= '<a target="" href="' . route('admin.edit_article', $row['id']) . '" class="edit mr-2 btn btn-primary btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-warning btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    public function edit_article($article_id)
    {
        $article_data = Article::where('id', $article_id)->first();
        $category = Category::all();
        return view('admin/article/edit', compact('article_id', 'article_data', 'category'));
    }
    public function add_article()
    {
        $category = Category::all();
        return view('admin/article/add', compact('category'));
    }
    public function update_article(Request $request)
    {
        $category_id = $request->post('category_id') ?? '';
        $name = $request->post('name') ?? '';
        $amazon_link = $request->post('amazon_link') ?? '';
        $amazon_widget = $request->post('amazon_widget') ?? '';
        $body = $request->post('body') ?? '';


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/article/", $image);
        }else{
            $image = $request->post('old_image');
        }

        $slug = Str::slug($request->post('name'), '_');
        $data = Article::where('id', $request->post('id'))
            ->update(
                [
                    'category_id' => $category_id,
                    'name' => $name,
                    'image' => $image,
                    'slug' => $slug,
                    'body' => $body,
                    'amazon_link' => $amazon_link,
                    'amazon_widget' => $amazon_widget,
                ]
            );
        if ($data) {
            return redirect()->route('admin.article')->with('success', 'Data Added Successfully.');
        }
    }
    public function save_article(Request $request)
    {
        $category_id = $request->post('category_id') ?? '';
        $name = $request->post('name') ?? '';
        $amazon_link = $request->post('amazon_link') ?? '';
        $amazon_widget = $request->post('amazon_widget') ?? '';
        $body = $request->post('body') ?? '';


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/article/", $image);
        } else {
            $image = 'default.png';
        }

        $slug = Str::slug($request->post('name'), '_');
        $data = Article::create(
            [
                'category_id' => $category_id,
                'name' => $name,
                'image' => $image,
                'slug' => $slug,
                'body' => $body,
                'amazon_link' => $amazon_link,
                'amazon_widget' => $amazon_widget,
            ]
        );
        if ($data) {
            return redirect()->route('admin.article')->with('success', 'Data Added Successfully.');
        }
    }

    public function add_article_widget($article_id)
    {
        $store = Store::where('status', 'active')->get();
        $article_data = Article::with(['article_widget'])->where('id', $article_id)->first();
        return view('admin/article/add_widget', compact('store', 'article_data'));
    }
    public function save_article_widget(Request $request)
    {
        $widget_data = $request->post('widget_data');
        $article_id = $request->post('article_id');
        foreach ($widget_data as $key => $widget_data_item) {
            $data = ArticleWidget::updateOrCreate(
                [
                    'article_id' => $article_id,
                    'store_id' => $key,
                ],
                [
                    'article_id' => $article_id,
                    'store_id' => $key,
                    'widget_data' => $widget_data_item,
                ]
            );
        }
        return redirect(route('admin.article'));
    }
}
