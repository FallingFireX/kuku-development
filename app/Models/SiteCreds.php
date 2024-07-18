<?php

namespace App\Models;

use App\Traits\Commentable;

class SitePage extends Model {
    use Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creds'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_creds';

}
