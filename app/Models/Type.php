<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'type_id';

    public $timestamps = false;

    protected $fillable = [
        'type_id',
        'name'
    ];
    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'movie_types', 'type_id', 'movie_id');
    }
}
