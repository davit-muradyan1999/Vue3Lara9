<?php

namespace App\Imports;

use App\Models\AuthenticityCheck;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuthenticityCheckImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
        public function model(array $row)
        {
            return AuthenticityCheck::firstOrCreate(
                ['barcode' => trim($row['serial_no'])], 
                [
                    'title'             => $row['title'] ?? null,
                    'item'              => $row['item'] ?? null,
                    'gold'              => $row['gold'] ?? null,
                    'silver'            => $row['silver'] ?? null,
                    'stone'             => $row['stone'] ?? null,
                    'other_materials'   => $row['other_materials'] ?? null,
                    'price_exclusive'   => $row['price_exclusive'] ?? null,
                    'handcrafted'       => $row['handcrafted'] ?? null,
                    'exclusive_edition' => $row['exclusive_edition'] ?? null,
                ]
            );
        }
}
