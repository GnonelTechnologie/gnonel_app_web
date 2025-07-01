<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'user_id',
        'member_id',
        'team_name',
        'status',
        'role'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur créateur de l'équipe
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le membre de l'équipe
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    /**
     * Relation avec les références de l'équipe
     */
    public function references(): HasMany
    {
        return $this->hasMany(Reference::class);
    }

    /**
     * Relation avec les spécifications de l'équipe
     */
    public function specifications(): HasMany
    {
        return $this->hasMany(Spec::class);
    }

    /**
     * Vérifier si un utilisateur est membre de l'équipe
     */
    public function isMember($userId): bool
    {
        return $this->member_id == $userId || $this->user_id == $userId;
    }

    /**
     * Vérifier si un utilisateur est propriétaire de l'équipe
     */
    public function isOwner($userId): bool
    {
        return $this->user_id == $userId;
    }

    /**
     * Vérifier si un utilisateur a un rôle admin dans l'équipe
     */
    public function isAdmin($userId): bool
    {
        return $this->role == 'admin' && $this->member_id == $userId;
    }

    /**
     * Obtenir tous les membres d'une équipe
     */
    public static function getTeamMembers($teamId)
    {
        return self::where('id', $teamId)
                   ->orWhere('user_id', function($query) use ($teamId) {
                       $query->select('user_id')->from('teams')->where('id', $teamId);
                   })
                   ->with(['owner', 'member'])
                   ->get();
    }

    /**
     * Obtenir toutes les équipes d'un utilisateur
     */
    public static function getUserTeams($userId)
    {
        return self::where('user_id', $userId)
                   ->orWhere('member_id', $userId)
                   ->with(['owner', 'member'])
                   ->get();
    }
} 