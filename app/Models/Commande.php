<?php

namespace App\Models;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
<<<<<<< HEAD
    // Nom de la table associée au modèle
    protected $table = 'Commandes';

=======
>>>>>>> d5cec7bb796e8a5d82215c0896cd5f91ab993282
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
