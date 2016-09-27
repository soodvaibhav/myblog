<?php

namespace AdminBundle\Services;

use Imagine\Imagick\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;

class ImageThumbnailService
{
    private $imageFolder, $thumbnailSizes = [[90, 60], [750, 500]];

    public function __construct($imageFolder)
    {
        $this->imageFolder = $imageFolder;
    }

    public function generateThmbnails($imageUrl)
    {
        $imagePath = $this->imageFolder . parse_url($imageUrl)['path'];
        list($width, $height) = getimagesize($imagePath);
        $imagine = new Imagine();

        $image = $imagine->open($imagePath);

        foreach ($this->thumbnailSizes as $size) {
            $thumbnailPath = str_replace('original', implode('_', $size), $imagePath);

            if ($width > $size[0] && $height > $size[1]) {
                $image->thumbnail(new Box($size[0], $size[1]), 'inset')
                    ->save($thumbnailPath, [
                        'resolution-x' => 1000,
                        'resolution-y' => 1000,
                        'quality' => 100,
                    ]);
            } else {
                $image->save($thumbnailPath);
            }
        }
    }
}
