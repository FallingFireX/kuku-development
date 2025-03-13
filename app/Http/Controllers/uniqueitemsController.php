<?php

namespace App\Http\Controllers;

use App\Models\UniqueItem;
use App\Models\UniqueItemCategory;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class uniqueitemsController extends Controller {
    public function getItemIndex(Request $request) {
        $sortByCategory1 = $request->get('category_1');
        $sortByCategory2 = $request->get('category_2');
        $sortOrder = $request->get('sort_order', 'asc');

        $categories = UniqueItemCategory::all();

        // Build the main query
        $query = UniqueItem::with(['category1', 'category2', 'owner'])
            ->whereNull('owner_id')
            ->orderBy('id', $sortOrder);

        if ($sortByCategory1) {
            $query->where('category_1', $sortByCategory1);
        }

        if ($sortByCategory2) {
            $query->where('category_2', $sortByCategory2);
        }

        // Apply pagination
        $items = $query->paginate(20);

        // Calculate if the item has existed for over a year
        $items->each(function ($item) {
            $item->is_over_a_year = Carbon::parse($item->created_at)->diffInYears(Carbon::now()) >= 1;
        });

        return view('uniqueitems.adoption_center', compact('items', 'categories', 'sortByCategory1', 'sortByCategory2', 'sortOrder'));
    }

    public function destroy($id) {
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
