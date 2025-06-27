@extends('layouts.back_layout')

@section('content')
    <?php
    $categorieold = \Illuminate\Support\Facades\DB::table('categorieautorites')
        ->where('id', $updates[0]->categorieautorite_id)
        ->first();
    ?>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Modifier l'Autorité Contractante</h4>
                        </div>
                        <form method="POST" action="{{ route('add_update_autorite', $updates[0]->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nom de l'institution *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ $updates[0]->raison_social }}" id="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Pays *</label>
                                            <select class="form-control" name="pays" required>
                                                @foreach ($pays as $pay)
                                                    <option value="{{ $pay->id }}" <?php if($updates[0]->id_pays == $pay->id){ ?> selected
                                                        <?php } ?>>{{ $pay->nom_pays }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="adresse">Adresse</label>
                                            <input type="text"
                                                class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                                                value="{{ $updates[0]->adresse }}" id="adresse">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="categorie">Categorie Autorite Contractante </label>
                                            <select class="form-control" name="categorie" required>

                                                @if ($categorieold != null)
                                                    <option value="{{ $updates[0]->categorieautorite_id }}" selected="true">
                                                        {{ $categorieold->libelleCat }} </option>
                                                @else
                                                    <option value="" selected="true"> </option>
                                                @endif

                                                @foreach ($categories as $categorie)
                                                    @if ($updates[0]->categorieautorite_id != $categorie->id)
                                                        <option value="{{ $categorie->id }}">{{ $categorie->libelleCat }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('categorie')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="description">Autre Information * </label>
                                            <textarea id="description" type="text" name="description" class="form-control @error('image') is-invalid @enderror"
                                                id="description">{{ $updates[0]->des_autorite }}</textarea>

                                        </div>
                                    </div>

                                    <div class="col"></div>
                                </div>



                                <!--   <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" required  name="status">
                                    <option value="1" <?php if($updates[0]->status == 1){ ?> selected <?php } ?> >Active</option>
                                    <option value="0" <?php if($updates[0]->status == 0){ ?> selected <?php } ?>>Inavtive</option>
                                </select>
                            </div> -->


                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Valider</button>
                                <button class="btn btn-danger" type="reset">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
    </section>
    @if (Session::has('add_ok'))
        <script>
            alert('Autoritée contractante enrégistrée')
        </script>
    @endif
@endsection
