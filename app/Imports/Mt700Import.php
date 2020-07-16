<?php

namespace App\Imports;

use App\Mt700;
use Maatwebsite\Excel\Concerns\ToModel;

class Mt700Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mt700([
            'C27' => $row[0],
            'C40A' => $row[1],
            'C20' => $row[2],
            'C31C' => $row[3],
            'C40E' => $row[4],
            'C31D' => $row[5],
            'C51D' => $row[6],
            'C51A' => $row[7],
            'C50' => $row[8],
            'C59' => $row[9],
            'C32B' => $row[10],
            'C39A' => $row[11],
            'C41D' => $row[12],
            'C42C' => $row[13],
            'C42A' => $row[14],
            'C42D' => $row[15],
            'C43P' => $row[16],
            'C43T' => $row[17],
            'C44E' => $row[18],
            'C44F' => $row[19],
            'C44C' => $row[20],
            'C45A' => $row[21],
            'C46A' => $row[22],
            'C47A' => $row[23],
            'C71B' => $row[24],
            'C48' => $row[25],
            'C49' => $row[26],
            'C53A' => $row[27],
            'C53D' => $row[28],
            'C78' => $row[29],
            'C57A' => $row[30],
            'C57D' => $row[31],
            'C72' => $row[32],
        ]);
    }
}
