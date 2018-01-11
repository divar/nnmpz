<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['nama','id_alamat','email','no_hp','tgl_lahir','user_input','user_update'];
    
    public static function findRequested()
    {
        $query = Alamat::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama') and $query->where('nama',\Request::input('nama'));
        \Request::input('id_alamat') and $query->where('id_alamat',\Request::input('id_alamat'));
        \Request::input('email') and $query->where('email',\Request::input('email'));
        \Request::input('no_hp') and $query->where('no_hp',\Request::input('no_hp'));
        \Request::input('tgl_lahir') and $query->where('no_hp',\Request::input('no_hp'));
        \Request::input('user_input') and $query->where('user_input',\Request::input('user_input'));
        \Request::input('user_update') and $query->where('user_update',\Request::input('user_update'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
    public function Alamat()
    {
        return $this->belongsTo('Modules\All\Entities\Alamat','id_alamat');
    }
}
