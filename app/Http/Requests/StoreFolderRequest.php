<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends ParentIdBaseRequest
{
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'name' => [
                    'required',
                    'string',
                    Rule::unique(File::class, 'name')
                        ->where('created_at', auth()->id())
                        ->where('parent_id', $this->parent_id)
                        ->whereNull('deleted_at')
                ],
            ]);
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Folder ":input" already exists.',
        ];
    }
}
