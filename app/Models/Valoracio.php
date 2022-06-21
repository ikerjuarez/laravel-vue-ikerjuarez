<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracio extends Model
{
    use HasFactory;
    protected $table = "valoracions";

    public function jocs(){
        $this->belongsTo(Joc::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
