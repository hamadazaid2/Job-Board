<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        return view('job.index', ['jobs' => Job::filter($filters)->get()]);
    }

    // public function index()
    // {
    //     $jobs = Job::query();

    //     // when => used to start execute the function when search sent in the request
    //     $jobs->when(request('search'), function ($query) {
    //         // this where is for set title or description inside ()
    //         // select * from `jobs` where (`title` LIKE '%claim%' or `description` LIKE '%claim%') and `salary` <= '100000' and `salary` >= '60000'
    //         $query->where(function ($query) {
    //             $query->where('title', 'LIKE', '%' . request('search') . '%')
    //                 ->orWhere('description', 'LIKE', '%' . request('search') . '%');
    //         });
    //     })->when(request('max_salary'), function ($query) {
    //         $query->where('salary', '<=', request('max_salary'));
    //     })->when(request('min_salary'), function ($query) {
    //         $query->where('salary', '>=', request('min_salary'));
    //     })->when(request('experience'), function ($query) {
    //         $query->where('experience', request('experience'));
    //     })->when(request('category'), function ($query) {
    //         $query->where('category', request('category'));
    //     });
    //     return view("job.index", ['jobs' => $jobs->get()]);
    // }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
