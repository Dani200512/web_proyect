<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function apply(JobOffer $jobOffer)
    {
        return view('job_applications.apply', compact('jobOffer'));
    }

    public function store(Request $request, JobOffer $jobOffer)
    {
        $request->validate([
            'message' => 'required|min:10',
        ]);

        JobApplication::create([
            'job_offer_id' => $jobOffer->id,
            'profile_id' => Auth::user()->profile->id,
            'message' => $request->message,
        ]);

        return redirect()->route('job-offers.show', $jobOffer)->with('success', 'Aplicación enviada exitosamente.');
    }

    public function update(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Estado de la aplicación actualizado.');
    }
}
