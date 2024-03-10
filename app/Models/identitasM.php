<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identitasM extends Model
{
    use HasFactory;
    protected $table = 'identitas';
    protected $primaryKey = 'ididentitas';
    protected $guarded = [];
    protected $connection = "mysql";

    public function user()
    {
        return $this->hasOne(User::class, 'iduser','iduser');
    }

    public function jabatan()
    {
        return $this->hasOne(jabatanM::class, 'idjabatan','idjabatan');
    }
}
