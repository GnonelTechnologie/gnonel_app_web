@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Détails de l'équipe : {{ $team->team_name }}</h4>
                    <a href="{{ route('teams.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations générales</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nom de l'équipe :</strong></td>
                                    <td>{{ $team->team_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Statut :</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $team->status == 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($team->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Créée le :</strong></td>
                                    <td>{{ $team->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dernière modification :</strong></td>
                                    <td>{{ $team->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>Membres de l'équipe</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6>Propriétaire</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                                {{ substr($team->owner->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $team->owner->name }}</strong><br>
                                                <small class="text-muted">{{ $team->owner->email }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Membre</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                                {{ substr($team->member->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $team->member->name }}</strong><br>
                                                <small class="text-muted">{{ $team->member->email }}</small><br>
                                                <span class="badge badge-{{ $team->role == 'admin' ? 'warning' : 'info' }}">
                                                    {{ ucfirst($team->role) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-muted">
                                        <small>Rejoint le : {{ $team->joined_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($team->status == 'active')
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Actions</h5>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('teams.switch', $team->id) }}" class="btn btn-success">
                                        <i class="fas fa-users"></i> Rejoindre cette équipe
                                    </a>
                                    
                                    @if($team->isOwner(Auth::id()))
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editTeamModal">
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>
                                        
                                        <form action="{{ route('teams.remove-member', $team->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                                                <i class="fas fa-trash"></i> Supprimer le membre
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($team->status == 'inactive')
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle"></i>
                            Cette équipe est inactive. Les membres ne peuvent plus y accéder.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier l'équipe -->
@if($team->isOwner(Auth::id()))
<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'équipe</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('teams.update', $team->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_team_name">Nom de l'équipe</label>
                        <input type="text" class="form-control" id="edit_team_name" name="team_name" 
                               value="{{ $team->team_name }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_role">Rôle du membre</label>
                        <select class="form-control" id="edit_role" name="role" required>
                            <option value="member" {{ $team->role == 'member' ? 'selected' : '' }}>Membre</option>
                            <option value="admin" {{ $team->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 16px;
    font-weight: bold;
}
</style> 