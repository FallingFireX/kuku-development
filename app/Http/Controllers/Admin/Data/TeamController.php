<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User\User;

class TeamController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Team/Department controller
    |--------------------------------------------------------------------------
    |
    | Handles creation/editing of teams.
    |
    */

    /**
     * Shows the team index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex() {
        return view('admin.team.index', [
            'teams' => Team::orderBy('id')->get(),
        ]);
    }

    /**
     * Shows the create team page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateTeam() {
        return view('admin.team.create_edit_team', [
            'teams'       => new Team,
        ]);
    }

     /**
     * Shows the create team page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditTeam($id) {
        $team = Team::find($id);
        if (!$team) {
            abort(404);
        }
        $allTeams = Team::where('id', '!=', $team->id)->pluck('name', 'id');

        return view('admin.team.create_edit_team', [
            'teams'    => $team,
            'allTeams' => $allTeams,
           
        ]);
    }

    /**
     * Creates or edits a team
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditTeam(Request $request, $id = null) { 
        $request->validate([
                'name'           => 'required|between:2,225',
                'apps_open'      => 'nullable|boolean',
                'description'    => 'nullable',
                'relation'       => 'nullable',
            ]);

        if ($id) {
            // Editing an existing item
            $team = Team::findOrFail($id);
            $team->update($request->all());
            flash('Team updated successfully.')->success();
        } else {
            // Creating a new item
            $team = Team::create($request->all());
            flash('Team created successfully.')->success();
            return redirect()->to('admin/data/teams/edit/'.$team->id);
        }

        return redirect()->back();
    }


   
}
