<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasUuids;

    /**
     * This is the Category model. Used for storing and managing the categories for both projects and articles.
     * 
     * Categories are characterized by:
     * - an id (Uuids for better storage and recognition)
     * - title (STRING. mostly used in the front-end for display. Back-end managing uses the id to refer to a category)
     * - project_id (ARRAY. All of the category's attached projects [Many To Many])
     * - article_id (ARRAY, same, for the articles [Many To Many])
     * - updated_at
     */

    protected $fillable = [
        'title',
    ];

    /**
     * Defining the Many To Many function for category's projects.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Defining the One To Many function for category's articles.
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
