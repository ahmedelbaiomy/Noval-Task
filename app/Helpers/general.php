<?php
function uploadImage($folder, $image)
{
//    $image->store('/assets/images/', $folder);
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $destinationPath = public_path('/assets/images/'.$folder);
    $image->move($destinationPath, $imageName);
    return $imageName;

}
