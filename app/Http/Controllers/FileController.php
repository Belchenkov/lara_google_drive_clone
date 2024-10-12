<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Resources\FileResource;
use App\Repositories\FileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(
        private readonly FileRepository $r_file
    )
    {}

    public function myFiles(string $folder = null): \Inertia\Response
    {
        $folder = new FileResource($this->r_file->firstByUserAndPath(auth()->id(), $folder));

        $files = FileResource::collection($this->r_file->getFilesPaginate(auth()->id()));

        $ancestors = FileResource::collection([
            ...$folder->ancestors,
            $folder
        ]);

        return Inertia::render('MyFiles', compact('files', 'folder', 'ancestors'));
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent;

        if (!$parent) {
            $parent = $this->r_file->getRoot(auth()->id());
        }

        $parent?->appendNode($this->r_file->saveByCreateNewFolder([
            'name' => $data['name'],
            'is_folder' => 1,
            'parent' => $parent,
        ]));
    }
}
