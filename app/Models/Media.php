<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * This is the Media model. Used for storing and managing the uploaded files and external urls for projects' resources.
     * 
     * Medias are characterized by:
     * - an id (Uuids for better storage and recognition)
     * - title (STRING. mostly for a easier managing of uploaded files by the user)
     * - type (OBJECT)
     * - project_id (ARRAY. All of the media's attached projects [Many To Many])
     * - updated_at
     */
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Defining the Many To Many function for media's projects.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
