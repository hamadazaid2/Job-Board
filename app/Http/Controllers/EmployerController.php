<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        // this means to apply EmplyerPolicy to this crud functions
        $this->authorizeResource(Employer::class);
    }

    public function create()
    {
        return view('employer.create');
    }

    public function store(Request $request)
    {
        // create employer record + associate it to the logged in user
        auth()->user()->employer()->create(
            $request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name' // unique: ensures that the value for the company_name field is unique in the employers table
            ])
        );

        return redirect()->route('jobs.index')
            ->with('success', 'Your employer account was created!');
    }
}