<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bagikanM extends Model
{
    use HasFactory;
    protected $connection = "mysql";
    protected $table = 'bagikan';
    protected $primaryKey = 'idbagikan';
    protected $guarded = [];

    public function arsip()
    {
        return $this->hasOne(arsipM::class, 'idarsip','idarsip');
    }

}
