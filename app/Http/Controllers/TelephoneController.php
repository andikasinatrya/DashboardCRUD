<?php

namespace App\Http\Controllers;

use App\Models\Telephone;
use Illuminate\Http\Request;

class TelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'telephone_number' => 'required|numeric|unique:telephones,telephone_number',
            'person_id' => 'required|exists:persones,id',
        ], [
            'telephone_number.required' => 'Nomor Telepon Wajib Diisi',
            'telephone_number.numeric' => 'Nomor Telepon hanya boleh berisi angka',
            'telephone_number.unique' => 'Nomor telepon sudah ada',
        ]);

        Telephone::create([
            'telephone_number' => $request->input('telephone_number'),
            'person_id' => $request->input('person_id')
        ]);

        return redirect()->route('persones.show', $request->input('person_id'))->with('success', 'Nomor telepon berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $telephone = Telephone::findOrFail($id);
        return view('telephones.edit-telepon', compact('telephone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'telephone_number' => 'required|numeric|unique:telephones,telephone_number',
        ], [
            'telephone_number.required' => 'Nomor Telepon Wajib Diisi',
            'telephone_number.numeric' => 'Nomor Telepon hanya boleh berisi angka',
            'telephone_number.unique' => 'Nomor telepon sudah ada',
        ]);

        $data = [
            'telephone_number' => $request->input('telephone_number'),
        ];

        Telephone::where('id', $id)->update($data);

        return redirect()->route('persones.show', $request->input('person_id'))->with('success', 'Nomor telepon berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Telephone::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Nomor telepon berhasil dihapus.');
    }
}
