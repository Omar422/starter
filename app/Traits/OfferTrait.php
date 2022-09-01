<?php

namespace App\Traits;

Trait OfferTrait {
    function saveImage($request, $folder) {

        // save img in folder that i added in config/filesystem
        $file_extension = $request -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        // from form to folder
        $request->move($path, $file_name);

        return $file_name;

    }
}

?>