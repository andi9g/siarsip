<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keteranganM extends Model
{
    use HasFactory;
    protected $table = 'keterangan';
    protected $primaryKey = 'idketerangan';
    protected $guarded = [];
    protected $connection = "mysql";
}
