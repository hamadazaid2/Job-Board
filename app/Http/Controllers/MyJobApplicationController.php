<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'my_job_application.index',
            [
                'applications' => auth()->user()
                    ->jobApplications()
                    ->with([
                        'job' => fn($query) => $query->withCount('jobApplications') // get the count of the jobApplications that applied to this job
                            ->withAvg('jobApplications', 'expected_salary'), // get the average
                        'job.employer'
                    ])
                    ->latest()
                    ->get(),
            ]
        );
    }

    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();

        return redirect()->back()->with('success', 'Job application removed!');
    }
}
