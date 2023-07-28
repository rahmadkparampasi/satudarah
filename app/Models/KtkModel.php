<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KtkModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'ktk';

    protected $primaryKey = 'ktk_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['ktk_id', 'ktk_nm', 'ktk_act', 'ktk_uupdate', 'ktk_ucreate'];
}
