<?php

namespace App\Http\Controllers\Api;

use App\Models\Telephone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TelephoneResource;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;

class ApiTelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch all telephone records with associated person
        $telephones = Telephone::with('person')->get();
    
        return response()->json(
            new TelephoneResource(true, 'List of Telephones', [
                'data' => $telephones,
            ]),
            Response::HTTP_OK
        );
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telephone_number' => 'required|numeric|unique:telephones,telephone_number',
            'person_id' => 'required|exists:persones,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json(
                new TelephoneResource(false, 'Validation error', $validator->errors()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        
        $telephone = Telephone::create([
            'telephone_number' => $request->telephone_number,
            'person_id' => $request->person_id
        ]);

        return response()->json(
            new TelephoneResource(true, 'Telephone created successfully', $telephone),
            Response::HTTP_CREATED
        );
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $telephone = Telephone::with('person')->find($id);
    
        if (!$telephone) {
            return response()->json(
                new TelephoneResource(false, 'Telephone not found', null),
                Response::HTTP_NOT_FOUND
            );
        }
    
        return response()->json(
            new TelephoneResource(true, 'Telephone details', [
                'id' => $telephone->id,
                'telephone_number' => $telephone->telephone_number,
                'person' => $telephone->person,
            ]),
            Response::HTTP_OK
        );
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $telephone = Telephone::find($id);
    
        if (!$telephone) {
            return response()->json(
                new TelephoneResource(false, 'Telephone not found', null),
                Response::HTTP_NOT_FOUND
            );
        }
    
        $validator = Validator::make($request->all(), [
            'telephone_number' => 'required|numeric|unique:telephones,telephone_number,' . $telephone->id,
        ]);
    
        if ($validator->fails()) {
            return response()->json(
                new TelephoneResource(false, 'Validation error', $validator->errors()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    
        $telephone->update([
            'telephone_number' => $request->telephone_number,
        ]);
    
        return response()->json(
            new TelephoneResource(true, 'Telephone updated successfully', [
                'id' => $telephone->id,
                'telephone_number' => $telephone->telephone_number,
            ]),
            Response::HTTP_OK
        );
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $telephone = Telephone::find($id);
    
        if (!$telephone) {
            return response()->json(
                new TelephoneResource(false, 'Telephone not found', null),
                Response::HTTP_NOT_FOUND
            );
        }
    
        $telephone->delete();
    
        return response()->json(
            new TelephoneResource(true, 'Telephone deleted successfully', [
                'id' => $id,
                'telephone_number' => $telephone->telephone_number,
            ]),
            Response::HTTP_OK
        );
    }
}
