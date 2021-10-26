<?php

namespace App;

class ImageGatherer
{
    public function fromDir(string $path) {
        $dir_contents = scandir($path, SCANDIR_SORT_NONE);

        // filter out everything except images
        $images = array_filter($dir_contents, function ($filename) use ($path) {
            $file_extension = pathinfo("{$path}/{$filename}", PATHINFO_EXTENSION);

            return in_array(strtolower($file_extension), ['jpeg', 'jpg', 'png', 'gif']);
        });

        return $images;
    }
}