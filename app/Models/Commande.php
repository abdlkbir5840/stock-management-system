<?php

namespace App\Models;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    // Les colonnes pouvant être remplies massivement
    protected $fillable = ['Date_Commande'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit', 'commande_id', 'produit_id');
    }
    public function factures(): BelongsTo
    {
        return $this->belongsTo(Facture::class);
    }

}
