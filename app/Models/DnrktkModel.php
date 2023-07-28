<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DnrktkModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dnrktk';

    protected $primaryKey = 'dnrktk_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['dnrktk_id', 'dnrktk_dnr', 'dnrktk_prsn', 'dnrktk_ucreate', 'dnrktk_uupdate'];
}
