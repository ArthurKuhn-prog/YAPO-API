<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Project extends Model
{
    use HasUuids;

    /**
     * This is the Project model. Used for storing and managing the portfolio's projects.
     * As such, it is a crucial part of how this API is built, and how the CMS will be later used.
     * 
     * Projects are characterized by:
     * - an id (Uuids for better storage and recognition)
     * - title (STRING. mostly used in the front-end for display. Back-end managing uses the id to refer to a project)
     * - description (JSON. optional, will be used as a description meta tag)
     * - thumbnail (OBJECT {url, alt} separated from the content for more efficient display later on, front-end wise)
     * - categories the project belongs to (ARRAY. optional, [Many To Many])
     * - content (OBJECT. A JSON object)
     * - resources (ARRAY OF OBJECTS. all the files, external and internal links linked to the project. [Many To Many], since a project can have multiple resources that can belongs to multiple projects)
     * - updated_at
     */

    protected $fillable = [
        'title',
        'description',
        'content',
        'thumbnail',
    ];

    /*
     * The thumbnail is, by default, a false boolean for faster display
     */
    protected $attributes = [
        'description' => null,
        'thumbnail' => null,
        'content' => null,
    ];

    protected $casts = [
        'thumbnail' => AsArrayObject::class,
        'content' => AsArrayObject::class
    ];

    /**
     * Defining the Many To Many function for projects' categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Defining the One To Many function for projects' medias.
     */
    public function medias(): BelongsToMany
    {
        return $this->belongsToMany(Media::class);
    }
}
