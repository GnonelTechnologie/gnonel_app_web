@extends('layouts.back_layout')
@section('title')
    Images du carousel
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Images du carousel</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Images du carousel</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-4">
                @if (isset($slider))
                    <form method="POST" action="{{ route('carousel.update', $slider->id) }}" enctype="multipart/form-data">
                    @else
                        <form method="POST" action="{{ route('carousel.store') }}" enctype="multipart/form-data">
                @endif
                <div class="card">
                    <div class="card-body">
                        @if (!isset($slider))
                            <h4 class="header-title">Ajouter une image au carousel</h4>
                        @else
                            <h4 class="header-title">Modifier une image du carousel</h4>
                        @endif
                        @csrf

                        @if (isset($slider))
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="path">Image</label>
                                <input type="file" value="{{ $slider->libelle }}" accept="image/*"
                                    class="form-control @error('path') is-invalid @enderror" name="path"
                                    value="{{ old('path') }}" id="path" required>
                                <a href="{{ $slider->path }}" target="_blank" class="float-end mt-2">
                                    <img src="{{ $slider->path }}" alt="{{ $slider->path }}" class="img-fluid rounded-2"
                                        style="width:50px">
                                </a>
                                @error('path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @else
                            <div class="form-group">
                                <label for="path">Image</label>
                                <input type="file" accept="image/*" required
                                    class="form-control @error('path') is-invalid @enderror" name="path"
                                    value="{{ old('path') }}" id="path">
                                @error('path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des images du carousel</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Image</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>
                                            <img src="{{ $slider->path }}" alt="{{ $slider->path }}"
                                                class="img-fluid rounded-2" style="width:100px">
                                        </td>
                                        <td>
                                            <a href="{{ route('carousel.edit', $slider->id) }}" class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $slider->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $slider->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cette image?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <form action="{{ route('carousel.destroy', $slider->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-success">
                                                            Oui</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
