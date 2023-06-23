<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pendapatan extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_pendapatan';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
