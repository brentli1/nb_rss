<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Category;
use App\Feed;

class CategoryController extends Controller
{
  public function getAll() {
    return Category::all();
  }

  public function getFeeds($id) {
    return Category::find($id)->feeds;
  }
}
