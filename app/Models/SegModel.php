<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SegModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'seg';

    protected $primaryKey = 'seg_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['seg_id', 'seg_nm', 'seg_act', 'seg_uupdate', 'seg_ucreate'];
}
