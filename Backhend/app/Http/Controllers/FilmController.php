<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Films = Film::with('category')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($Films);
    }


    public function stream($filename)
    {
        $path = 'videos/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($path);
        $type = Storage::disk('public')->mimeType($path);

        return response($file, 200, [
            'Content-Type' => $type,
            'Access-Control-Allow-Origin' => '*'
        ]);
    }


    public function show($slug)
    {
        $film = Film::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        return response()->json($film);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $films = Film::with('category')
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%$query%")
                    ->orWhere('deskripsi', 'like', "%$query%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($films);
    }

    public function category($slug)
    {
        $films = Film::with('category')
            ->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($films);
    }
}
