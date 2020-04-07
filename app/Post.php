<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    protected $fillable = ['user_id','description','image'];

    static $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico',
        'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function insertTagsIfHaveSharpSymbol($description)
    {
        $tags = [];
        $regEx = "/#(\w)+/";
        preg_match_all($regEx, $description, $matches,PREG_PATTERN_ORDER);

        if(!empty($matches[0]))
        {
            foreach ($matches[0] as $match){
                $exist = DB::table('tags')->where('title',$match)->exists();
                $tag = 0;
                if(!$exist){
                    $tag = DB::table('tags')->insertGetId([
                        'title' => $match,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                }else{
                    $tag = DB::table('tags')
                        ->where('title', $match)
                        ->value('id');
                }

                array_push($tags, $tag);
            }
            return $tags;
        }
        return $tags;
    }

    public static function saveImage($request)
    {
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            if(in_array($extension, self::$imageExtensions))
            {
                $extension = '.'.$extension;
                $fileName = str_replace($extension,
                    auth()->user()->id.'_'.date('d-m-Y-H-i-sa') . $extension,
                    $request->image->getClientOriginalName());

                $image->storeAs('public/posts', $fileName);

                return $fileName;
            }
        }
    }

}
