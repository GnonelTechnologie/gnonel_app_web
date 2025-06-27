@extends('layouts.back_layout')
@section('title')
    Tableau de Bord
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Tableau de bord</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $refsCount }}</span>
                                    </h3>
                                    <p class="text-muted mb-1">Références techniques</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                    <i class="fe-users font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $basesCount }}</span></h3>
                                    <p class="text-muted mb-1">Base Fournisseurs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $specsCount }}</span></h3>
                                    <p class="text-muted mb-1">Spécifications techniques
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div class="row">
            {{-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Evolution des spécifications techniques.</h4>
                        <div class="mt-4 chartjs-chart">
                            <canvas id="line-chart-example" height="350" data-colors="#1abc9c,#f1556c"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide mt-2" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach (getCarouselSliders() as $slider)
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}"
                                        class="{{ $loop->first ? 'active' : '' }}">
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach (getCarouselSliders() as $slider)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block img-fluid" src="{{ asset($slider->path) }}" alt="First slide">
                                    </div>
                                @endforeach


                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>

    </div> <!-- container -->
@endsection
