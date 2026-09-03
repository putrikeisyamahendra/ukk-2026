<?php

namespace App\Models;

use Sakuci\Database\Model;

class Kategori extends Model
{
    protected static ?string $table = 'kategori';
    protected string $primaryKey = 'id';

    protected array $fillable = ['kode_kategori', 'nama_kategori', 'keterangan'];
}
