<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecitationRequest;
use App\Http\Requests\UpdateRecitationRequest;
use App\Models\Recitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RecitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recitations = Recitation::where('user_id', Auth::id())->get();

        return view('player.index', [
            'recitations' => $recitations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('player.upload');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecitationRequest $request)
    {
        $path = $request->file('recitation')->store('recitations');
        Auth::user()->recitations()->create([
            'name' => request('name'),
            'reciter_name' => request('reciter_name'),
            'path' => $path,
        ]);

        return redirect('/recitations');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recitation $recitation)
    {
        Gate::authorize('viewOrModify', $recitation);

        return view('player.edit', ['recitation' => $recitation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecitationRequest $request, Recitation $recitation)
    {
        Gate::authorize('viewOrModify', $recitation);
        $recitation->name = request('name');
        $recitation->reciter_name = request('reciter_name');
        if ($request->hasFile('recitation')) {
            Storage::delete($recitation->path);
            $recitation->path = $request->file('recitation')->store('recitations');
        }
        $recitation->save();

        return redirect('/recitations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recitation $recitation)
    {
        Gate::authorize('viewOrModify', $recitation);
        Storage::delete($recitation->path);
        $recitation->deleteOrFail();

        return redirect('/recitations');
    }
}
