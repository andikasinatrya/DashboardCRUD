<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Nisn;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:10|unique:nisns,nisn',
            'name' => 'required|string|max:255',
        ], [
            'nisn.unique' => 'NISN sudah terdaftar. Silakan gunakan NISN yang lain.',
        ]);
    
        $student = Student::create($request->only(['name']));
        $student->nisn()->create(['nisn' => $request->nisn]);
    
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nisn' => 'required|string|max:10|unique:nisns,nisn,' . $student->id,
            'name' => 'required|string|max:255',
        ], [
            'nisn.unique' => 'NISN sudah terdaftar. Silakan gunakan NISN yang lain.',
        ]);
    
        $student->update($request->only(['name']));
        $student->nisn()->update(['nisn' => $request->nisn]);
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        Nisn::where('student_id', $student->id)->delete();

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
