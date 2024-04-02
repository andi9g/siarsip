<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bagikanmodulajarM extends Model
{
    use HasFactory;
    protected $table = 'bagikanmodulajar';
    protected $primaryKey = 'idbagikanmodulajar';
    protected $guarded = [];

    public function modulajar()
    {
        return $this->hasOne(modulajarM::class, 'idmodulajar','idmodulajar');
    }
}
