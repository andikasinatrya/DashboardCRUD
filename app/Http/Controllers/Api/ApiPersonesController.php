<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonesResource;
use Illuminate\Support\Facades\Validator;

class ApiPersonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $person = Person::with('nisn', 'hobbies')->get();
    
        return response()->json(
            new PersonesResource(true, 'List of Name', [
                'data' => $person,
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
            'name' => 'required|string|max:255',
            'nisn' => 'required|numeric|unique:nisns,nisn',
        ]);
        
        if ($validator->fails()) {
            return response()->json(
                new PersonesResource(false, 'Validation error', $validator->errors()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        
        $person = Person::create([
            'name' => $request->name,
        ]);
    
        $person->nisn()->create([
            'nisn' => $request->nisn,
        ]);
    
        if($request->has('hobbies')) {
            $hobbies = explode(',', $request->hobbies);
            $person->hobbies()->attach($hobbies);
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $person = Person::with('nisn', 'hobbies')->find($id);
    
        if (!$person) {
            return response()->json(
                new PersonesResource(false, 'Person not found', null),
                Response::HTTP_NOT_FOUND
            );
        }
    
        return response()->json(
            new PersonesResource(true, 'Person details', [
                'id' => $person->id,
                'name' => $person->name,
                'nisn' => $person->nisn->nisn ?? null,
                'hobbies' => $person->hobbies,
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
        $person = Person::find($id);
    
        if (!$person) {
            return response()->json(
                new PersonesResource(false, 'Person not found', null),
                Response::HTTP_NOT_FOUND
            );
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nisn' => 'required|numeric|unique:nisns,nisn,' . $person->id . ',person_id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(
                new PersonesResource(false, 'Validation error', $validator->errors()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    
        $person->update([
            'name' => $request->name,
        ]);
    
        $person->nisn()->updateOrCreate(
            ['person_id' => $person->id],
            ['nisn' => $request->nisn]
        );
    
        if ($request->has('hobbies')) {
            $hobbies = explode(',', $request->hobbies);
            $person->hobbies()->sync($hobbies);
        } else {
            $person->hobbies()->detach();
        }
    
        return response()->json(
            new PersonesResource(true, 'Person updated successfully', [
                'id' => $person->id,
                'name' => $person->name,
                'nisn' => $person->nisn->nisn ?? null,
                'hobbies' => $person->hobbies,
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
        $person = Person::find($id);
    
        if (!$person) {
            return response()->json(
                new PersonesResource(false, 'Person not found', null),
                Response::HTTP_NOT_FOUND
            );
        }
    
        if ($person->nisn) {
            $person->nisn()->delete();
        }
    
        $person->hobbies()->detach();
    
        $person->delete();
    
        return response()->json(
            new PersonesResource(true, 'Person deleted successfully', [
                'id' => $id,
                'name' => $person->name,
            ]),
            Response::HTTP_OK
        );
    }
}
