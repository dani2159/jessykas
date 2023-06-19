<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penerimaan extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_penerimaan';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
