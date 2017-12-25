<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class TarifWilayah extends Model
{
    protected $table = 'tarif_wilayahs';
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['nama','harga','keterangan',];
    
    public static function findRequested()
    {
        $query = ListMenu::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama') and $query->where('nama',\Request::input('nama'));
        \Request::input('harga') and $query->where('harga',\Request::input('harga'));
        \Request::input('keterangan') and $query->where('keterangan',\Request::input('keterangan'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
}
