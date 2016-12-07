<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categorys';
  protected $visible = ['id', 'name', 'user_id'];

  public function feeds() {
    return $this->hasMany('App\Feed');
  }
}
