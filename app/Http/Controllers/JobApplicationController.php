<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        return view('job_application.create', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        $user = auth()->user();

        // check if user already applied 
        $alreadyApplied = $job->jobApplications()->where('user_id', $user->id)->exists();
        if ($alreadyApplied) {
            return redirect()->route('jobs.show', $job)->with('error', 'You have already applied for this job.');
        }

        // create new application
        $job->jobApplications()->create(
            [
                'user_id' => auth()->user()->id, // or request()->user()->id
                ...$request->validate([
                    'expected_salary' => 'required|min:1|max:1000000'
                ])
            ]
        );

        return redirect()->route('jobs.show', $job)->with('success', 'Job application submitted!');
    }

    public function destroy(string $id)
    {
        //
    }
}
