@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Créer une nouvelle équipe</h4>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('teams.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="team_name">Nom de l'équipe *</label>
                            <input type="text" class="form-control @error('team_name') is-invalid @enderror" 
                                   id="team_name" name="team_name" value="{{ old('team_name') }}" required>
                            @error('team_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Donnez un nom descriptif à votre équipe</small>
                        </div>

                        <div class="form-group">
                            <label for="member_email">Email du membre *</label>
                            <input type="email" class="form-control @error('member_email') is-invalid @enderror" 
                                   id="member_email" name="member_email" value="{{ old('member_email') }}" required>
                            @error('member_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Si la personne n'a pas de compte, elle recevra une invitation pour en créer un
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle du membre *</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Membre</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Les administrateurs peuvent gérer les autres membres de l'équipe
                            </small>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Information importante</h6>
                            <ul class="mb-0">
                                <li>Si l'email existe déjà, la personne recevra une notification d'ajout à l'équipe</li>
                                <li>Si l'email n'existe pas, la personne recevra une invitation pour créer son compte</li>
                                <li>Une fois le compte créé, la personne pourra accéder à l'équipe et collaborer</li>
                            </ul>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Créer l'équipe
                            </button>
                            <a href="{{ route('teams.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 