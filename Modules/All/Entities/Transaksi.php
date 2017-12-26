<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['id_pelanggan','id_alamat','total_harga','id_tarif_wilayah','ppn'];
    
    public static function findRequested()
    {
        $query = Alamat::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('id_pelanggan') and $query->where('id_pelanggan',\Request::input('id_pelanggan'));
        \Request::input('id_alamat') and $query->where('id_alamat',\Request::input('id_alamat'));
        \Request::input('total_harga') and $query->where('total_harga',\Request::input('total_harga'));
        \Request::input('id_tarif_wilayah') and $query->where('id_tarif_wilayah',\Request::input('id_tarif_wilayah'));
        \Request::input('ppn') and $query->where('ppn',\Request::input('ppn'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
    public function Pelanggan()
    {
        return $this->belongsTo('Modules\All\Entities\Pelanggan','id_pelanggan');
    }
    public function Alamat()
    {
        return $this->belongsTo('Modules\All\Entities\Alamat','id_alamat');
    }
    public function TarifWilayah()
    {
        return $this->belongsTo('Modules\All\Entities\TarifWilayah','id_tarif_wilayah');
    }
}
