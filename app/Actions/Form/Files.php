<?php

namespace App\Actions\Form;

use App\Models\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

trait Files
{
    public function saveImage($image, $type, $fileType, $storeRecord, $number = 0)
    {
        $storagePath = storage_path() . '/app/public/';
        if(!is_dir($storagePath . $this->state['id'] . '/images/')) {
            mkdir($storagePath . $this->state['id'] . '/images/', 0777, true);
        }

        $path = $this->state['id'] . '/images/' . $number . str_shuffle(date("jmi")) . substr($this->type, 0, 2) . strtoupper(substr($type, 0, 3)) . Str::random(6) . '.jpg';

        Image::make($image)->encode('jpg', 75)->save($storagePath . $path);

        if($storeRecord) $this->storeFile($path, $type, $fileType);
    }

    public function saveFile($file, $type, $fileType, $storeRecord, $number = 0)
    {
        $storagePath = storage_path() . '/app/public/';
        if(!is_dir($storagePath . $this->state['id'] . '/files/')) {
            mkdir($storagePath . $this->state['id'] . '/files/', 0777, true);
        }

        if($file->customName ?? false) {
            $name = $file->customName . '.' . $file->getClientOriginalExtension();
        }else {
            $name = $number . Str::random(1) . str_shuffle(date("mi")) . $file->getClientOriginalName();
        }

        $path = $this->state['id'] . '/files/';

        $file->storeAs($path, $name, 'public');

        if($storeRecord) $this->storeFile($path . $name, $type, $fileType);
    }

    public function storeFile($path, $type = 'files', $fileType = 'file')
    {
        $record = new File;
        $record->path = $path;
        $record->type = $type;
        $record->file_type = $fileType;
        $record->post_type = $this->type;
        $record->post_id = $this->state['id'];
        $record->save();
    }

    public function deleteFile($file)
    {
        @unlink(storage_path('app/public/' . $file['path']));
        File::find($file['id'])->delete();
    }
}