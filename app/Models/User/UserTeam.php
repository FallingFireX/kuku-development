<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class UserTeam extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_admin_role';

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['teams'];

    
  
    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

   /**
     * Get the team associated with this record.
     */
    public function team() {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
