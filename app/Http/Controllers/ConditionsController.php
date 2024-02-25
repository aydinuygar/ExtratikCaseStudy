<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medical;
use App\Models\NextOfKin;
use App\Models\Patient;
use App\Models\PatientHealthData;

class ConditionsController extends Controller
{
    public function index()
    {
        $phds = PatientHealthData::where('deleted', 'no')->get();

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
        return view('conditions.index', compact('conditionsCount'));
    }
    public function show($condition)
    {
        $medicalRecordsIds = Medical::whereJsonContains('conditions', ['name' => $condition])->pluck('id');
        
        $medicalRecordsIds = $medicalRecordsIds->toArray();

        $phds = PatientHealthData::whereIn('medical_id', $medicalRecordsIds)->where('deleted','no')->get();
        $uniquePhds = $phds->groupBy('patient_id')->map->first();
        
        return view('conditions.show', compact('phds', 'condition'));
    }

   
}
