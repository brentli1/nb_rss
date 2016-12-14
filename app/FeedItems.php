<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedItems extends Model
{
  protected $table = "feedItems";

  public function feed() {
    return $this->belongsTo('App\Feed');
  }
}
