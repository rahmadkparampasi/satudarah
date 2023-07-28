<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DnrmModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dnrm';

    protected $primaryKey = 'dnrm_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['dnrm_id', 'dnrm_dnr', 'dnrm_prsn', 'dnrm_kat', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_trm', 'dnrm_org', 'dnrm_ucreate', 'dnrm_uupdate'];
}
