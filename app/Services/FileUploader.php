<?php

namespace App\Services;

use App\Models\UploadedFile;
use \Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class FileUploader
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * FileUploader constructor.
     *
     * @param ImageManager $imageManager
     */
    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * @param HttpUploadedFile $file
     *
     * @return UploadedFile
     */
    public function upload(HttpUploadedFile $file): UploadedFile
    {
        $uploadedFileName = Storage::put('/', $file);
        $resizedFileName  = 'resized_' . $uploadedFileName;

        Storage::copy($this->getPath($uploadedFileName), $this->getPath($resizedFileName));

        $duplicatedFile  = Storage::get($this->getPath($resizedFileName));

        Storage::put($this->getPath($resizedFileName), $this->resize($duplicatedFile));

        return UploadedFile::create([
            'original_filename' => $file->getClientOriginalName(),
            'filename' => $uploadedFileName,
            'resized_filename' => $resizedFileName
        ]);
    }

    /**
     * @param $file
     *
     * @return string
     */
    private function resize($file): string
    {
        $img = $this->imageManager->make($file);

        $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return (string) $img->encode();
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    private function getPath(string $fileName): string
    {
        return '/' . $fileName;
    }
}
