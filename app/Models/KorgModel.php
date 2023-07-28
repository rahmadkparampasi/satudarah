<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KorgModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'korg';

    protected $primaryKey = 'korg_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['korg_id', 'korg_nm', 'korg_act', 'korg_uupdate', 'korg_ucreate'];
}
