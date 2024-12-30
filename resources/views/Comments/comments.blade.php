@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                        Welcome!  {{ Auth::user()->name }}
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if (Auth::user()->image != '')
                                <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}"
                                    class="img-fluid rounded-circle" alt="{{ Auth::user()->name }}" width="150px">
                            @endif

                        </div>
                        <div class="h5 text-center">
                            <strong>{{ Auth::user()->name }}</strong>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-lg mt-3">
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
                                    <th width="150">Action</th>
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
                                            <a href="{{route('songs.edit',$song->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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
