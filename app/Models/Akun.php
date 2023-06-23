<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_akun';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
