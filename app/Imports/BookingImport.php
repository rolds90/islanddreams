<?php

namespace App\Imports;

use App\Models\booking;
use App\Models\Courier;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BookingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $travel_date = Carbon::parse(Date::excelToDateTimeObject($row['travel_date']));
        return new booking([
            'slug'         => Str::slug(Str::lower($row['type'] . ' ' . $row['courier'] . ' ' . $row['origin'] . ' ' . $row['destination'] . ' ' . $travel_date->format('Y-n-j-G-i'))),
            'type'         => Str::upper($row['type']),
            'origin'       => $row['origin'],
            'destination'  => $row['destination'],
            'travel_date'  => $travel_date,
            'arrival_date' => Date::excelToDateTimeObject($row['arrival_date']),
            'courier_id'   => Courier::where('name', $row['courier'])->first()->id,
        ]);
    }
}
