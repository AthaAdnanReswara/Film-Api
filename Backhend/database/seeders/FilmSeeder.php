<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sciFi = Category::where("slug", "sci-fi")->first();
        $action = Category::where("slug", "action")->first();

        Film::create([
            'judul' => 'Inception',
            'slug' => 'inception',
            'deskripsi' => 'Film tentang mimpi dalam mimpi',
            'category_id' => $sciFi->id,
            'poster' => 'https://image.tmdb.org/t/p/w500/qmDpIHrmpJINaRKAfWQfftjCdyi.jpg',
            'vidio_url' => 'https://cdn.example.com/inception.mp4',
            'tahun' => '2010',
            'durasi' => '2h 28m',
            'rating' => 8.8,
        ]);

        Film::create([
            'judul' => 'Dongeng',
            'slug' => 'dongeng',
            'deskripsi' => 'Film tentang kata dalam mimpi',
            'category_id' => $action->id,
            'poster' => 'https://image.tmdb.org/t/p/w500/qmDpIHrmpJINaRKAfWQfftjCdyi.jpg',
            'vidio_url' => 'https://cdn.example.com/inception.mp4',
            'tahun' => '2010',
            'durasi' => '1h 28m',
            'rating' => 8.8,
        ]);
    }
}
