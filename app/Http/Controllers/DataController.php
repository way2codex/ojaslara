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

class DataController extends Controller
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

    public function index()
    {
        dd('data index');
    }

    static function create_data($data,$pp)
    {
        ini_set('max_execution_time', 0);

        $url = $data['setting_data']['api_url'];
        $username = $data['setting_data']['api_username'];
        $password = $data['setting_data']['api_password'];
        // $username = "api";
        // $password = "mhNZ 65pw dcnh Zttp sSAm M9pB";

        $title = $data['title']['rendered'].'->'.$pp;
        $content = $data['content']['rendered'];
        $excerpt = $data['excerpt']['rendered'];
        $status = 'publish';
        $categories = $data['category_id'];
        foreach ($data['store_data']->store_keyword_replace as $key => $keyword_item) {
            $content = str_replace($keyword_item['keyword'], $keyword_item['keyword_replace'], $content);
        }

        $json_input_data = json_encode([
            'title' => $title,
            'content' => $content,
            'excerpt' => $excerpt,
            'status' => $status,
            'categories' => $categories
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url . '/wp-json/wp/v2/posts',
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_HEADER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_input_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($username . ':' . $password)
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            //add in error log
        } else {
            return true;
        }
    }
    static function fetch_data($url, $page, $per_page)
    {
        $final_url = $url . '/wp-json/wp/v2/posts?per_page=' . $per_page . '&page=' . $page;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $final_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $data = substr($response, $header_size);
        curl_close($curl);
        return  ['header' => $header, 'data' => $data];
    }
}
