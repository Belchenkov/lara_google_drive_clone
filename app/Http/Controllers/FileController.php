<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Repositories\FileRepository;
use Inertia\Inertia;

class FileController extends Controller
{
    public function __construct(
        private readonly FileRepository $r_file
    )
    {}

    public function myFiles()
    {
        return Inertia::render('MyFiles');
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();

        if (!$data['parent']) {
            $data['parent'] = $this->r_file->getRoot(auth()->id());
        }

        $data['parent']->appendNode($this->r_file->saveByCreateNewFolder([
            'name' => $data['name'],
            'is_folder' => 1,
        ]));
    }
}
