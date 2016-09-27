<?php

namespace AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class FileUploadController
{
    private $imgDomain, $imgPath;

    public function __construct($imgDomain, $imgPath)
    {
        $this->imgDomain = $imgDomain;
        $this->imgPath = $imgPath;
    }

    public function indexAction(Request $request)
    {
        $files = $request->files->get('files');
        $fileName = $this->upload($files[0]);
        if (!$fileName) {
            throw new NotFoundHttpException('Error Uploading Image');
        }
        $status = ['files' => [
            ['url' => $this->imgDomain . $fileName ]
        ]];
        return new JsonResponse($status);
    }

    public function upload(UploadedFile $file)
    {
        $path =  date('Y') . '/' . date('m') . '/';
        $directory = $this->imgPath . '/' . $path;
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileName = 'original_' .  md5(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);
        return $path . $fileName;
    }
}
