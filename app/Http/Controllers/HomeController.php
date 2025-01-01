<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Will show home page
    public function index(Request $request){
        $songsExist = Song::exists();
        if ($songsExist) {
            $songs = Song::orderBy('created_at', 'desc');

            if(!empty($request->keyword)){
                $songs->where('title','like', '%'.$request->keyword.'%');
            }

            $songs=$songs->paginate(8);
        } else {
            $songs = []; // Or handle the "no songs" case appropriately
        }
        return view('home', [
            'songs' => $songs
        ]);
    }
}
