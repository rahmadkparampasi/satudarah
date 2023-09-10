<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UsersModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'users_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['users_id', ' users_nm', 'username', 'password', 'users_tipe', 'users_act', 'users_org', 'users_prsn', 'users_ucreate', 'users_uupdate'];
}
