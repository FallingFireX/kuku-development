<?php

namespace App\Models\User;

use App\Models\Model;

class UserBorder extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'border_id', 'user_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_borders';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**********************************************************************************************

        RELATIONS
    **********************************************************************************************/

    /**
     * Get the user who owns the border.
     */
    public function user() {
        return $this->belongsTo('App\Models\User\User');
    }

    /**
     * Get the border associated with this user.
     */
    public function border() {
        return $this->belongsTo('App\Models\Border\Border');
    }

    /**********************************************************************************************

        ACCESSORS
    **********************************************************************************************/

    /**
     * Gets the stack's asset type for asset management.
     *
     * @return string
     */
    public function getAssetTypeAttribute() {
        return 'user_borders';
    }
}
