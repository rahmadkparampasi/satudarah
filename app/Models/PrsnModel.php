<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PrsnModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'prsn';

    protected $primaryKey = 'prsn_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'prsn_desa', 'prsn_telp', 'prsn_wa', 'prsn_ucreate', 'prsn_uupdate'];
}
