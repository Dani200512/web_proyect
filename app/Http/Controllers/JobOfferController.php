<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    public function index()
    {
        $jobOffers = JobOffer::with('post')->where('profile_id', Auth::user()->profile->id)->paginate(10);
        return view('job_offers.index', compact('jobOffers'));
    }

    public function create()
    {
        return view('job_offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
        ]);

        $jobOffer = new JobOffer($request->all());
        $jobOffer->profile_id = Auth::user()->profile->id;
        $jobOffer->save();

        if ($request->has('return_to_post')) {
            $jobOffers = JobOffer::where('profile_id', Auth::user()->profile->id)
                                 ->whereNull('post_id')
                                 ->get();
            return view('posts.create', compact('jobOffers'));
        }

        return redirect()->route('job-offers.index')->with('success', 'Oferta de trabajo creada exitosamente.');
    }
    public function show(JobOffer $jobOffer)
    {
        $jobOffer->load('applications.profile');
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

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'requirements' => 'required',
        ]);

        $jobOffer->update($request->all());

        // Actualizar el post asociado
        $jobOffer->post->update([
            'description' => $request->title,
            'content' => $request->description,
        ]);

        return redirect()->route('job-offers.index')->with('success', 'Oferta de trabajo actualizada exitosamente.');
    }

    public function destroy(JobOffer $jobOffer)
    {
        $this->authorize('delete', $jobOffer);

        // Eliminar el post asociado
        $jobOffer->post->delete();

        // JobOffer se eliminará automáticamente debido a la relación de clave foránea con onDelete('cascade')

        return redirect()->route('job_offers.index')->with('success', 'Oferta de trabajo eliminada exitosamente.');
    }
}
