<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\News_Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index($current_page)
    {
        $newsM = new News();
        $offset = ($current_page - 1) * 9;
        $data['news'] = $newsM->offset($offset)->limit(9)->with(['tags'])->where('type', 'News')->orderBy("created_at", "DESC")->get();
        $count = $newsM->count();
        $data['paging'] = dataPaging($count, $current_page, 9);
        $data['current_page'] = $current_page;

        return view('pages/news', $data);
    }

    public function searchNews(Request $request)
    {
        $news = new News();
        $data = $news->with(['tags'])->where('type', 'News')->where('title', 'like', '%'.$request->search.'%')->orderBy('created_at', 'DESC')->get();

        $response['code'] = 200;
        $response['status'] = true;
        $response['message'] = 'success';
        $response['data'] = $data;
        
        return response()->json($response, 200);
    }

    public function irmsView($current_page)
    {
        $newsM = new News();
        $offset = ($current_page - 1) * 9;
        $data['news'] = $newsM->offset($offset)->limit(9)->with(['tags'])->where('type', 'IRMS')->get();
        $count = $newsM->count();
        $data['paging'] = dataPaging($count, $current_page, 9);
        $data['current_page'] = $current_page;

        return view('pages/irms', $data);
    }

    public function ajaxDataTable(Request $request)
    {
        $data = News::with(['tags'])->where('type', $request->type)->select("*");
        return datatables()->of($data)->addColumn('action', function ($row) {
            return 
            '<button class="open-edit btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModalTambah"
            data-id_news="'.$row->id_news.'" data-slug="'.$row->slug.'" data-title="'.$row->title.'" data-content="'.$row->content.'"
            data-type="'.$row->type.'"><i class="fa fa-edit"></i> </button>
            <a href="' . route('news.deleteNews', $row->id_news) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
        })->rawColumns(['action'])->make(true);
    }

    public function getNewsTag($id){
        $news = News::with(['tags'])->find($id);
        $response['code'] = 200;
        $response['status'] = true;
        $response['message'] = 'success';
        $response['data'] = $news;
        
        return response()->json($response, 200);
    }

    public function addNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cover' => 'required|mimes:jpg,jpeg,png|max:4048',
            'image_content' => 'nullable|mimes:jpg,jpeg,png|max:4048',
        ]);

        if ($validator->fails()) {    
            $response['status'] = false;
            $response['code'] = 400;
            $response['message'] = $validator->messages();

            return response()->json($response, 400);
        }

        $news = new News;
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->content = $request->content;
        $news->type = $request->type;

        if($files = $request->file('cover')){
            $files->storeAs('public/news/cover', $files->hashName());
            $news->cover = $files->hashName();
        }
        if($files2 = $request->file('image_content')){
            $files2->storeAs('public/news/content', $files2->hashName());
            $news->image_content = $files2->hashName();
        }
        $news->save();
        //slug
        $slug = Str::slug($request->title, '-');
        $news->slug = $slug.'-'.$news->id_news;
        $news->save();

        //News Tags
        $data = json_decode($request->tags);
        foreach($data as $row)
        {
            $news_tag = new News_Tag;
            $news_tag->id_news = $news->id_news;
            $news_tag->id_tag = $row->id_tag;
            $news_tag->save();
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function editNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cover' => 'nullable|mimes:jpg,jpeg,png|max:4048',
            'image_content' => 'nullable|mimes:jpg,jpeg,png|max:4048',
        ]);
        if ($validator->fails()) {    
            $response['status'] = false;
            $response['code'] = 400;
            $response['message'] = $validator->messages();

            return response()->json($response, 400);
        }
        $news = News::find($request->id_news);
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->content = $request->content;
        $news->type = $request->type;
        
        if($files = $request->file('cover')){
            $files->storeAs('public/news/cover', $files->hashName());
            $news->cover = $files->hashName();
        }
        if($files2 = $request->file('image_content')){
            $files2->storeAs('public/news/content', $files2->hashName());
            $news->image_content = $files2->hashName();
        }
        
        //slug
        $slug = Str::slug($request->title, '-');
        $news->slug = $slug.'-'.$news->id_news;
        $news->save();

        //News Tags
        $news_tagM = new News_Tag();
        $news_tagM->where('id_news', $request->id_news)->delete();
        $data = json_decode($request->tags);
        foreach($data as $row)
        {
            $news_tag = new News_Tag;
            $news_tag->id_news = $news->id_news;
            $news_tag->id_tag = $row->id_tag;
            $news_tag->save();
        }

        $response['status'] = true;
        $response['code'] = 200;
        $response['message'] = 'success';
        return response()->json($response, 200);
    }

    public function detailNews($slug)
    {
        $data['data'] = News::where('slug', $slug)->first();
        $data['news'] = News::where('type', 'News')->limit(5)->get();

        return view('pages/newsdetail', $data);
    }

    public function detailIrms($slug)
    {
        $data['data'] = News::where('slug', $slug)->first();
        $data['news'] = News::where('type', 'IRMS')->limit(5)->get();

        return view('pages/newsdetail', $data);
    }

    public function deleteNews($id)
    {
        $news = News::find($id);
        Storage::delete('public/news/cover/'.$news->cover);
        Storage::delete('public/news/content/'.$news->image_content);
        $news->delete();
        return redirect()->back()->with('action', 'success');
    }
}
