<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrgModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'org';

    protected $primaryKey = 'org_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['org_id', 'org_korg', 'org_nm', 'org_alt', 'org_act', 'org_utd', 'org_utdnm', 'org_ucreate', 'org_uupdate'];
}
