<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Category;

class CategoryController extends BaseController
{
  public function show($id) {
    $item = Category::find($id);
    return view('home/categories/show', ['item' => $item]);
  }
}
