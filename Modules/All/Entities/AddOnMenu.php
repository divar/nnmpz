<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class AddOnMenu extends Model
{
    protected $table = 'add_on_menus';
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['nama','id_kategori','harga','keterangan','user_input','user_update'];
    
    public static function findRequested()
    {
        $query = Alamat::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('id_kategori') and $query->where('id_kategori',\Request::input('id_kategori'));
        \Request::input('nama') and $query->where('nama',\Request::input('nama'));
        \Request::input('harga') and $query->where('harga',\Request::input('harga'));
        \Request::input('keterangan') and $query->where('keterangan',\Request::input('keterangan'));
        \Request::input('user_input') and $query->where('user_input',\Request::input('user_input'));
        \Request::input('user_update') and $query->where('user_update',\Request::input('user_update'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
    public function Kategori()
    {
        return $this->belongsTo('Modules\All\Entities\Kategori','id_kategori');
    }
}
