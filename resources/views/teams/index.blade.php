@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Mes Équipes</h4>
                    <a href="{{ route('teams.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Créer une équipe
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($teams->count() > 0)
                        <div class="row">
                            @foreach($teams as $team)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $team->team_name }}</h5>
                                            
                                            <div class="mb-3">
                                                <strong>Propriétaire :</strong> {{ $team->owner->name }}
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Membre :</strong> {{ $team->member->name }}
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Rôle :</strong> 
                                                <span class="badge badge-{{ $team->role == 'admin' ? 'warning' : 'info' }}">
                                                    {{ ucfirst($team->role) }}
                                                </span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Statut :</strong> 
                                                <span class="badge badge-{{ $team->status == 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($team->status) }}
                                                </span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <strong>Rejoint le :</strong> {{ $team->joined_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                        
                                        <div class="card-footer">
                                            <div class="btn-group w-100" role="group">
                                                @if($team->status == 'active')
                                                    <a href="{{ route('teams.switch', $team->id) }}" 
                                                       class="btn btn-success btn-sm">
                                                        <i class="fas fa-users"></i> Rejoindre
                                                    </a>
                                                @endif
                                                
                                                <a href="{{ route('teams.show', $team->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Détails
                                                </a>
                                                
                                                @if($team->isOwner(Auth::id()) && $team->status == 'active')
                                                    <form action="{{ route('teams.remove-member', $team->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                                                            <i class="fas fa-trash"></i> Supprimer
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucune équipe trouvée</h5>
                            <p class="text-muted">Vous n'appartenez à aucune équipe pour le moment.</p>
                            <a href="{{ route('teams.create') }}" class="btn btn-primary">
                                Créer votre première équipe
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 