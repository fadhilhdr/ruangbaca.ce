<?php
namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    public function model(array $row)
    {
        return new Book([
            'judul' => $row[0],          // Kolom A di Excel
            'penulis' => $row[1],        // Kolom B
            'penerbit' => $row[2],       // Kolom C
            'isbn' => $row[3],           // Kolom D
            'peminatan' => $row[4],      // Kolom E
            'sub_peminatan' => $row[5],  // Kolom F
            'kode_unik' => $row[6],      // Kolom G
            'thumbnail' => $row[7],      // Kolom H (opsional)
            'synopsis' => $row[8],       // Kolom I (opsional)
            'is_available' => $row[9],   // Kolom J
        ]);
    }
}