<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    public function saveAfterRegister(array $data): File
    {
        $file = File::create([
            'name' => $data['name'],
            'is_folder' => $data['is_folder'],
        ]);

        return $file->makeRoot();
    }
}
