<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Repositories\FileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class FileController extends Controller
{
    public function __construct(
        private readonly FileRepository $r_file
    )
    {}

    public function myFiles(): \Inertia\Response
    {
        $files = $this->r_file->getFilesPaginate(auth()->id());

        return Inertia::render('MyFiles', compact('files'));
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
