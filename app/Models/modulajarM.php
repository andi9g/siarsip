<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modulajarM extends Model
{
    use HasFactory;
    protected $table = 'modulajar';
    protected $primaryKey = 'idmodulajar';
    protected $guarded = ["file", "idketerangan"];

    public function user()
    {
        return $this->hasOne(User::class, 'iduser','iduser');
    }
    public function mapel()
    {
        return $this->hasOne(mapelM::class, 'iduser','iduser');
    }
    public function bagikan()
    {
        return $this->hasOne(bagikanmodulajarM::class, 'idmodulajar','idmodulajar');
    }
}
