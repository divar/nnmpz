<?php

namespace Modules\All\Entities;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurir';
    protected $fillable = ["nama","persen"];
	public $guarded = ["id","created_at","updated_at"];
	public $timestamps=true;
    public $incrementing = true;
    protected $primaryKey = "id";

    public static function findRequested()
    {
        $query = Kurir::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama') and $query->where('nama',\Request::input('nama'));
        \Request::input('persen') and $query->where('persen',\Request::input('persen'));
        \Request::input('trash') and $query->where('trash',\Request::input('trash'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
}
