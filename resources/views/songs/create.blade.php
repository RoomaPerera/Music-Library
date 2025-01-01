@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card">
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
                        Upload
                    </div>
                    <div class="card-body">
                        <form action="{{route('songs.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" value="{{old('title')}}"/>
                                @error('title')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="artist" class="form-label">Artist</label>
                                <input type="text" class="form-control @error('artist') is-invalid @enderror" placeholder="Artist"  name="artist" id="artist" value="{{old('artist')}}"/>
                                @error('artist')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="5" value="{{old('description')}}"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="Image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"  name="image" id="image"/>
                                @error('image')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="audio" class="form-label">Audio</label>
                                <input type="file" class="form-control @error('audio') is-invalid @enderror"  name="audio" id="audio"/>
                                @error('audio')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-2">Upload</button>
                        </form>              
                    </div>
                </div>             
            </div>
        </div>
    </div>
@endsection
