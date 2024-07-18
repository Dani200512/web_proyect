<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    public function index(Request $request)
    {
        $jobOffers = JobOffer::with('post')->where('profile_id', Auth::user()->profile->id)->paginate(10);

        if ($request->wantsJson()) {
            return response()->json($jobOffers);
        }

        return view('job_offers.index', compact('jobOffers'));
    }

    public function create()
    {
        return view('job_offers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
        ]);

        $jobOffer = new JobOffer($validatedData);
        $jobOffer->profile_id = Auth::user()->profile->id;
        $jobOffer->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Oferta de trabajo creada exitosamente.', 'job_offer' => $jobOffer], 201);
        }

        if ($request->has('return_to_post')) {
            $jobOffers = JobOffer::where('profile_id', Auth::user()->profile->id)
                                 ->whereNull('post_id')
                                 ->get();
            return view('posts.create', compact('jobOffers'));
        }

        return redirect()->route('job-offers.index')->with('success', 'Oferta de trabajo creada exitosamente.');
    }

    public function show(Request $request, JobOffer $jobOffer)
    {
        $jobOffer->load('applications.profile');

        if ($request->wantsJson()) {
            return response()->json($jobOffer);
        }

        return view('job_offers.show', compact('jobOffer'));
    }

    public function edit(JobOffer $jobOffer)
    {
        $this->authorize('update', $jobOffer);
        return view('job_offers.edit', compact('jobOffer'));
    }

    public function update(Request $request, JobOffer $jobOffer)
    {
        $this->authorize('update', $jobOffer);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
        ]);

        $jobOffer->update($validatedData);

        // Actualizar el post asociado
        $jobOffer->post->update([
            'description' => $request->title,
            'content' => $request->description,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Oferta de trabajo actualizada exitosamente.', 'job_offer' => $jobOffer]);
        }

        return redirect()->route('job-offers.index')->with('success', 'Oferta de trabajo actualizada exitosamente.');
    }

    public function destroy(Request $request, JobOffer $jobOffer)
    {
        $this->authorize('delete', $jobOffer);

        // Eliminar el post asociado
        $jobOffer->post->delete();

        // JobOffer se eliminará automáticamente debido a la relación de clave foránea con onDelete('cascade')

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Oferta de trabajo eliminada exitosamente.'], 200);
        }

        return redirect()->route('job_offers.index')->with('success', 'Oferta de trabajo eliminada exitosamente.');
    }
}
