<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'Produit';

    // Les colonnes pouvant être remplies massivement
    protected $fillable = ['quantite','prix_unitaire','description'];
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit', 'produit_id', 'commande_id');
    }
}
