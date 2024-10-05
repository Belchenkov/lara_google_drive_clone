<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

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
            'path' => ($data['parent']->parent ? $data['parent']->parent->path . '/' : '') . Str::slug($data['name']),
        ]);
    }

    public function getRoot(int $user_id)
    {
        return File::query()
            ->whereIsRoot()
            ->where('created_by', $user_id)
            ->first();
    }

    public function getFilesPaginate(int $user_id, int $perPage = 10): LengthAwarePaginator
    {
        return File::query()
            ->where('created_by', $user_id)
            ->where('parent_id', $this->getRoot($user_id))
            ->orderBy('is_folder', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
