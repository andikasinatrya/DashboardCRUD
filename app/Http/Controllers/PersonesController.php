<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Telephone;
use Illuminate\Http\Request;

class PersonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = Person::paginate(5); 
        return view('telephones.index', compact('persons')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('telephones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'nisn' => 'required|max:20|unique:persones,nisn',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'nisn.required' => 'Nisn tidak boleh kosong',
            'nisn.max' => 'Nisn maksimal 20 karakter',
            'nisn.unique' => 'Nisn sudah ada',
        ]);

        $data = [
            'name' => $request->input('name'),
            'nisn' => $request->input('nisn'),
        ];

        Person::create($data);

        return redirect()->route('persones.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $person = Person::with('telephones')->findOrFail($id);
        return view('telephones.show', compact('person'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $person = Person::findOrFail($id);
    
        $telephones = Telephone::where('person_id', $id)->get();
    
        return view('telephones.edit', compact('person', 'telephones'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'nisn' => 'required|max:20|unique:persones,nisn',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'nisn.required' => 'Nisn tidak boleh kosong',
            'nisn.max' => 'Nisn maksimal 20 karakter',
            'nisn.unique' => 'Nisn sudah ada',
        ]);

        $data = [
            'name' => $request->input('name'),
            'nisn' => $request->input('nisn'),
        ];

        Person::where('id',$id)->update($data);

        return redirect()->route('persones.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Person::where('id',$id)->delete();

        return redirect()->route('persones.index')->with('success','Data berhasil di hapus');
    }
}
