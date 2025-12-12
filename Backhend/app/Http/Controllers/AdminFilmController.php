<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminFilmController extends Controller
{
    /**
     * GET /api/admin/films
     * Tampilkan semua film (admin bisa lihat semuanya)
     */
    public function index()
    {
        $films = Film::with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($films);
    }

    /**
     * POST /api/admin/films
     * Tambah data film baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'slug'         => 'nullable|string|max:255|unique:films,slug',
            'category_id'  => 'required|exists:categories,id',

            // File upload
            'poster'       => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'video'        => 'required|file|mimes:mp4,mkv,avi,webm|max:204800', // 200MB

            // Fields tambahan
            'tahun'        => 'nullable|string|max:10',
            'durasi'       => 'nullable|string|max:50',
            'rating'       => 'nullable|numeric|min:0|max:10',

            'is_published' => 'required|boolean',
        ]);

        $url_storage = 'http://localhost:8000/storage/';

        // Simpan poster → tetap pakai /storage
        $posterStored = $request->file('poster')->store('posters', 'public');
        $posterPath = $url_storage . $posterStored;

        // Simpan video → arahkan ke route streaming
        $videoStored = $request->file('video')->store('videos', 'public');
        $videoPath = 'http://localhost:8000/api/videos/' . basename($videoStored);


        // Generate slug jika kosong
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        $film = Film::create([
            'judul'        => $data['judul'],
            'slug'         => $data['slug'],
            'deskripsi'    => $data['deskripsi'] ?? null,
            'category_id'  => $data['category_id'],
            'poster'       => $posterPath,
            'vidio_url'    => $videoPath,
            'tahun'        => $data['tahun'] ?? null,
            'durasi'       => $data['durasi'] ?? null,
            'rating'       => $data['rating'] ?? 0,
            'is_published' => $data['is_published'],
        ]);

        return response()->json([
            'message' => 'Film berhasil ditambahkan',
            'film'    => $film
        ]);
    }



    /**
     * GET /api/admin/films/{id}
     * Detail film untuk halaman edit
     */
    public function show($id)
    {
        $film = Film::with('category')->findOrFail($id);

        return response()->json($film);
    }

    /**
     * PUT /api/admin/films/{id}
     * Update data film
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * DELETE /api/admin/films/{id}
     * Hapus film
     */
    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return response()->json([
            'message' => 'Film berhasil dihapus'
        ]);
    }
}

