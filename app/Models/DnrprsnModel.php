<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DnrprsnModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dnrprsn';

    protected $primaryKey = 'dnrprsn_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['dnrprsn_id', 'dnrprsn_dnr', 'dnrprsn_prsn', 'dnrprsn_ucreate', 'dnrprsn_uupdate'];
}
