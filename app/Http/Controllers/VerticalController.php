<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\ContactMail;
use App\Models\Vassociation;
use App\Models\Passociation;
use App\Models\Document_type;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\Vertical;
use App\Models\Team;
use App\Models\Member;
use App\Models\Role;
use App\Models\Media;
use App\Models\User;
use Passociations;
use Vassociations;
use verticals;
use Projects;
use Members;
use Teams;
use Users;
use Auth;
use DB;

class VerticalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showReport()
    {

        $resolve = User::where('role', '3')->get();
        $open = User::where('role', '4')->get();
        $pendingBank = User::where('role', '5')->get();
        $bob = Project::where('vertical_id', '1')->get();
        $uco = Project::where('vertical_id', '2')->get();
        $bupb = Project::where('vertical_id', '3')->get();
        $sbi = Project::where('vertical_id', '4')->get();
        $pnb = Project::where('vertical_id', '5')->get();

        $resolve_count = count($resolve);
        $open_count = count($open);
        $pending_bankcount = count($pendingBank);

        $bob_count = count($bob);
        $uco_count = count($uco);
        $bupb_count = count($bupb);
        $sbi_count = count($sbi);
        $pnb_count = count($pnb);

        return view('vertical.showReport', compact('resolve_count', 'open_count', 'pending_bankcount', 'bob_count', 'uco_count', 'bupb_count', 'sbi_count', 'pnb_count'));
    }

    public function index()
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $allowedVerticals = ['1', '2', '3', '4', '5'];
        if (in_array(auth()->user()->vertical, $allowedVerticals)) {
            $users = User::whereIn('role', [4, 5])->get();
            $projects = Project::where('added_by', Auth::user()->id)->get();
            $monthYear = DB::table('projects')
                ->select(DB::raw('DISTINCT f_year'))
                ->orderBy('f_year', 'DESC')
                ->get();

            $data = [];
            foreach ($projects as $project) {
                // Use optional() to handle cases where the relationship might not exist
                $spocs = Passociation::where('p_id', $project->id)->get();
                $heads = '';
                foreach ($spocs as $spoc) {
                    $user = User::find($spoc->u_id)->name ?? "NA";
                    $heads .= $user . ' ';
                }
                $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
                // Use ternary operator for status
                $stat = $project->status == 1 ? "Active" : "Inactive";
                $temp = [
                    'id' => $project->id ?? "NA",
                    'name' => $project->p_name,
                    'fyear' => $project->f_year,
                    'p_target' => $project->p_target,
                    'p_status' => $project->p_status,
                    'details' => $project->p_details,
                    'head' => $heads,
                    'vertical' => $vertical,
                    'status' => $stat
                ];

                $data[] = $temp;
            }
            $teams = Team::where('added_by', Auth::user()->id)->get();
            return view('vertical.index', compact('users', 'data', 'monthYear', 'teams', 'authdata'));
        } elseif (in_array(auth()->user()->vertical, $allowedVerticals)) {
            //$users = User::whereIn('role', [4, 5])->get();
            $projects = Project::where('added_by', Auth::user()->id)->get();
            $monthYear = DB::table('projects')
                ->select(DB::raw('DISTINCT f_year'))
                ->orderBy('f_year', 'DESC')
                ->get();
            $data = [];
            foreach ($projects as $project) {
                // Use optional() to handle cases where the relationship might not exist
                $user = User::find($project->n_spoc)->name ?? "NA";
                $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
                // Use ternary operator for status
                $stat = $project->status == 1 ? "Active" : "Inactive";
                $temp = [
                    'id' => $project->id ?? "NA",
                    'name' => $project->p_name,
                    'fyear' => $project->f_year,
                    'p_target' => $project->p_target,
                    'details' => $project->p_details,
                    'head' => $user,
                    'vertical' => $vertical,
                    'status' => $stat
                ];
                $data[] = $temp;
            }
            $teams = Team::where('added_by', Auth::user()->id)->get();
            return view('vertical.index', compact('data', 'monthYear', 'teams', 'authdata'));
        } elseif (in_array(auth()->user()->vertical, $allowedVerticals)) {
            //$users = User::whereIn('role', [4, 5])->get();
            $projects = Project::where('added_by', Auth::user()->id)->get();
            $monthYear = DB::table('projects')
                ->select(DB::raw('DISTINCT f_year'))
                ->orderBy('f_year', 'DESC')
                ->get();
            $data = [];
            foreach ($projects as $project) {
                // Use optional() to handle cases where the relationship might not exist
                $user = User::find($project->n_spoc)->name ?? "NA";
                $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
                // Use ternary operator for status
                $stat = $project->status == 1 ? "Active" : "Inactive";
                $temp = [
                    'id' => $project->id ?? "NA",
                    'name' => $project->p_name,
                    'fyear' => $project->f_year,
                    'p_target' => $project->p_target,
                    'details' => $project->p_details,
                    'head' => $user,
                    'vertical' => $vertical,
                    'status' => $stat
                ];
                $data[] = $temp;
            }
            $teams = Team::where('added_by', Auth::user()->id)->get();
            return view('vertical.index', compact('data', 'monthYear', 'teams', 'authdata'));
        }

        // dd($data);
        return view('vertical.index');
    }


    public function getProject(int $id)
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $project = Project::find($id);
        $name = $project->p_name;
        $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
        $head = User::where('id', $project->n_spoc)->get()->first()->name ?? "NA";
        $details = $project->p_details;
        $status = $project->status == 1 ? "Active" : "Inactive";
        $vendors = Vassociation::where('p_id', $project->id)->get();
        // ddd($vendors);  
        $vendorData = [];
        foreach ($vendors as $vendor) {
            $temp = [
                'id' => $vendor->v_id,
                'name' => Vendor::where('id', $vendor->v_id)->get()->first()->name ?? "NA",
                'state' => $vendor->state,
                'district' => $vendor->district,
                'start_date' => $vendor->start_date,
                'end_date' => $vendor->end_date ?? "NA",
                'status' => $vendor->status == 1 ? "Active" : "Inactive"
            ];
            $vendorData[] = $temp;
        }
        $teams = Team::where('pro_id', $id)->get();
        $media = Media::where('project_id', $id)->get();
        $mediaData = [];
        foreach ($media as $m) {
            try {
                //code...
                $vass = Vassociation::where('id', $m->vass_id)->get()->first();
                if ($vass->v_id == 0) {
                    $state = "NA";
                    $district = "NA";
                    $vendor = "NA";
                } else {
                    $state = $vass->state ?? "NA";
                    $district = $vass->district ?? "NA";
                    $vendor = Vendor::where('id', $vass->v_id)->get()->first()->name ?? "NA";
                }
                $type = Document_type::where('id', $m->type)->get()->first()->name ?? "NA";
                $temp = [
                    'id' => $m->id,
                    'name' => $m->name,
                    'original_name' => $m->original_name ?? "NA",
                    'type' => $type,
                    'vendor' => $vendor,
                    'state' => $state,
                    'district' => $district,
                    'upload_date' => $m->created_at ?? "NA",
                ];
                $mediaData[] = $temp;
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $data = [
            'u_name' => Auth::user()->name,
            'u_role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'id' => $project->id,
            'name' => $name,
            'details' => $details,
            'head' => $head,
            'vertical' => $vertical,
            'status' => $status,
            'vendors' => $vendorData,
            'teams' => $teams,
            'media' => $mediaData,
        ];
        return view('vertical.getProject', compact('data', 'authdata'));
    }

    public function report(int $id)
    {

        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $project = Project::find($id);
        $name = $project->p_name;
        $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
        $head = User::where('id', $project->n_spoc)->get()->first()->name ?? "NA";
        $head_id = User::where('id', $project->n_spoc)->get()->first()->id ?? "NA";
        $details = $project->p_details;
        $status = $project->status == 1 ? "Active" : "Inactive";
        $vendors = Vassociation::where('p_id', $project->id)->get();

        $media = Media::where('project_id', $id)->orderBy('created_at', 'desc')->get();
        $mediadata = [];

        foreach ($media as $m) {
            $temp = [
                'name' => $m->name,
                'original_name' => $m->original_name,
                'created_at' => $m->created_at, // Fixed the typo here
                'user_name' => User::where('id', $m->added_by)->first()->name ?? "NA" // Use first() instead of get()
            ];
            $mediadata[] = $temp; // Push $temp to $mediadata
        }
        ;


        $data = [
            'u_name' => Auth::user()->name,
            'u_role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'id' => $project->id,
            'name' => $name,
            'details' => $details,
            'head' => $head,
            'vertical' => $vertical,
            'status' => $status,
            'media' => $mediadata


        ];


        return view('vertical.report', compact('data', 'authdata'));
    }

    public function getVendor(int $id)
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $vendor = Vendor::find($id);
        $name = $vendor->name;
        $state = $vendor->state;
        $district = $vendor->district;
        $address = $vendor->address;
        $email = $vendor->email;
        $mobile = $vendor->mobile;
        $status = $vendor->status == 1 ? "Active" : "Inactive";
        $projects = Vassociation::where('v_id', $vendor->id)->get();
        $projectData = [];
        foreach ($projects as $project) {
            $temp = [
                'id' => $project->id,
                'name' => Project::where('id', $project->p_id)->get()->first()->p_name ?? "NA",
                'state' => $project->state,
                'district' => $project->district,
                'start_date' => $project->start_date,
                'end_date' => $project->end_date ?? "NA",
                'status' => $project->status == 1 ? "Ongoing" : "Completed",
            ];
            $projectData[] = $temp;
        }
        $data = [
            'id' => $vendor->id,
            'name' => $name,
            'state' => $state,
            'district' => $district,
            'address' => $address,
            'email' => $email,
            'mobile' => $mobile,
            'status' => $status,
            'projects' => $projectData,
        ];
        // dd($data);
        return view('vertical.getVendor', compact('data', 'authdata'));
    }

    public function show(User $user, $id)
    {
        $user = User::find($id);
        return view('vertical.view', compact('user'));
    }

    public function createP(User $user)
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $allowedVerticals = ['1', '2', '3', '4', '5'];
        // Check if the user's vertical is in the allowed verticals
        if (in_array(auth()->user()->vertical, $allowedVerticals)) {
            $users = User::whereIn('role', [4, 5])->get();
            return view('vertical.addProject', compact('users', 'authdata'));
        } elseif (in_array(auth()->user()->vertical, $allowedVerticals)) {
            $users = User::whereIn('role', [4, 5])->get();
            return view('vertical.addProject', compact('users', 'authdata'));
        } elseif (in_array(auth()->user()->vertical, $allowedVerticals)) {
            $users = User::whereIn('role', [4, 5])->get();
            return view('vertical.addProject', compact('users', 'authdata'));
        }
        return view('vertical.addProject', compact('authdata'));
    }

    public function storeP(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'p_name' => 'required',
            'p_target' => 'required',
            'f_year' => 'required',
            'p_details' => 'required',
            'n_spoc' => 'required',
            'vertical_id' => 'required'
        ]);

        // Retrieve the authenticated user's ID and vertical
        $userid = $request->user()->id;
        $ver_id = $request->user()->vertical;

        // Create a new project record
        $data = Project::create([
            'p_name' => $request->p_name,
            'p_target' => $request->p_target,
            'f_year' => $request->f_year,
            'p_details' => $request->p_details,
            'added_by' => $userid,
            'vertical_id' => $ver_id,
        ]);

        $p_id = $data->id;

        // Process and associate SPoCs
        $spocs = explode(',', $request->n_spoc);
        foreach ($spocs as $spoc) {
            if (!empty(trim($spoc))) {  // Ensure that $spoc is not empty
                Passociation::create([
                    'p_id' => $p_id,
                    'u_id' => trim($spoc),  // Trim whitespace from the SPoC ID
                    'added_by' => $userid,
                    'role' => 4
                ]);
            }
        }

        // Redirect with a success message
        return redirect()->route('vertical.index')->with('success', 'Project added successfully!');
    }


    public function createT()
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;

        // Get all projects added by the authenticated user
        $projects = Project::where('added_by', Auth::user()->id)->get();

        // Get all teams added by the authenticated user
        $teams = Team::where('added_by', Auth::user()->id)->get();

        // Prepare team data for the view
        $teamData = [];
        foreach ($teams as $team) {
            $project = Project::where('id', $team->pro_id)->first();
            $teamData[] = [
                'id' => $team->id,
                'tname' => $team->name,
                'pro_id' => $team->pro_id,
                'project_name' => $project->p_name ?? 'N/A',
                'description' => $team->description,
            ];
        }

        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];

        // Get users with specific roles
        $users = User::whereIn('role', [4, 5])->get();

        // Return view with prepared data
        return view('vertical.addTeam', compact('users', 'teamData', 'projects', 'authdata'));
    }


    public function storeT(Request $request)
    {
        try {
            $userid = $request->user()->id;

            $request->validate([
                'name' => 'required',
                'pro_id' => 'required',
                'description' => 'required',
            ]);

            Team::create([
                'name' => $request->name,
                'pro_id' => $request->pro_id,
                'description' => $request->description,
                'added_by' => $userid
            ]);

            return redirect()->route('vertical.add-team')->with('success', 'Team added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error adding team: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the team. Please try again later.']);
        }
    }
    public function editTeam(Request $request)
    {
        try {
            $team = Team::find($request->id);

            if (!$team) {
                // Handle the case where the team was not found
                return redirect()->back()->with('error', 'Team not found!');
            }

            $team->name = $request->name; // Ensure field names match
            $team->description = $request->description;
            $team->pro_id = $request->pro_id; // Assuming you want to update this as well
            $team->save();

            return redirect()->back()->with('success', 'Team updated successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function deleteteam($id)
    {
        try {
            $team = Team::find($id);

            if (!$team) {
                return redirect()->back()->with('error', 'Team not found!');
            }

            $team->delete();

            return redirect()->back()->with('success', 'Team deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the team.');
        }
    }

    public function createM()
    {
        $auth = Auth::user();
        $authRoleId = $auth->role;
        $authName = $auth->name;

        // Fetch the role name using a single query
        $role = Role::where('id', $authRoleId)->pluck('name')->first() ?? "NA";

        $authdata = [
            'name' => $authName,
            'role' => $role
        ];

        // Fetch users with roles 4 or 5
        $users = User::whereIn('role', [4, 5])->get();

        // Fetch teams and members added by the authenticated user
        $teams = Team::where('added_by', $auth->id)->get();
        $members = Member::where('added_by', $auth->id)->get();

        $memberdata = [];
        foreach ($members as $member) {
            $team = Team::find($member->t_id); // Single query for team
            $user = User::find($member->user_id); // Single query for user

            $temp = [
                'id' => $member->id,
                'team_name' => $team ? $team->name : "NA", // Use team name directly
                'user_name' => $user ? $user->name : "NA", // Use user name directly
                'role' => $member->role,
                'added_by' => $member->added_by
            ];
            $memberdata[] = $temp;
        }

        return view('vertical.addMember', compact('users', 'teams', 'authdata', 'memberdata'));
    }


    public function storeM(Request $request)
    {
        $userid = $request->user()->id;
        $roleid = $request->user()->role;

        // Validate the request
        $request->validate([
            't_id' => 'required',
            'user_id' => 'required',
        ]);

        // Create the member
        Member::create([
            't_id' => $request->t_id,
            'user_id' => $request->user_id,
            'role' => $roleid,
            'added_by' => $userid
        ]);

        // Redirect with success message
        return redirect()->route('vertical.addMember')->with('success', 'Member added successfully!');
    }

    public function editMember(Request $request)
    {
        //json data print.




        $member = Member::find($request->id);

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found!');
        }

        $member->t_id = $request->t_id;
        $member->user_id = $request->user_id;
        $member->save();

        return redirect()->back()->with('success', 'Member updated successfully!');
    }

    //delete member
    public function deleteMember($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found!');
        }

        $member->delete();

        return redirect()->back()->with('success', 'Member deleted successfully!');
    }



    public function internalReports()
    {
        $userId = Auth::user()->id;
        $projects = Project::where('vertical_id', 1)->get()->unique('id');

        $mediaData = [];
        foreach ($projects as $project) {
            $p_id = $project->id;
            $medias = Media::where('project_id', $p_id)->whereIn('type', [1, 5])->orderByDesc('created_at')->get();

            foreach ($medias as $media) {
                $vassData = Vassociation::where('id', $media->vass_id)->first();

                if ($vassData) {
                    $vid = $vassData->id;
                    $vendorName = Vendor::find($vid)->name ?? "NA";
                    $state = $vassData->state ?? "NA";
                    $district = $vassData->district ?? "NA";
                } else {
                    $vendorName = 'Internal Report';
                    $state = 'Internal';
                    $district = 'Internal';
                }

                // Format the upload date
                $uploadDate = date('M j, Y', strtotime($media->created_at));
                // Format the created date
                $createdDate = date('M j, Y', strtotime($media->created_at));

                $temp = [
                    'mediaName' => $media->original_name,
                    'vendorName' => $vendorName,
                    'projectName' => $project->p_name,
                    'f_year' => $project->f_year,
                    'stateName' => $state,
                    'districtName' => $district,
                    'uploadDate' => $uploadDate, // Store formatted upload date
                    'createdDate' => $createdDate, // Store formatted created date
                    'view' => $media->name,
                ];
                $mediaData[] = $temp;
            }
        }

        // Sort the mediaData array by uploadDate in descending order
        usort($mediaData, function ($a, $b) {
            return strtotime($b['uploadDate']) <=> strtotime($a['uploadDate']);
        });

        $data = [
            'name' => 'Internal/Project Reports',
            'media' => $mediaData,
        ];

        $authRoleId = Auth::user()->role;
        $authUser = Auth::user();
        $authRole = Role::find($authRoleId)->name ?? "NA";
        $authdata = [
            'name' => $authUser->name,
            'role' => $authRole
        ];

        return view('vertical.internal-reports', compact('data', 'authdata'));
    }

    public function vendorReports()
    {
        $userId = Auth::user()->id;
        $projects = Project::where('n_spoc', $userId)->get()->unique('id');
        $mediaData = [];
        foreach ($projects as $project) {
            $p_id = $project->id;
            $medias = Media::where('project_id', $p_id)->where('type', 6)->get();
            $data = [];
            foreach ($medias as $media) {
                $vassData = Vassociation::where('id', $media->vass_id)->get()->first();
                $vid = $vassData->v_id ?? 0;
                if ($vid != 0) {
                    $vendorName = Vendor::where('id', $vid)->get()->first()->name ?? "NA";
                } else {
                    $vendorName = "NA";
                }
                $mediaName = $media->original_name;
                $projectName = $project->p_name;
                $stateName = $vassData->state ?? "NA";
                $districtName = $vassData->district ?? "NA";
                $uploadDate = date('M j, Y ', strtotime($media->created_at));
                $view = $media->name;
                $temp = [
                    'mediaName' => $media->original_name,
                    'vendorName' => $vendorName,
                    'projectName' => $projectName,
                    'stateName' => $stateName,
                    'districtName' => $districtName,
                    'uploadDate' => $uploadDate,
                    'view' => $view,
                ];
                $mediaData[] = $temp;
            }
        }
        $data = [
            'name' => 'Vendor Reports',
            'media' => $mediaData,
        ];
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        return view('vertical.internal-reports', compact('data', 'authdata'));
    }
    public function updateproject(Request $request)
    {
        // Retrieve the form data
        $data = $request->input();
        $project = Project::find($data['id']);
        $project->p_name = $data['p_name'];
        $project->f_year = $data['f_year'];

        $project->save();
        // Return the data as a JSON response for debugging purposes
        return redirect('vertical')->with('success', "Update project successfully! ; {$project->p_name}");


    }

    public function changePass()
    {
        //$user  = User::find($id);
        $users = User::first();
        return view('vertical.changePassword', compact('users'));
    }

    public function UpdatePass(Request $request)
    {
        $data = $request->input();
        $request->validate([
            'password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        if (Auth::attempt(['email' => auth()->user()->email, 'password' => $data['password']])) {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        } else {
            return Redirect::back()->withErrors(['Alert-', 'Current password is wrong']);
        }
        //dd('Password change successfully.');
        return redirect('vertical/list')->with('success', 'Password change successfully!');
    }

    public function edit(User $user, $id)
    {
        $user = User::find($id);
        return view('vertical.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->project = $request->get('project');
        $user->email = $request->get('email');
        $user->save();
        return redirect('vertical.index')->with('success', 'Data updated!');
    }

    public function destroy($id)
    {
        $bcuser = User::find($id);
        $bcuser->delete();
        return redirect('vertical.index')->with('success', 'Contact deleted!');
    }
    public function profile()
    {
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password

        ];


        return view('vertical.profile', compact('data'));
    }
    public function updateProfile(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fullName' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'required|email|unique:users,email,' . Auth::id(), // Unique except for current user
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional image validation
            ]);
            $userId = Auth::id();
            $user = User::findOrFail($userId);
            $user->name = $validatedData['fullName'];
            $user->mobile = $validatedData['phone'];
            $user->email = $validatedData['email'];
            if ($request->hasFile('profile_pic')) {
                $imageName = $userId . '_' . $user->name . '_' . date('Ymd_His') . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(storage_path('app/profile_pic'), $imageName);
                $user->profile_pic = $imageName;
            }
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Profile update failed. Please try again.');
        }
    }
}