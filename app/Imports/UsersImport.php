<?php

namespace App\Imports;
use App\Models\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $row)
        {

            $price  = $row["lianikis"]?$row["lianikis"]:0;
            $sku  = $row["kodikos"]?$row["kodikos"]:rand(1,999999);
            $name  = $row["perighrafi"]?$row["perighrafi"]:"lorem";
            $mm  = $row["mm"]?$row["mm"]:"test";
            Storage::create([
                'name' => $name,
                'slug' => Str::slug($name,"-"),
                'description' => null,
                'mm' => $mm,
                'sku' => $sku,
                'price' => $price,
                'quantity' => rand(0,1000),
            ]);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
