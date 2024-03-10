<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arsipM extends Model
{
    use HasFactory;
    protected $table = 'arsip';
    protected $primaryKey = 'idarsip';
    protected $guarded = ["file"];
    protected $connection = "mysql";

    public function keterangan()
    {
        return $this->hasOne(keteranganM::class, 'idketerangan','idketerangan');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'iduser','iduser');
    }

}
