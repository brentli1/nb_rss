<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\FeedItems;

class FeedController extends Controller
{
  protected $table = "feedItems";

  public function getCurrentRss($id, Request $request) {
    $fetchedData = $request->json()->all();
    $currentIds = DB::table('feedItems')->select('feed_item_id')->where('feed_id', $id)->get();

    // Loop through fetched data to check if entry has already been
    // added to the database.
    for($i = 0; $i < count($fetchedData); $i++) {
      $isFound = 0;
      foreach($currentIds as $thisId) {
        if($fetchedData[$i]['guid'] == $thisId->feed_item_id) {
          $isFound = 1;
          break;
        }
      }

      if($isFound == 0) {
        DB::table('feedItems')->insert([
          'title' => $fetchedData[$i]['title'],
          'author' => $fetchedData[$i]['author'],
          'content' => $fetchedData[$i]['content'],
          'feed_link' => $fetchedData[$i]['link'],
          'feed_item_id' => $fetchedData[$i]['guid'],
          'pubDate' => $fetchedData[$i]['pubDate'],
          'starred' => 0,
          'is_read' => 0,
          'feed_id' => $id
          ]);
      }
    }

    // Return only what you need.
    $dataToReturn = DB::table('feedItems')->select('id', 'author', 'title', 'feed_link', 'content', 'feed_item_id', 'pubDate', 'starred', 'is_read', 'feed_id')->where([['is_read', 0], ['feed_id', $id]])->get();

    return Response()->json($dataToReturn);
  }

  public function markItemRead($id) {
    $data = DB::table('feedItems')->where('id', $id)->update(['is_read' => 1]);
    return $data;
  }

  public function starItem($id) {
    $data = DB::table('feedItems')->where('id', $id)->update(['starred' => 1]);
    return $data;
  }

  public function unstarItem($id) {
    DB::table('feedItems')->where('id', $id)->update(['starred' => 0]);
    return 0;
  }
}
