<?php

namespace AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class UploadFile
{
    public function indexAction(Request $request)
    {
        $files = $request->files->get('files');
        $fileName = $this->upload($files[0]);
        if (!$fileName) {
            throw new NotFoundHttpException('Error Uploading Image');
        }
        $status = ['files' => [
            ['url' => $request->headers->get('origin') . $fileName ]
        ]];
        return new JsonResponse($status);
    }

    public function upload(UploadedFile $file)
    {
        $location = '/home/vagrant/myblog/web';
        $path = '/images/' . date('Y') . '/' . date('m') . '/';
        $directory = $location . $path;
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);
        return $path . $fileName;
    }
}
