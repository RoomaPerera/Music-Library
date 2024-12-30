<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SongsController extends Controller
{
    // Will show songs list
    public function index(){
        $songs  = Song::where('user_id',Auth::id())->orderBy('created_at','DESC')->paginate(10);
        return view('songs.list', compact('songs'));
        //return view('songs.list',[
          //  'songs'=>$songs
        //]);}}
    }

    // Will show upload song
    public function create(){
        if(Auth::user()->role!=='artist'){
            abort(403, 'Unauthorized');
        }
        return view('songs.create');
    }

    // Will store song
    public function store(Request $request){
        if(Auth::user()->role!=='artist'){
            abort(403, 'Unauthorized');
        }
        $rules = [
            'title' => 'required|min:5',
            'artist' => 'required|min:3',
        ];

        if(!empty($request->image)){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('songs.create')->withInput()->withErrors($validator);
        }

        // save song in database
        $song = new Song();
        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->description = $request->description;
        $song->user_id = Auth::id();
        $song-> save();

        return redirect()->route('songs.index')->with('success','Song Uploaded');
    }

    // Will edit songs
    public function edit($id){
        if(Auth::user()->role!=='artist'){
            abort(403, 'Unauthorized');
        }
        $song = Song::find($id);
        return view('songs.edit', compact('song'));
    }

    public function delete($id){
        if(Auth::user()->role!=='artist'){
            abort(403, 'Unauthorized');
        }
        $song =Song::find($id);

        if (!$song){
            return redirect()->route('songs.index')->with('error', 'Song not found.');
        
        }
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Song deleted successfully.');
    }

    // Will update songs
    public function update(Request $request,$id){
        if(Auth::user()->role!=='artist'){
            abort(403, 'Unauthorized');
        }
        $rules = [
            'title' => 'required|min:5',
            'artist' => 'required|min:3',
        ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return redirect()->route('songs.edit',$id)->withInput()->withErrors($validator);
            }
            $song = Song::find($id);
            $song->title = $request->title;
            $song->artist = $request->artist;
            $song->description = $request->description;
            $song->save();

            return redirect()->route('songs.index')->with('success','Updated');
    }

}
