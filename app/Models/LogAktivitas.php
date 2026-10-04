<?php

namespace App\Models;

use Sakuci\Database\Model;

class LogAktivitas extends Model
{
    protected static ?string $table = 'log_aktivitas';
    protected string $primaryKey = 'id_log';

    protected array $fillable = [
        'id_user',
        'aktivitas',
        'created_at',
    ];

    // Catat satu aktivitas. Gagal mencatat tidak boleh merusak proses utama.
    public static function catat(string $aktivitas): void
    {
        try {
            $me = User::current();

            static::create([
                'id_user'    => $me ? $me->id : null,
                'aktivitas'  => $aktivitas,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // sengaja diabaikan
        }
    }
}