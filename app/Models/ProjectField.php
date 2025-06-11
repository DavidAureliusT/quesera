<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectField extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFieldFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'category_id',
        'name',
        'description',
        'is_locked',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function fieldCategory(): BelongsTo
    {
        return $this->belongsTo(FieldCategory::class, 'category_id', 'id');
    }
}
