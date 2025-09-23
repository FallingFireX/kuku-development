<?php

namespace App\Models;

use App\Models\Model;

class SiteIndex extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'type', 'identifier', 'description',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_index';

    /**********************************************************************************************

        OTHER FUNCTIONS

     **********************************************************************************************/

    public function findPageUrlStructure($type, $key) {
        $search = strtolower($type);

        $item = '/world/items?name=';
        $character = '/character/';
        $user = '/user/';
        $page = '/info/';
        $pet = '/world/pets/';
        $prompt = '/prompts/';
        $shop = '/shops/';
        $feature = '/world/traits?name=';
        //Add additional variables here with structure for custom search types

        $domain = $_SERVER['SERVER_NAME'];

        return ${$search}.$key;
    }
}
