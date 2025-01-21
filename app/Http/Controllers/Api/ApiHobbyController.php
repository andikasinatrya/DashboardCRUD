<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HobbyResource;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiHobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $hobbies = Hobby::all();

        return response()->json(
            new HobbyResource(true, 'List of hobbies', $hobbies),
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
        ]);
    
        if ($validator->fails()) {
            return response()->json(
                new HobbyResource(false, 'Validation error', $validator->errors()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    
        $hobby = Hobby::create([
            'name' => $request->name,
        ]);
    
        return response()->json(
            new HobbyResource(true, 'Hobby created successfully', $hobby),
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
        $hobby = Hobby::find($id);

        if (!$hobby) {
            return response()->json(
                new HobbyResource(false, 'Hobby not found', null),
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(
            new HobbyResource(true, 'Hobby details', $hobby),
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
        $hobby = Hobby::find($id);

        if (!$hobby) {
            return response()->json(
                new HobbyResource(false, 'Hobby not found', null),
                Response::HTTP_NOT_FOUND
            );
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(
                new HobbyResource(false, 'Validation error', $validator->errors()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $hobby->update([
            'name' => $request->name,
        ]);

        return response()->json(
            new HobbyResource(true, 'Hobby updated successfully', $hobby),
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
        $hobby = Hobby::find($id);

        if (!$hobby) {
            return response()->json(
                new HobbyResource(false, 'Hobby not found', null),
                Response::HTTP_NOT_FOUND
            );
        }

        $hobby->delete();

        return response()->json(
            new HobbyResource(true, 'Hobby deleted successfully', null),
            Response::HTTP_OK
        );
    }
}
