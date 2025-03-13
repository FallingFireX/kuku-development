<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller {
    public function getIndex() {
        $sidebar = Sidebar::first();

        // Pass the sidebar variable to the view
        return view('admin.sidebar.edit', compact('sidebar'));
    }

    public function update(Request $request) {
        // Validate the input data for each box
        $request->validate([
            'box1' => 'required|string',  // Ensure 'box1' field is provided and is a string
            'box2' => 'required|string',  // Ensure 'box2' field is provided and is a string
            'box3' => 'required|string',  // Ensure 'box3' field is provided and is a string
        ]);

        // Find the sidebar (only 1 row exists)
        $sidebar = Sidebar::first();  // This will get the first row, as you only have 1 row

        // If the sidebar doesn't exist, create a new one
        if (!$sidebar) {
            $sidebar = new Sidebar;
        }

        // Update the columns with the new values from the form
        $sidebar->box1content = $request->box1;
        $sidebar->box2content = $request->box2;
        $sidebar->box3content = $request->box3;

        // Save the changes to the database
        $sidebar->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Sidebar updated successfully.');
    }
}
