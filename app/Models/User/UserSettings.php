<?php

namespace App\Models\User;

use App\Models\Model;

class UserSettings extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'is_fto', 'submission_count', 'banned_at', 'ban_reason', 'birthday_setting', 'theme_id', 'selected_character_id',
        'deactivate_reason', 'deactivated_at', 'dev_log_notif'
=======
        'is_fto', 'submission_count', 'banned_at', 'ban_reason', 'birthday_setting',
        'deactivate_reason', 'deactivated_at', 'dev_log_notif'
>>>>>>> 235693a560fc31d8ed7e71dbc06473d44b753b2f
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_settings';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'banned_at'      => 'datetime',
        'deactivated_at' => 'datetime',
    ];

    /**
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'user_id';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user this set of settings belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the character the user has selected if appropriate.
     */
    public function selectedCharacter()
    {
        return $this->belongsTo('App\Models\Character\Character', 'selected_character_id')->visible();
    }
}
