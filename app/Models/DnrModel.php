<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DnrModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dnr';

    protected $primaryKey = 'dnr_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['dnr_id', 'dnr_kat', 'dnr_org', 'dnr_tmpt', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'dnr_ucreate', 'dnr_uupdate'];
}
