<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
	public $table = 'abonnement';


	public function category()
	{
		return $this->belongsTo(Categorieabonnement::class, 'categorie');
	}
}
