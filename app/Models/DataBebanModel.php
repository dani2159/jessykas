<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataBebanModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_beban';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
