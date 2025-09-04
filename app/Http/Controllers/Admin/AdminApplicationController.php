<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission\AdminApplication;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminApplicationController extends Controller {
    /**
     * Shows the application index page.
     *
     * @param string $status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getApplicationIndex(Request $request, $status = null) {
        $applications = AdminApplication::with('team')->where('status', $status ? ucfirst($status) : 'Pending');
       
        if (isset($data['sort'])) {
            switch ($data['sort']) {
                case 'newest':
                    $applications->sortNewest();
                    break;
                case 'oldest':
                    $applications->sortOldest();
                    break;
            }
        } else {
            $applications->sortOldest();
        }

        return view('admin.submissions.application_index', [
            'applications' => $applications->paginate(30)->appends($request->query()),
            'teams' => Team::orderBy('id')->first(),

        ]);
    }

    /**
     * Shows the application detail page.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getApplication($id) {
        $applications = AdminApplication::where('id', $id)->where('status', '!=', 'Draft')->first();
        
        if (!$applications) {
            abort(404);
        }

        return view('admin.submissions.application', [
            'applications'       => $applications,
            'teams' => Team::orderBy('id')->first(),
        ]);
    }


    /**
     * Accept or deny a application
     */
    public function postApplication(Request $request, $id = null)
    {
        $application = AdminApplication::findOrFail($id);

        // Only allow valid statuses
        if (!in_array($request->input('status'), ['accepted', 'denied'])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $application->status = $request->input('status');

        // Optional: track which staff handled it
        $application->admin_id = auth()->id();

        // Optional: save staff comments
        if ($request->filled('admin_message')) {
            $application->admin_message = $request->input('admin_message');
        }

        $application->save();

        return redirect()->back()->with('success', 'Application ' . strtolower($application->status) . ' successfully.');
    }

 
}
