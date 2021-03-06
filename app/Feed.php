<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
  protected $table = 'feeds';

  public function feedItems() {
    return $this->hasMany('App\FeedItems');
  }
}
