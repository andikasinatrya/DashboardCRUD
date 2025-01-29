<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user:id,name')->latest()->paginate(10);
        return view('dashboard.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('dashboard.show', compact('blog'));
    }
}
