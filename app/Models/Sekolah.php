<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'ms_sekolah';
    protected $guarded = [        
    ];

    public function guru()
    {
        return $this->hasMany(Biodata::class, 'asal_satuan_pendidikan','npsn');
    }
    //create function to get jumlah guru
    public function jumlah_guru()
    {
        return $this->guru()->count();
    }
    public function PesertaDidik()
    {
        return $this->hasMany(PesertaDidik::class, 'sekolah_npsn', 'npsn');
    }
    public function Rombel()
    {
        return $this->hasMany(Rombel::class, 'sekolah_npsn', 'npsn');
    }
    public function Inovasi()
    {
        return $this->hasMany(Inovasi::class, 'sekolah_npsn', 'npsn');
    }
    public function kepala_sekolah()
    {
        return $this->hasOne(Biodata::class, 'asal_satuan_pendidikan', 'npsn')->join('model_has_roles','model_has_roles.model_id','=','ms_biodatauser.id')->where('role_id', '06aecb63-2410-4d4f-9e96-4f564728febe');
    }

}
