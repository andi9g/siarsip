<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatanM extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    protected $primaryKey = 'idjabatan';
    protected $guarded = [];
    protected $connection = "mysql";

}
