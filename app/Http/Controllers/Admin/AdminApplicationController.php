<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission\AdminApplication;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminApplicationController extends Controller {
    /**
     * Shows the submission index page.
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

 
}
