<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Transaksi extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
