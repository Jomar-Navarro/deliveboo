<?php

namespace App\Functions;
use Illuminate\Support\Str;

class Helper{
    public static function generateSlug($string, $model){
        $slug = Str::of($string)->slug('-');
        $original_slug = $slug;

        $exist = $model::where('slug', $slug)->first();

        $count = 1;
        while($exist){
            $slug = $original_slug . '-' . $count;
            $exist = $model::where('slug', $slug)->first();
            $count++;
        }

        return $slug;

    }
}
