<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'Commandes';

    // Les colonnes pouvant être remplies massivement
    protected $fillable = ['date_commande', 'prix', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'date_commande', 'prix', 'client_id');
    }

}
