<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadAble
{
    /**
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    private function uploadOne(UploadedFile $file, $folder = null, string $disk = 'public', $filename = null)
    {
        $name = $filename ?? Str::random(25);
       // return Storage::disk($disk)->put('images/originals', $file);
        return $file->storeAs(
                $folder,
                $name . '.' . $file->getClientOriginalExtension(),
                $disk
            );
    }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteOne($path = null, $disk = 'public'): void
    {
        Storage::disk($disk)->delete($path);
    }
}
