<?php
namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
     * Define model for each row.
     */
    public function model(array $row)
    {
        return new Student([
            'nim'             => $row[0], // Kolom pertama dalam file Excel
            'name'            => $row[1], // Kolom kedua
            'angkatan'        => $row[2],
            'gender'          => $row[3],
            'status_terakhir' => $row[4],
            'prodi'           => $row[5],
            'jalur_masuk'     => $row[6],
        ]);
    }
}