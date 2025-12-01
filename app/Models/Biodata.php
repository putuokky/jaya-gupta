<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Biodata extends Model
{
      use HasRoles;
     protected $table = 'ms_biodatauser';

    protected $guarded = [
        
    ];   
    public $incrementing = false;
    protected $keyType = 'uuid';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
    
    public function asal_sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'asal_satuan_pendidikan', 'npsn');
    }

    public function user_bidang_pengembangan()
    {
        return $this->hasMany(UserBidangPengembangan::class, 'bio_id', 'id');
    }

    public function pendidikan_dikti()
    {
        return $this->belongsTo(JenjangPendidikanDikti::class, 'pendidikan_terakhir', 'kode');
    }
}
