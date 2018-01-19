<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    protected $table = 'modifiers';
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ["id_detail_transaksi","modifier","user_input","user_update"];

    public static function findRequested()
    {
        $query = ListMenu::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('id_detail_transaksi') and $query->where('id_detail_transaksi',\Request::input('id_detail_transaksi'));
        \Request::input('modifier') and $query->where('modifier',\Request::input('modifier'));
        \Request::input('user_input') and $query->where('user_input',\Request::input('user_input'));
        \Request::input('user_update') and $query->where('user_update',\Request::input('user_update'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
    public function DetailTransaksi()
    {
        return $this->belongsTo('Modules\All\Entities\DetailTransaksi','id_detail_transaksi');
    }
}
