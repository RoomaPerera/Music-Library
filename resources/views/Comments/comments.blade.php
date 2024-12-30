@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                        {{ Auth::user()->name }}
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
                    <div class="card-body sidebar">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('layouts.message')
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Comments
                    </div>
                    <div class="card-body pb-0">                    
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Comments</th>
                                    <th width="150">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td colspan="3">
                                            No Comments
                                        </td>
                                    </tr>
                            </tbody>
                        </table>             
                    </div> 
                </div>                
            </div>
        </div>
    </div>
@endsection
