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

    static function deleteBanners(array $new_banners, $old_banners)
    {

        foreach($old_banners as $old_banner)
        {
            $isDelete = true;
            foreach($new_banners as $id => $new_banner)
            {
                if ($old_banner->banner_id == $id) {
                    $isDelete = false;
                    break;
                }
            }
            if ($isDelete)
                Banner::where('position_id', $old_banner->position_id)->where('banner_id', $old_banner->banner_id)->delete();
        }
    }
    static function saveBanner(Request $request , int $position)
    {
        PositionBanner::where('position_id', $position)->update([
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        if (isset($request->time))
            PositionBanner::where('position_id', $position)->update([
                'time' => (int)($request->time[0])
            ]);


        $old_banners = Banner::where('position_id', $position)->get();
        if (count($request->Banner) < count($old_banners))
            Banner::deleteBanners($request->Banner, $old_banners);


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
                Banner::where('position_id', $position)->where('banner_id', $id)->update([
                    $col => $value
                ]);
        }

        if (isset($request->newBanner))
        {
            foreach($request->newBanner as $id => $banner)
            {
                Banner::insert([
                    'banner_id' => $id,
                    'position_id' => $position,
                    'url' => $banner['url'],
                    'text' => $banner['text'],
                    'img' => Image::saveImg($request,
                             'newBanner_' . $id . '_img')
                ]);
                $request->files->remove('newBanner_'.$id.'_img');
            }
        }
    }
}
