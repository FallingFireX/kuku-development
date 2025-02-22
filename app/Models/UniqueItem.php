<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\Models\User\UserItem;

class UniqueItem extends Model
{
    use HasFactory;

    protected $table = 'unique_items';

    protected $fillable = [
        'item_id',
        'item_slug',
        'category_1',
        'category_2',
        'link',
        'description',
        'owner_id',
        'deleted',
    ];

    /**
     * Relationship: Fetch the main category
     */
    public function category1()
    {
        return $this->belongsTo(UniqueItemCategory::class, 'category_1');
    }

    // Define relationship with UniqueItemCategory (Secondary Category)
    public function category2()
    {
        return $this->belongsTo(UniqueItemCategory::class, 'category_2');  // assuming 'category_2' is the foreign key in UniqueItem
    }
    

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }



    public static $createRules = [
        'category_2'        => 'nullable',
        'item_id'           => 'required|integer|min:1',
        'link'              => 'required|string|max:255',
        'description'       => 'required|string',
        'owner_id'          => 'nullable',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'category_2'        => 'nullable',
        'item_id'           => 'required|integer|min:1',
        'link'              => 'required|string|max:255',
        'description'       => 'required|string',
        'owner_id'          => 'nullable',
    ];
}
