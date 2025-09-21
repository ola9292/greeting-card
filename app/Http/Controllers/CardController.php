<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Card;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $backgrounds = Cache::remember('backgrounds_all', 3600, function () {
            return Background::select('id', 'name', 'file_path', 'occasion')->get();
        });

        // $songs = Cache::remember('songs_all', 3600, function () {
        //     return Song::select('id', 'name', 'file_path')->get();
        // });

        $songs = Song::all();

        return Inertia::render('Cards/Create', [
            'backgrounds' => $backgrounds,
            'songs' => $songs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'occasion' => ['required', 'string', 'max:50'],
            'background_id' => ['required', 'exists:backgrounds,id'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'sender_name' => ['required', 'string', 'max:255'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'song_id' => ['nullable', 'exists:songs,id'],
            'slug' => ['nullable', 'string', 'unique:cards,slug'],
        ]);

        $slug_str = $request->input('recipient_name').' '.Str::random(5);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($slug_str);
        }
        // $validated['song_id'] = 1;
        $card = Card::create($validated);

        // Debug: Check if session is being set
        \Log::info('Setting session data', [
            'card_slug' => $card->slug,
            'session_id' => session()->getId(),
        ]);

        return redirect()
            ->route('card.create')
            ->with([
                'success' => 'Card created successfully!',
                'card_slug' => $card->slug,
                'show_slug_modal' => true,
            ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // dd($slug);
        $card = Card::where('slug', $slug)->first();
        $backgroundImg = $card->background->file_path;
        $song = $card->song;

        return Inertia::render('Cards/Show', [
            'card' => $card,
            'backgroundImg' => $backgroundImg,
            'song' => $song,
        ]);
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
