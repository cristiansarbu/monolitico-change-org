<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $fillable = ['title', 'description', 'destinatary', 'signers', 'status'];
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
