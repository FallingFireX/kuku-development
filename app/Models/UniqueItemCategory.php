<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueItemCategory extends Model
{
    use HasFactory;

    protected $table = 'unique_item_categories';

    protected $fillable = [
        'category_name',
    ];

    // Define relationship with UniqueItem
    public function uniqueItems()
    {
        return $this->hasMany(UniqueItem::class, 'category_1');
    }

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'category_name'        => 'required|unique:unique_item_categories|between:3,100',
    ];
}
