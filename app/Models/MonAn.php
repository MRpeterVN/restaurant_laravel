<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonAn extends Model
{
    protected $table = 'mon_an';
    protected $fillable = ['ten_mon', 'mo_ta', 'phan_loai', 'anh', 'gia_tien'];
    protected $primaryKey = 'id';
    public $timestamps = true;
    const UPDATED_AT = null;
}