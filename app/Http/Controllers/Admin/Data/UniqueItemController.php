<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniqueItemCategory;
use App\Models\UniqueItem;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UniqueItemController extends Controller
{
    public function getItemIndex(Request $request)
    {
        $items = UniqueItem::with(['category1', 'owner'])->orderBy('id')->paginate(20);
        $user = User::pluck('name', 'id');

        return view('admin.uniqueitems.items', compact('items', 'user'));
    }


    public function getCreateItem() {

        $nextItemId = UniqueItem::max('id') + 1 ?? 1;

        $unique_item = new UniqueItem();
        $categories = UniqueItemCategory::pluck('category_name', 'id');
        $user = User::pluck('name','id');
        return view('admin.uniqueitems.create_edit_items', compact('unique_item', 'categories', 'user', 'nextItemId')) ;
    }

    public function getEditItem($id) {
        $item = UniqueItem::find($id);
        if (!$item) {
            abort(404);
        }

        $nextItemId = UniqueItem::max('id') + 1 ?? 1;

        $unique_item = UniqueItem::findOrFail($id); // Get the item from unique_items table
        $categories = UniqueItemCategory::pluck('category_name', 'id');
        $user = User::pluck('name','id');
        return view('admin.uniqueitems.create_edit_items', compact('unique_item', 'categories', 'user', 'nextItemId'));
    }

    /**
     * Creates or edits an item.
     *
     * @param App\Services\ItemService $service
     * @param int|null                 $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditItem(Request $request, $id = null) // $id is now optional
{
    $request->validate([
        'category_1' => 'required|exists:unique_item_categories,id',
        'category_2' => 'nullable|exists:unique_item_categories,id',
        'link' => 'required|string',
        'description' => 'required|string|max:10000',
        'owner_id' => 'nullable|sometimes|exists:users,id',
    ]);

    if ($id) {
        // Editing an existing item
        $item = UniqueItem::findOrFail($id);
        $item->update($request->all());
    } else {
        // Creating a new item
        $item = UniqueItem::create($request->all());
    }

    return redirect()->route('admin.uniqueitems.items')->with('success', $id ? 'Item updated successfully!' : 'Item created successfully!');
}


   
    public function store(Request $request)
    {
        $request->validate([
            'category_1' => 'required|exists:unique_item_categories,id',
            'category_2' => 'nullable|exists:unique_item_categories,id',
            'link' => 'required|string',
            'description' => 'required|string',
            'owner_id' => 'nullable|sometimes|exists:users,id',
        ]);

        UniqueItem::create([
            'category_1' => $request->category_1,
            'category_2' => $request->category_2,
            'link' => $request->link,
            'description' => $request->description,
            'owner_id' => $request->owner_id,
        ]);

        UniqueItem::create($request->all());

        return redirect()->route('/admin/data/adoption-center')->with('success', 'Item created successfully!');
    }

    public function deleteUniqueItem($id) {
    $uniqueItem = UniqueItem::find($id);

    if (!$uniqueItem) {
        return redirect()->route('admin.uniqueitems.items')->with('error', 'Item not found.');
    }

    $uniqueItem->delete();

    return redirect()->route('admin.uniqueitems.items')->with('success', 'Item deleted successfully.');
}


    public function destroy($id) {
        $uniqueItem = UniqueItem::findOrFail($id);
    
        // Ensure only authorized users can delete
        if (Auth::user()->hasPower('edit_inventories')) {
            $uniqueItem->delete(); // Soft delete
            return redirect()->route('admin.uniqueitems.items')->with('success', 'Unique item deleted successfully.');
        }
    
        return redirect()->back()->with('error', 'You do not have permission to delete this item.');
    }
    

    /**
     * Shows the item category index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex() {
        return view('admin.uniqueitems.categories', [
            'categories' => UniqueItemCategory::orderBy('id', 'ASC')->get(),
        ]);
    }

    /**
     * Shows the create item category page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateItemCategory() {
        return view('admin.uniqueitems.create_edit_category', [
            'category' => new UniqueItemCategory,
        ]);
    }

    /**
     * Shows the edit item category page.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditItemCategory($id) {
        $category = UniqueItemCategory::find($id);
        if (!$category) {
            abort(404);
        }

        return view('admin.uniqueitems.create_edit_category', [
            'category' => $category,
        ]);
    }

    /**
 * Handles the creation of a new item category.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function postCreateEditItemCategory(Request $request, $id = null) {
    // Validate the input
    $request->validate([
        'category_name' => 'required|string|max:255|unique:unique_item_categories,category_name,' . $id,
    ]);

    // Determine if creating or updating
    $category = $id ? UniqueItemCategory::find($id) : new UniqueItemCategory();

    // If updating, check if the category exists
    if ($id && !$category) {
        return redirect()->back()->with('error', 'Category not found.');
    }

    // Update or set the category name
    $category->category_name = $request->category_name;
    $category->save();

    // Redirect to the category list (not the edit route)
    return redirect()->route('admin.uniqueitems.categories')->with('success', $id ? 'Item updated successfully!' : 'Item created successfully!');
}

    

}
