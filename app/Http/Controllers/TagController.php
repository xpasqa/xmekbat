<?php

namespace App\Http\Controllers;

use App\Models\News_Tag;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function ajaxDataTable()
    {
        $data = Tag::select("*");
        return datatables()->of($data)->addColumn('action', function ($row) {
            return 
            '<button class="open-edit btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModalTambah"
            data-id_tag="'.$row->id_tag.'" data-name="'.$row->name.'"><i class="fa fa-edit"></i> </button>
            <a href="' . route('tag.deleteTag', $row->id_tag) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
        })->rawColumns(['action'])->make(true);
    }

    public function addTag(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back()->with('action', 'success');
    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->back()->with('action', 'success');
    }

    public function deleteTagAjax($id_tag, $id_news)
    {
        $tag = News_Tag::where('id_tag', $id_tag)->where('id_news', $id_news)->first();
        $tag->delete();
        return response()->json(['status' => 'success']);
    }

    public function editTag(Request $request)
    {
        $tag = Tag::find($request->id_tag);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back()->with('action', 'success');
    }
}
