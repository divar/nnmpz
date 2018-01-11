<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
	protected $table = 'alamats';
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['id_pelanggan','alamat','kelurahan','kecamatan','kabupaten','provinsi','user_input','user_update'];
    
    public static function findRequested()
    {
        $query = Alamat::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('id_pelanggan') and $query->where('id_pelanggan',\Request::input('id_pelanggan'));
        \Request::input('alamat') and $query->where('alamat',\Request::input('alamat'));
        \Request::input('kelurahan') and $query->where('kelurahan',\Request::input('kelurahan'));
        \Request::input('kecamatan') and $query->where('kecamatan',\Request::input('kecamatan'));
        \Request::input('kabupaten') and $query->where('kabupaten',\Request::input('kabupaten'));
        \Request::input('provinsi') and $query->where('provinsi',\Request::input('provinsi'));
        \Request::input('user_input') and $query->where('user_input',\Request::input('user_input'));
        \Request::input('user_update') and $query->where('user_update',\Request::input('user_update'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
}
