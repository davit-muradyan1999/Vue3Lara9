<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Str;
use Log;

trait UploadFile
{
    public function uploadFile($uploadedFiles, $folder = null, $disk = 'public', $filename = null)
    {
        $uploadedPaths = [];
        $allowedFileFormats = [
            'jpg', 'jpeg', 'gif', 'png', 'svg',
            'docx', 'xls', 'xlsx', 'pdf',
            'mp3', 'mp4', 'webp', 'avif'
        ];

        if (!Storage::disk($disk)->exists($folder)) {
            Storage::disk($disk)->makeDirectory($folder, 0775, true, true);
        }

        if (is_array($uploadedFiles)) {
            foreach ($uploadedFiles as $uploadedFile) {
                $uploadedPaths[] = $this->processFile($uploadedFile, $folder, $disk, $filename, $allowedFileFormats);
            }
        } else {
            $uploadedPaths[] = $this->processFile($uploadedFiles, $folder, $disk, $filename, $allowedFileFormats);
        }

        return $uploadedPaths;
    }

    private function processFile($uploadedFile, $folder, $disk, $filename, $allowedFileFormats)
    {
        $name = $filename ?: Str::random(30);
        $filePath = null;

        if ($uploadedFile) {
            if (is_string($uploadedFile) && preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $uploadedFile, $type)) {
                $uploadedFile = substr($uploadedFile, strpos($uploadedFile, ',') + 1);
                $type = strtolower(explode('/', $type[1])[1]);

                if (!in_array($type, $allowedFileFormats)) {
                    throw new \Exception('Invalid file type.');
                }

                $uploadedFile = str_replace(' ', '+', $uploadedFile);
                $uploadedFile = base64_decode($uploadedFile);

                if ($uploadedFile === false) {
                    throw new \Exception('base64_decode failed.');
                }

                $pathAndName = $folder . '/' . $name . '.' . $type;
                Storage::disk($disk)->put($pathAndName, $uploadedFile);
                $filePath = $pathAndName;

            } elseif ($uploadedFile instanceof \Illuminate\Http\UploadedFile) {
                $extension = strtolower($uploadedFile->getClientOriginalExtension());

                if (in_array($extension, $allowedFileFormats)) {
                    $filePath = $uploadedFile->storeAs($folder, $name . '.' . $extension, $disk);
                } else {
                    throw new \Exception('Invalid file format: ' . $extension);
                }
            }
        }

        return $filePath;
    }

}
