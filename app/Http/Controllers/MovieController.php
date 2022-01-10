<?php

namespace App\Http\Controllers;

use App\Filters\TimetablesFilter;
use App\Models\Cinema;
use App\Models\Gallery;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MoviePeople;
use App\Models\Timetable;
use App\Models\Type;
use DateTime;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class MovieController extends Controller
{
    public function translateDate(string $date) : string
    {
        $week = [
            'Вc',
            'Пн',
            'Вт',
            'Ср',
            'Чт',
            'Пт',
            'Сб'
        ];

        $arr = new DateTime($date);
        return $arr->format('d') . ' ' . $week[$arr->format('N')-1];
    }
    public function showMovie(TimetablesFilter $request, int $id)
    {
        $movie = Movie::where('movie_id', $id)
            ->join('images', 'images.image_id', '=', 'movies.mainimg')
            ->first();
        $gallery = Gallery::where('gallery_id', $movie->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();
        $people = MoviePeople::join('people_positions', 'people_positions.position_id', '=', 'movie_people.position_id')
            ->get();
        $genres = MovieGenre::join('genres', 'genres.genre_id', '=', 'movie_genres.genre_id')
            ->get();

        $cinemas = Cinema::get();

        $start_date = date('Y-m-d');
        $dates = array();
        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', strtotime($start_date . '+ ' . $i . 'days'));
            $dates[$this->translateDate($date)] = $date;
        }
        $timetables = Timetable::filter($request)
            ->where('movie_id', $id)
            ->orderBy('data')
            ->join('types', 'types.type_id', '=', 'timetables.type_id')
            ->join('halls', 'halls.hall_id', '=', 'timetables.hall_id')
            ->get();

        return view('movie', [
            'movie' => $movie,
            'gallery' => $gallery,
            'people' => $people,
            'genres' => $genres,
            'dates' => $dates,
            'cinemas' => $cinemas,
            'timetables' => $timetables
        ]);
    }
}
