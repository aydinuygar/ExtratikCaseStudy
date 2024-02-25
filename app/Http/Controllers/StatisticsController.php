<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medical;
use App\Models\NextOfKin;
use App\Models\Patient;
use App\Models\PatientHealthData;


class StatisticsController extends Controller
{
    public function index()
    {
        $phds = PatientHealthData::where('deleted', 'no')->get();

        // Erkek ve kadın hastaları saymak için sayaçlar oluştur
        $maleCount = 0;
        $femaleCount = 0;

        // Her hasta sağlık verisini döngüye alarak cinsiyete göre sayım yap
        foreach ($phds as $phd) {
            // Hastanın cinsiyetine göre sayım yap
            if ($phd->patient->Gender === 'Male') {
                $maleCount++;
            } elseif ($phd->patient->Gender === 'Female') {
                $femaleCount++;
            }
        }

        // Sonuçları bir dizi olarak döndür
        $genderCounts = [
            'male' => $maleCount,
            'female' => $femaleCount,
        ];

        $conditionsCount = [];


        foreach ($phds as $phd) {
            // JSON formatındaki koşul verilerini PHP dizisine dönüştür
            $conditions = json_decode($phd->medical->conditions, true);

            // Her bir koşul için işlem yap
            foreach ($conditions as $condition) {
                // Koşulun adını al
                $conditionName = $condition['name'];

                // Koşulu $conditionsCount dizisine ekle ve varsa sayısını artır
                if (isset($conditionsCount[$conditionName])) {
                    $conditionsCount[$conditionName]++;
                } else {
                    $conditionsCount[$conditionName] = 1;
                }
            }
        }


        return view('statistics.index', compact( 'genderCounts', 'conditionsCount'));
    }

    
}
