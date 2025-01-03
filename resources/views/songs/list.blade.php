@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <br>
                            @if (Auth::user()->image != '')
                                <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}"
                                    class="img-fluid rounded-circle" alt="{{ Auth::user()->name }}" width="150px">
                            @else
                                <img src="{{asset('images/avatar.png')}}" alt="profile pic avatar" width="150" height="150">
                            @endif
                        </div>
                    </div>
                    <div class="text-center text-white">
                        {{ Auth::user()->name }}
                        <hr class="sidebar-hr">
                    </div>
                    <div class="card-body sidebar">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('layouts.message')
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Songs
                    </div>
                    <div class="card-body pb-0">            
                        <a href="{{route('songs.create')}}" class="btn btn-primary">Upload</a>            
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Likes</th>
                                    <th width="150">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($songs->isNotEmpty())
                                    @foreach ($songs as $song)
                                    <tr>
                                        <td>{{$song->title}}</td>
                                        <td>{{$song->artist}}</td>
                                        <td>Number of Likes</td>
                                        <td>
                                            <a href="{{route('songs.edit',$song->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square" title="edit"></i>
                                            </a>
                                            <form action="{{ route('songs.delete', $song->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash" title="delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                            Songs not found
                                        </td>
                                    </tr>
                                @endif 
                            </tbody>
                        </table>             
                    </div> 
                </div>                
            </div>
        </div>
    </div>
@endsection
