@extends('layouts.back_layout')
@section('content')
    <?php
    //$types=Illuminate\Support\Facades\DB::table('type')->get();
    ?>
    <div class="container" style="background-color: white; padding: 10px">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admins.update', $adm->id) }}" method="post" file="true"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4>Modifier un utilisateur</h4>
                    </div>
                    <div class="modal-body">
                        {{ method_field('put') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" required class="form-control">
                        <label>Nom </label>
                        <input class="form-control" name="nom" type="text" value="{{ $adm->name }}"> <br>
                        <label>Email</label>
                        <input class="form-control" disabled="true" name="email" type="email"
                            value="{{ $adm->email }}"> <br>
                        <label>Nouveau Mot de passe</label>
                        <input class="form-control" name="password" type="password"> <br>
                        <button class="btn btn-danger" data-dismiss="modal"
                            style="float: right;margin-left:4px;">Annuler</button>
                        <input type="submit" class="btn btn-success" style="float: right;" value="Enrégistrer">

                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
