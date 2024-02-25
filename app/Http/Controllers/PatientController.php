<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Medical;
use App\Models\NextOfKin;
use App\Models\Patient;
use App\Models\PatientHealthData;


class PatientController extends Controller
{
    public function index()
    {
        $phds = PatientHealthData::where('deleted','no')->orderByDesc('created_at')->get();

        $phds = $phds->unique('patient_id');

        return view('patients.index', compact('phds'));
    }
    public function add()
    {

        return view('patients.add');
    }
    public function edit($id)
    {
        $phd = PatientHealthData::find($id);
        $phds = PatientHealthData::where('patient_id', $phd->patient_id)->get();
        $nextOfKins = NextOfKin::whereIn('id',json_decode($phd->next_of_kin_ids))->get();
        return view('patients.edit', compact('phd','nextOfKins','phds'));
    }
    public function delete($id)
    {
        $phd = PatientHealthData::find($id);
        return view('patients.delete', compact('phd'));
    }
    public function show($id)
    {
        $phd = PatientHealthData::find($id);
        $phds = PatientHealthData::where('patient_id', $phd->patient_id)->get();

        $nextOfKins = NextOfKin::whereIn('id',json_decode($phd->next_of_kin_ids))->get();
        return view('patients.show', compact('phd','nextOfKins','phds'));
    }

    public function checkIdCard(Request $request)
    {
        $idCard = $request->input('IdCard');

        $patient = Patient::where('IdCard', $idCard)->first();


        return response()->json($patient);
    }


    public function save(Request $request)
    {

        if($request->crud == 'add'){

            $validationResult = $this->patientValidateFormData($request);

            if ($validationResult !== null) {
                return $validationResult;
            }
       
            $exists = Patient::where('IdCard', $request->IdCard)->exists();

            if($exists){
                $patient = Patient::where('IdCard', $request->IdCard)->first();
            }else{
                $patient = new Patient();
                $patient->IdCard = $request->IdCard;
                $patient->name = $request->name;
                $patient->surname = $request->surname;
                $patient->gender = $request->gender;
                $patient->DateOfBirth = $request->dob;
                $patient->address = $request->address;
                $patient->postcode = $request->postcode;
                $patient->ContactNumber1 = $request->contact_number1;
                $patient->ContactNumber2 = $request->contact_number2;
                $patient->save();
            }

            


            $nextOfKinids = array();
            $nextOfKinChunks = array_chunk($request->next_of_kin, 5); // Her bir kişi için 5 özellik olduğunu varsayarak

            foreach ($nextOfKinChunks as $nextOfKinData) {
                $nextOfKin = new NextOfKin();
                
                foreach ($nextOfKinData as $data) {
                    foreach ($data as $key => $value) {
                        $nextOfKin[$key] = $value;
                    }
                }
                $nextOfKin->patient_id = $patient->id; 
                $nextOfKin->save();
                $nextOfKinids[] = $nextOfKin->id;
            }

           
            $conditionsJson = json_encode($this->encodeDataToJson($request->conditions, 2));
            $allergiesJson = json_encode($this->encodeDataToJson($request->allergies, 2));
            $medicationsJson = json_encode($this->encodeDataToJson($request->medications, 4));



           
            $medical = new Medical();
            $medical->conditions = $conditionsJson;
            $medical->alergies = $allergiesJson;
            $medical->medication = $medicationsJson;
            
            $medical->save();



            $patient_health_data = new PatientHealthData();
            $patient_health_data->patient_id = $patient->id;
            $patient_health_data->next_of_kin_ids = json_encode($nextOfKinids);
            $patient_health_data->medical_id  = $medical->id;
            $patient_health_data->save();
           return redirect('/patients')->with('success', 'Patient added successfully.'); 
        }

        elseif($request->crud == 'edit'){


            $validationResult = $this->patientValidateFormData($request);

            if ($validationResult !== null) {
                return $validationResult;
            }


            $phd = PatientHealthData::find($request->phd_id);

            

            //dd($phd->next_of_kin_ids);

            $patient = Patient::find($phd->patient_id);
            $patient->IdCard = $request->IdCard;
            $patient->name = $request->name;
            $patient->surname = $request->surname;
            $patient->gender = $request->gender;
            $patient->DateOfBirth = $request->dob;
            $patient->address = $request->address;
            $patient->postcode = $request->postcode;
            $patient->ContactNumber1 = $request->contact_number1;
            $patient->ContactNumber2 = $request->contact_number2;
            $patient->save();


            $nextOfKinChunks = array_chunk($request->next_of_kin, 5); 
            $nextOfKinIds = json_decode($phd->next_of_kin_ids);

            $chunkcount = 0;
            foreach ($nextOfKinIds as $nextOfKinId) {
                $nextOfKin = NextOfKin::find($nextOfKinId);
                
                    foreach ($nextOfKinChunks[$chunkcount] as $nextOfKinData) {                    
                        foreach ($nextOfKinData as $key => $value) {
                            $nextOfKin->$key = $value;
                        }

                    }
                $chunkcount++;
                $nextOfKin->save();                
            }
            
            
            

            $conditionsJson = json_encode($this->encodeDataToJson($request->conditions, 2));
            $allergiesJson = json_encode($this->encodeDataToJson($request->allergies, 2));
            $medicationsJson = json_encode($this->encodeDataToJson($request->medications, 4));

            $medical = Medical::find($phd->medical_id);
            $medical->conditions = $conditionsJson;
            $medical->alergies = $conditionsJson;
            $medical->medication = $medicationsJson;

            $medical->save();


           return redirect('/patients')->with('success', 'Patient edited successfully.'); 
        }
        elseif($request->crud == 'delete'){
            $phd = PatientHealthData::find($request->phd_id);
            $phd->deleted = 'yes';
            $phd->save();

            return redirect('/patients')->with('success', 'Patient deleted successfully.'); 
        }
        
    }

    private function encodeDataToJson($data, $chunkSize) {
        $jsonData = [];
        $dataChunks = array_chunk($data, $chunkSize);

        foreach ($dataChunks as $dataChunk) {
            $chunkData = [];

            foreach ($dataChunk as $chunk) {
                foreach ($chunk as $key => $value) {
                    $chunkData[$key] = $value;
                }
            }

            $jsonData[] = $chunkData;
        }

        return $jsonData;
    }

    private function patientValidateFormData($request)
    {
        $rules = [
            'IdCard' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'contact_number1' => ['required', 'string', 'max:255', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'contact_number2' => ['nullable', 'string', 'max:255', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ];

        // Doğrulama yap
        $validator = Validator::make($request->all(), $rules);

        // Doğrulama başarısız olursa
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return null; // Başarılı doğrulama durumunda null döndür
    }

}
