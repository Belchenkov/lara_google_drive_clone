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
        return Inertia::render('MyFiles');
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent;

        if (!$parent) {
            $parent = $this->r_file->getRoot(Auth::id());
        }

        $parent?->appendNode($this->r_file->saveByCreateNewFolder([
            'name' => $data['name'],
            'is_folder' => 1,
            'parent' => $parent,
        ]));
    }
}
