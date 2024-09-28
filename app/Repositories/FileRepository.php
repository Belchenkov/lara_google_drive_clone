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

    public function saveByCreateNewFolder(array $data): File
    {
        return File::create([
            'name' => $data['name'],
            'is_folder' => $data['is_folder'],
        ]);
    }

    public function getRoot(int $user_id): ?File
    {
        return File::query()
            ->whereIsRoot()
            ->where('created_by', $user_id)->firstOrFail();
    }
}
