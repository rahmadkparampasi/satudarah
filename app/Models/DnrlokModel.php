<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class DnrlokModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dnrlok';

    protected $primaryKey = 'dnrlok_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['dnrlok_id', 'dnrlok_dnr', 'dnrlok_org', 'dnrlok_utm', 'dnrlok_ucreate', 'dnrlok_uupdate'];
}
