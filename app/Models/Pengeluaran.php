<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengeluaran extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_pengeluaran';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
