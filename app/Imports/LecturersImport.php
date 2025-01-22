<?php
namespace App\Imports;

use App\Models\Lecturer;
use Maatwebsite\Excel\Concerns\ToModel;

class LecturersImport implements ToModel
{
    /**
     * Convert each row from Excel into a Lecturer model instance.
     */
    public function model(array $row)
    {
        return new Lecturer([
            'nip'        => $row[0], // Kolom pertama di Excel
            'name'       => $row[1], // Kolom kedua di Excel
            'kode_dosen' => $row[2],
            'riwayat_s1' => $row[3],
            'riwayat_s2' => $row[4],
            'riwayat_s3' => $row[5],
            'kepakaran1' => $row[6],
            'kepakaran2' => $row[7],
        ]);
    }
}
