<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasUuids;

    /**
     * This is the Article model. Used for storing and managing the portfolio's articles.
     * As such, it is a crucial part of how this API is built, and how the CMS will be later used.
     * 
     * Projects are characterized by:
     * - an id (Uuids for better storage and recognition)
     * - title (STRING. mostly used in the front-end for display. Back-end managing uses the id to refer to an article)
     * - description (LONG STRING. optional, will be used as a description meta tag)
     * - thumbnail (OBJECT {url, alt} separated from the content for more efficient display later on, front-end wise)
     * - categories the articles belongs to (ARRAY. optional, [Many To Many])
     * - content (OBJECT. A JSON object)
     * - updated_at
     */

    protected $fillable = [
        'title',
        'description',
        'content',
    ];

    /**
     * The thumbnail is, by default, a false boolean for faster display
     */
    protected $attributes = [
        'thumbnail' => false,
    ];

    /**
     * Defining the Many To Many function for articles' categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
