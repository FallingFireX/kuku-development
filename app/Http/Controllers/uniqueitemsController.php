<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniqueItemCategory;
use App\Models\UniqueItem;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class uniqueitemsController extends Controller
{
    public function getItemIndex(Request $request)
{
    $sortByCategory1 = $request->get('category_1');  // Category 1 filter
    $sortByCategory2 = $request->get('category_2');  // Category 2 filter
    $sortOrder = $request->get('sort_order', 'asc');  // Default sort order

    // Fetch categories for dropdown (assuming Category model)
    $categories = UniqueItemCategory::all();

    // Start building the query
    $itemsQuery = UniqueItem::with(['category1', 'category2', 'owner'])
        ->orderBy('id', $sortOrder);

    $query = UniqueItem::query()->whereNull('owner_id');

    if ($request->has('category_1')) {
        $query->where('category_1', $request->category_1);
    }
    
    if ($request->has('category_2')) {
        $query->where('category_2', $request->category_2);
    }
    
    $items = $query->paginate(20);
    

    // Calculate if the item has existed for over a year
    $items->each(function ($item) {
        $item->is_over_a_year = Carbon::parse($item->created_at)->diffInYears(Carbon::now()) >= 1;
    });

    return view('uniqueitems.adoption_center', compact('items', 'categories', 'sortByCategory1', 'sortByCategory2', 'sortOrder'));
}


    public function destroy($id)
{
    $uniqueItem = UniqueItem::findOrFail($id);

    // Check if the user is an admin with the 'edit_inventories' permission
    if (Auth::user()->hasPower('edit_inventories')) {
        // Set the unique item as deleted (soft delete or hard delete depending on your setup)
        $uniqueItem->delete(); // If you are using soft deletes
        // OR
        // $uniqueItem->forceDelete(); // If you want to hard delete

        return redirect()->back()->with('success', 'Unique item deleted successfully.');
    }

    // If user doesn't have permission
    return redirect()->back()->with('error', 'You do not have permission to delete this item.');
}



}
