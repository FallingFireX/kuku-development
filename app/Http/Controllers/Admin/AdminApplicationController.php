<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Submission\AdminApplication;
use App\Models\Team;
use App\Services\AdminApplicationService;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller {
    /**
     * Shows the application index page.
     *
     * @param string $status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getApplicationIndex(Request $request, $status = null) {
        // Removed undefined $id, and corrected query to get all applications
        $applications = AdminApplication::where('status', $status ? ucfirst($status) : 'Pending')
            ->orderBy('updated_at', 'desc');

        // Handle sorting
        $data = $request->all();
        if (isset($data['sort'])) {
            switch ($data['sort']) {
                case 'newest':
                    $applications->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $applications->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            $applications->orderBy('created_at', 'asc');
        }

        $applications = $applications->paginate(30)->appends($request->query());

        // ✅ Fix: grab all relevant teams by their IDs, not just one
        return view('admin.team.application_index', [
            'applications' => $applications,
            'teams'        => Team::whereIn('id', $applications->pluck('team_id'))->get(),
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
        $applications = AdminApplication::where('id', $id)
            ->where('status', '!=', 'Draft')
            ->first();

        if (!$applications) {
            abort(404);
        }

        return view('admin.team.application', [
            'applications' => $applications,
            // ✅ Fix: fetch the single related team properly
            'teams'        => Team::where('id', $applications->team_id)->first(),
            'settings'     => Settings::get('notify_staff_applicants'),
        ]);
    }

    /**
     * Accept or deny an application.
     *
     * @param mixed|null $id
     */
    public function postApplication(Request $request, $id, AdminApplicationService $service) {
        $application = AdminApplication::findOrFail($id);

        if (!in_array($request->input('status'), ['accepted', 'denied'])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $data = [
            'id' => $application->id,
        ];

        $userId = auth()->id();

        if ($request->input('status') === 'accepted') {
            $service->acceptApplicant($data, $userId);
        } elseif ($request->input('status') === 'denied') {
            $service->rejectApplicant($data, $userId);
        }

        return redirect()->back()->with('success', 'Application '.strtolower($request->input('status')).' successfully.');
    }
}
