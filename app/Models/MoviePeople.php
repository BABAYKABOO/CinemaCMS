<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MoviePeople extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'people_id';

    protected $fillable = [
        'people_id',
        'movie_id',
        'position_id',
        'name',
    ];

    public function movie()
    {
        return $this->hasOne(Movie::class, 'movie_id', 'movie_id');
    }
    public function position()
    {
        return $this->hasOne(PeoplePosition::class, 'position_id', 'position_id');
    }

    static function createPeople(Request $request, int $movie_id)
    {
        if (count($request->People) != count(MoviePeople::where('movie_id', $movie_id)->get()))
        {
            MoviePeople::where('movie_id', $movie_id)->delete();
            foreach ($request->People as $person)
            {
                MoviePeople::insert([
                    'movie_id' => $movie_id,
                    'position_id' => $person['position'],
                    'name' => $person['name']
                ]);
            }
        }
    }
}
