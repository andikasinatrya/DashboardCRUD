<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Person;
use App\Models\Telephone;
use Illuminate\Http\Request;

class JsPersonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = Person::with('hobbies', 'nisn', 'telephones')->paginate(5);
        return view('javascript.telephones.index', compact('persons'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hobbies = Hobby::all();
        return view('javascript.telephones.create', compact('hobbies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'nisn' => 'required|numeric|unique:nisns,nisn',
            'telephone_number' => 'required|array|min:1',
            'telephone_number.*' => [
                'numeric',
                function ($attribute, $value, $fail) {
                    $exists = Telephone::where('telephone_number', $value)->exists();
    
                    if ($exists) {
                        $fail("Nomor telepon $value sudah terdaftar.");
                    }
                },
            ],
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.numeric' => 'NISN hanya boleh berisi angka',
            'nisn.unique' => 'NISN sudah ada',
            'telephone_number.required' => 'Nomor telepon harus diisi',
            'telephone_number.array' => 'Nomor telepon harus berupa array',
            'telephone_number.*.numeric' => 'Nomor telepon harus berupa angka',
        ]);
    
        $person = Person::create([
            'name' => $request->input('name'),
        ]);
    
        $person->nisn()->updateOrCreate(
            ['person_id' => $person->id],
            ['nisn' => $request->input('nisn')]
        );
    
        if ($request->has('telephone_number')) {
            foreach ($request->input('telephone_number') as $telephone) {
                Telephone::create([
                    'telephone_number' => $telephone,
                    'person_id' => $person->id,
                ]);
            }
        }
    
        if ($request->has('hobbies')) {
            $person->hobbies()->sync($request->hobbies);
        }
    
        return redirect()->route('javascriptpersones.index')->with('success', 'Data berhasil ditambahkan');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $person = Person::with('telephones')->findOrFail($id);
    //     return view('javascript.telephones.show', compact('person'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $person = Person::with('nisn', 'hobbies', 'telephones')->findOrFail($id);
        $hobbies = Hobby::all();
    
        return view('javascript.telephones.edit', compact('person', 'hobbies'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $person = Person::with('telephones')->findOrFail($id);
    
        $request->validate([
            'name' => 'required|min:3|max:255',
            'nisn' => 'required|numeric|unique:nisns,nisn,' . $id,
            'telephone_number' => 'required|array|min:1',
            'telephone_number.*' => [
                'numeric',
                function ($attribute, $value, $fail) use ($person) {
                    $exists = Telephone::where('telephone_number', $value)
                        ->where('person_id', '!=', $person->id)
                        ->exists();
    
                    if ($exists) {
                        $fail("Nomor telepon $value sudah terdaftar untuk pengguna lain.");
                    }
                },
            ],
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.numeric' => 'NISN hanya boleh berisi angka',
            'nisn.unique' => 'NISN sudah ada',
            'telephone_number.required' => 'Nomor telepon harus diisi',
            'telephone_number.array' => 'Nomor telepon harus berupa array',
            'telephone_number.*.numeric' => 'Nomor telepon harus berupa angka',
        ]);
    
        $person->update([
            'name' => $request->input('name'),
        ]);
    
        $person->nisn()->updateOrCreate(
            ['person_id' => $person->id],
            ['nisn' => $request->input('nisn')]
        );
    
        $person->telephones()->delete();
    
        foreach ($request->input('telephone_number') as $telephone) {
            Telephone::create([
                'telephone_number' => $telephone,
                'person_id' => $person->id,
            ]);
        }
    
        if ($request->has('hobbies')) {
            $person->hobbies()->sync($request->hobbies);
        } else {
            $person->hobbies()->detach();
        }
    
        return redirect()->route('javascriptpersones.index')->with('success', 'Data berhasil diperbarui');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Person::where('id',$id)->delete();
        return redirect()->route('javascriptpersones.index')->with('success','Data berhasil di hapus');
    }

}