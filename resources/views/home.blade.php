@extends('layouts.app')

@section('main')
    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <div class="d-flex text-white justify-content-between">
                    <h2 class="mb-3">Songs</h2>
                    <div class="mt-2">
                        <a href="{{ route('home') }}" class="text-white" style="text-decoration: none;">Clear</a>
                    </div>
                </div>
                <div class="card shadow-lg border-0">
                    <form action="" method="get">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-11 col-md-11" style="background-color:#222">
                                    <input type="text" value="{{ Request::get('keyword') }}"
                                        class="form-control form-control-lg" name="keyword" placeholder="Search by title">
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <button class="btn btn-primary btn-lg w-100"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mt-4">
                    @if ($songs->isNotEmpty())
                        @foreach ($songs as $song)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card border-0 shadow-lg">
                                    <a href="detail.html">
                                        @if ($song->image != '')
                                            <img src="{{ asset('uploads/songs/thumb/' . $song->image) }}" alt=""
                                                class="card-img-top">
                                        @else
                                            <img src="https://placehold.co/600x400?text=No Image" alt=""
                                                class="card-img-top">
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <h3 class="h4 heading">{{ $song->title }}</h3>
                                        <p>by {{ $song->artist }}</p>
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span class="rating-text theme-font theme-yellow">0.0</span>
                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars ">
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>


                                                </div>
                                            </div>
                                            <span class="theme-font text-muted">(0 Likes)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{ $songs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
