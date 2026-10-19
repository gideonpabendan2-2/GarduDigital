<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    /**
     * Unduh seluruh data tabel sebagai JSON.
     */
    public function download()
    {
        $backupData = [];

        // Dapatkan nama semua tabel
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE', 'gardudigital');
        $key = 'Tables_in_' . $dbName;

        foreach ($tables as $table) {
            $tableName = $table->$key ?? (array_values((array)$table)[0]); // Deteksi aman
            $backupData[$tableName] = DB::table($tableName)->get();
        }

        $fileName = 'backup_gardudigital_' . date('Y-m-d_H-i-s') . '.json';
        
        // Simpan JSON dengan JSON_PRETTY_PRINT agar mudah dibaca
        $jsonContent = json_encode($backupData, JSON_PRETTY_PRINT);

        return response($jsonContent)
                ->header('Content-Type', 'application/json')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
