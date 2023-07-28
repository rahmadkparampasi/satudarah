<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class GolModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'gol';

    protected $primaryKey = 'gol_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['gol_id', 'gol_nm', 'gol_act', 'gol_ucreate', 'gol_uupdate'];
}
