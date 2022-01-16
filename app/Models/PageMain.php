<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PageMain extends Model
{
    use HasFactory;

    protected $table = 'page_main';

    public $timestamps = false;

    protected $primaryKey = 'page_id';

    protected $fillable = [
        'page_id',
        'phone_1',
        'phone_2',
        'seo_text',
        'seo'
    ];

    static function savePage(Request $request, int $page_id)
    {
        PageMain::where('page_id', $page_id)->update([
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'seo_text' => $request->seo_text,
        ]);
    }

}
