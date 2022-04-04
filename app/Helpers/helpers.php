<?php


function SaveImage($photo,$folder){
    $file_extension=$photo->getClientOriginalExtension();
    $fileOriginalName= $photo->getClientOriginalName();
    $file_name=time().'_'.$fileOriginalName.'.'.$file_extension;
    $photo->move($folder,$file_name);
    return $file_name;
}

function deleteOldImage($imageName,$imagePath){
    \Illuminate\Support\Facades\File::delete(public_path('dashboard_files/'.$imagePath.'/'.$imageName));
}

function viewImage($imageName,$imagePath){
    return $imagePath . $imageName;
}
