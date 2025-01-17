<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::all();
        return view('hobbies.index', compact('hobbies'));
    }

    public function create()
    {
        return view('hobbies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Hobby::create($request->all());
        return redirect()->route('hobbies.index')->with('success', 'Hobby created successfully.');
    }

    public function edit(Hobby $hobby)
    {
        return view('hobbies.edit', compact('hobby'));
    }

    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hobby->update($request->all());
        return redirect()->route('hobbies.index')->with('success', 'Hobby updated successfully.');
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();
        return redirect()->route('hobbies.index')->with('success', 'Hobby deleted successfully.');
    }
}


