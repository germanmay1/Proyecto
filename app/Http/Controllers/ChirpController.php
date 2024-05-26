<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')->latest()->get();

        return Inertia::render('Home', [
            'chirps' => $chirps->map(function ($chirp) {
                return [
                    'id' => $chirp->id,
                    'message' => $chirp->message,
                    'user' => [
                        'name' => $chirp->user->name,
                    ],
                ];
            }),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp = auth()->user()->chirps()->create([
            'message' => $request->input('message'),
        ]);

        return redirect(route('home'));
    }

    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('home'));
    }
}
