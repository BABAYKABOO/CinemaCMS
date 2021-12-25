<?php

namespace App\Models;

use Doctrine\Inflector\InflectorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Banner extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'banner_id',
        'postion_id',
        'url',
        'text',
        'img'
    ];

    static function saveBanner(Request $request , int $position)
    {

        PositionBanner::where('position_id', $position)->update([
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        if (isset($request->time))
            PositionBanner::where('position_id', $position)->update([
                'time' => (int)($request->time[0])
            ]);

        foreach($request->Banner as $id => $banner)
        {
            if($request->hasFile('Banner_' . $id . '_img')) {
                Banner::where('position_id', $position)->where('banner_id', $id)->update([
                    'img' => Image::saveImg($request,
                            'Banner_' . $id . '_img',
                             Banner::where('position_id', $position)->where('banner_id', $id)->first()->img)
                ]);
                $request->files->remove('Banner_'.$id.'_img');
            }

            foreach ($banner as $col => $value)
            {
                Banner::where('position_id', $position)->where('banner_id', $id)->update([
                    $col => $value
                ]);
            }
        }

        if (isset($request->newBanner))
        {
            foreach($request->newBanner as $id => $banner)
            {
                Banner::where('position_id', $position)->where('banner_id', $id)->update([
                    'img' => Image::saveImg($request, 'newBanner.'.$id.'.img')
                ]);
                dd(Banner::where('position_id', $position)->where('banner_id', $id)->get());
                foreach ($banner as $col => $value)
                {
                    Banner::insert('position_id', $position)->where('banner_id', $id)->update($col, $value);
                }
            }
        }
    }
}
