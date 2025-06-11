<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'icon',
        'name',
        'project_key',
        'description',
    ];

    public function accesses(): HasMany
    {
        return $this->hasMany(ProjectAccess::class, 'project_id', 'id');
    }

    public function administratorAccesses(): HasMany
    {
        return $this->accesses()->where('role_id', Role::where('name', 'Administrator')->id);
    }

    public function memberAccesses(): HasMany
    {
        return $this->accesses()->where('role_id', Role::where('name', 'Member')->id);
    }

    public function viewerAccesses(): HasMany
    {
        return $this->accesses()->where('role_id', Role::where('name', 'Viewer')->id);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(ProjectField::class, 'project_id', 'id');
    }
}
