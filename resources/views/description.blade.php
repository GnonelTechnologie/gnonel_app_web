@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
    <h1>Default Layout</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Layout</a></div>
        <div class="breadcrumb-item">Default Layout</div>
    </div>
    </div>

    <div class="section-body">
    <h2 class="section-title">This is Example Page</h2>
    <p class="section-lead">This page is just an example for you to create your own page.</p>
    <div class="card">
        <div class="card-header">
        <h4>Example Card</h4>
        </div>
        <div class="card-body">
        <p>{{$description}}</p>
        </div>
        <div class="card-footer bg-whitesmoke">
        This is card footer
        </div>
    </div>
    </div>
</section>
@endsection
