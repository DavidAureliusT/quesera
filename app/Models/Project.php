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
        'name',
        'key',
        'icon_color',
        'description',
        'type',
    ];

    public function workflows(): HasMany
    {
        return $this->hasMany(Workflow::class, 'project_id', 'id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

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
