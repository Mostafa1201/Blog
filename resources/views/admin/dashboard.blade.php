@extends('master')

@section('content')

<div class="stats">
    <div class="container">
        <h1>DashBoard</h1>
        <div class="row clearfix">
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <a href="{{ url('/admins') }}">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="text">Admins</div>
                            <div class="counter" data-count="{{ $admins }}">0</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <a href="{{ url('/categories') }}">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="text">Categories</div>
                            <div class="counter" data-count="{{ $categories }}">0</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <a href="{{ url('/') }}">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="text">Posts</div>
                            <div class="counter" data-count="{{ $posts }}">0</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <div class="text">Post Views</div>
                        <div class="counter" data-count="{{ $postViews }}">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="activities">
    <div class="container">
        <h2>Recent Activities</h2>
        <div class="activities-wrapper">
            <div class="row activity-content">
                <div class="col-md-9">
                    Mostafa Has Posted a food post a few seconds ago.
                </div>
                <div class="col-md-3 date">
                    1 sec ago
                </div>
            </div>
            <hr>
            <div class="row activity-content">
                <div class="col-md-9">
                    Mostafa Has Posted a food post a few seconds ago.
                </div>
                <div class="col-md-3 date">
                    1 sec ago
                </div>
            </div>
        </div>
    </div>
</div> -->

@endsection
