<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SegkecModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'segkec';

    protected $primaryKey = 'segkec_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['segkec_id', 'segkec_seg', 'segkec_kec', 'segkec_ucreate', 'segkec_uupdate'];
}
