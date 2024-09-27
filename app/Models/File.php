<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use
        NodeTrait,
        HasFactory,
        SoftDeletes,
        HasCreatorAndUpdater;

    protected $fillable = [
        'name',
        'path',
        'is_folder',
        'mime',
        'size',
    ];

    public function isOwnedBy(int $user_id): bool
    {
        return $this->created_by === $user_id;
    }
}
