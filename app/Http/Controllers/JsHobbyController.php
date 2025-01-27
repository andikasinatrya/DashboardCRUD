<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Request;

class JsHobbyController extends Controller
{
    /**
     * Display a listing of the hobbies.
     */
    public function index()
    {
        $hobbies = Hobby::all();
        return view('javascript.hobbies.index', compact('hobbies'));
    }

    /**
     * Store a newly created hobby from the modal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Hobby::create($request->all());

        return redirect()->route('javascript.index')->with('success', 'Hobby created successfully.');
    }

    /**
     * Update the specified hobby in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
    
        $hobby = Hobby::findOrFail($id);
        $hobby->name = $request->input('name');
        $hobby->save();
    
        return redirect()->route('javascript.index');
    }
    

    /**
     * Remove the specified hobby from storage.
     */
    public function destroy($id)
    {
        $hobby = Hobby::findOrFail($id);
    
        $hobby->delete();
    
        return redirect()->route('javascript.index')->with('success', 'Hobby deleted successfully.');
    }
    
}
