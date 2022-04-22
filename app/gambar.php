<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Yajra\DataTables\DataTablesServ;

class gambar extends Model
{
    // protected $table = "gambar";

    protected $fillable = ['file', 'keterangan'];

    //protected $model = gambar::class;
}
