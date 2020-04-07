<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Helper
{
    public static function insertTagsIfHaveSharpSymbol($description) {

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

}
