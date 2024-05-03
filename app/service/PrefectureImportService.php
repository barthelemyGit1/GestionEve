<?php


namespace App\service;


use App\Models\Personnels;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class PrefectureImportService
{
    public function readExcelFile($path)
    {
        if (!empty($path) && is_file($path)) {
            $COLUMN_PERSONNELS = "nom";

            FastExcel::import($path, function ($data) use ($COLUMN_PERSONNELS) {


                if (isset($data[$COLUMN_PERSONNELS])) {
                    $personnels = new Personnels();
                    //$personnels->id = $data[$COLUMN_PERSONNELS];
                    $personnels->nom = $data[$COLUMN_PERSONNELS];
                    //$personnels->dateNaiss = $data[$COLUMN_PERSONNELS];
                    //$personnels->cnib = $data[$COLUMN_PERSONNELS];
                    //$personnels->tel = $data[$COLUMN_PERSONNELS];
                    //$personnels->service = $data[$COLUMN_PERSONNELS];

                    $personnels->save();
                }

            });
        }

    }

}
