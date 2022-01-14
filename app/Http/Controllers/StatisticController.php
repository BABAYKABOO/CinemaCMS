<?php

namespace App\Http\Controllers;


use App\Filters\BookingsFilter;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatisticController extends Controller
{
    public function index(BookingsFilter $request)
    {
        $users = new User;
        $book = new Booking;
        if ($_GET['book_from_when'] != '')
            $book = $book->where('bookings.booking_date', '>', $_GET['book_from_when']);
        if ($_GET['book_to_when'] != '')
            $book = $book->where('bookings.booking_date', '<', $_GET['book_to_when']);

        $books_movie = $book->selectRaw('movies.name as name, count(movies.movie_id) as count')
            ->groupBy('movies.movie_id')
            ->orderBy('count', 'desc')
            ->join('timetables', 'timetables.timetable_id', '=', 'bookings.timetable_id')
            ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
            ->get();


        $book = new Booking;
        if ($_GET['tickets_from_when'] != '')
            $book = $book->where('bookings.booking_date', '>', $_GET['tickets_from_when']);
        if ($_GET['tickets_to_when'] != '')
            $book = $book->where('bookings.booking_date', '<', $_GET['tickets_from_when']);

        $tickets['price'] = $book
            ->join('timetables', 'timetables.timetable_id', '=', 'bookings.timetable_id')
            ->sum('timetables.price');
        $tickets['count'] = count($book->get());


        return view('admin.statistic', [
            'users' => $users,
            'tickets' => $tickets,
            'books_movie' => $books_movie,

        ]);
    }
}
