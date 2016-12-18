<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Category;
use App\Feed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function getAll() {
    return Category::all();
  }

  public function getFeeds($id) {
    $feeds = Category::find($id)->feeds;
    return response()->json($feeds->toArray());
  }

  public function createCategory(Request $request) {
    $recievedData = (object) $request->json()->all();

    $id = Category::insertGetId([
      'name' => $recievedData->name,
      'user_id' => Auth::user()->id
    ]);

    return $id;
  }

  public function createFeed($id, Request $request) {
    $recievedData = (object) $request->json()->all();

    $id = Feed::insertGetId([
      'name' => $recievedData->name,
      'url_path' => $recievedData->url_path,
      'category_id' => $id
    ]);

    return $id;
  }

  public function editFeed($id, Request $request) {
    $recievedData = (object) $request->json()->all();

    $response = Feed::where('id', $id)->update([
      'name' => $recievedData->name,
      'url_path' => $recievedData->url_path
      ]);
  }
}
