<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'admin_id',
        'admin_email',
        'password',
        'admin_name'
    ];

}
