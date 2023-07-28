<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KrjModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'krj';

    protected $primaryKey = 'krj_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['krj_id', 'krj_nm', 'krj_act', 'krj_ucreate', 'krj_uupdate'];
}
