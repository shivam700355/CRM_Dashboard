<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Models\Vassociation;
use App\Models\Passociation;
use App\Models\Document_type;
use App\Models\Activitylog;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Vertical;
use App\Models\Project;
use App\Models\Holiday;
use App\Models\Vendor;
use App\Models\Member;
use App\Models\Status;
use App\Models\Team;
use App\Models\Role;
use App\Models\Media;
use App\Models\User;
use App\Models\Dashboard;
use App\Models\Gst;
use App\Models\Epf;
use Carbon\Carbon;
use App\Models\Income;
use App\Models\Bank;
use App\Models\Advance;
use App\Models\Payment;



use Attendances;
use Departments;
use Activitylogs;
use Holidays;
use Users;
use Auth;
use DB;

class DirectorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $timestamp = time();
        // Calculate timestamp for the first day of the previous month
        $prevMonthTimestamp = strtotime('-1 month', $timestamp);
        $labels = [1, 2, 5, 3,];

        $chartData = [];
        foreach ($labels as $label) {
            $chartData[] = Project::where('vertical_id', $label)->count() ?? 0;
        }

        $dasboard = Dashboard::all();
        $ds_data = [];

        foreach ($dasboard as $d) {
            if ($d->geo_re) {
                $geo_msg = $d['geo_re'] . "% receivals.";
                if ($d->geo_re == '100') {
                    $geo_class = "completed";
                } else {
                    $geo_class = "not-completed";
                }
            } else {
                $geo_msg = "Not targeted.";
                $geo_class = "not-targeted";
            }

            if ($d->odop_sls) {
                $odop_msg = $d->odop_sls;
                if ($d->odop_sls == 'Receieved') {
                    $odop_class = "received";
                } else {
                    $odop_class = "not-received";
                }
            } else {
                $odop_msg = "Not targeted.";
                $odop_class = "not-targeted";
            }

            if ($d->obc) {
                $obc_msg = $d->obc;
                $obc_class = "not-completed";
            } else {
                $obc_msg = "Not targeted.";
                $obc_class = "not-targeted";
            }

            $ds_data[$d->district] = [
                "ms_b_trained" => $d->ms_b_trained,
                "ms_s_letter" => $d->ms_s_letter,
                "class" => $d->ms_s_letter == "Received" ? "received" : "not-received",
                "geo_re" => $d->geo_re,
                "svg" => $d->svg,
                "geo_class" => $geo_class,
                "geo_msg" => $geo_msg,
                "odop_class" => $odop_class,
                "odop_msg" => $odop_msg,
                "obc_msg" => $obc_msg,
                "obc_class" => $obc_class,
            ];
        }
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $Gst = Gst::where('added_by', Auth::user()->id)->where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();
        $Epf = Epf::where('added_by', Auth::user()->id)->where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();
        $Income = Income::where('added_by', Auth::user()->id)->where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();

        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'Gst' => $Gst,
            'Epf' => $Epf,
            'Income' => $Income,
            'verticals' => [
                ['id' => 1, 'name' => 'Training'],
                ['id' => 2, 'name' => 'Consultancy'],
                ['id' => 3, 'name' => 'Finance'],
                ['id' => 4, 'name' => 'Retail'],
                ['id' => 5, 'name' => 'Human Resource'],
            ],
            'count' => [
                'Training' => Project::where('vertical_id', 1)->count(),
                'Consultancy' => Project::where('vertical_id', 2)->count(),
                'Retail' => Project::where('vertical_id', 4)->count(),
                'Finance' => Project::where('vertical_id', 3)->count(),
                'Human Resource' => Project::where('vertical_id', 5)->count(),
            ],
            'projects' => Project::where('vertical_id', 1)->get(),
            'date' => date('F Y', $prevMonthTimestamp),
            'chartData' => $chartData,
            'ms_data' => $ds_data,
        ];
        $projectassocationdata = []; // Initialize an empty array
        $passocation = Passociation::all(); // Get all associations



        foreach ($passocation as $p) {
            // Get the state and project name values
            $state = Vassociation::where('p_id', $p->p_id)->value('state');
            $projectName = Project::where('id', $p->p_id)->value('p_name');

            // Only add the data if both state and project name are not null
            if ($state !== null && $projectName !== null) {
                $projectassocationdata[] = [
                    'project_Name' => $projectName,
                    'p_target' => Project::where('id', $p->p_id)->value('p_target'),
                    'p_complete' => Project::where('id', $p->p_id)->value('p_status'),
                    'state' => $state,
                    'district' => Vassociation::where('p_id', $p->p_id)->value('district'),
                    'status' => Project::where('id', $p->p_id)->value('status'),
                ];
            }
        }






        return view('director.welcome3', compact('data', 'projectassocationdata'));
    }

    public function show(User $user, $id)
    {
        $user = User::find($id);
        return view('director.view', compact('user'));
    }

    public function changePass()
    {
        $users = User::first();
        return view('director.changePassword', compact('users'));
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
        return redirect('director/list')->with('success', 'Password change successfully!');
    }

    public function destroy($id)
    {
        $bcuser = User::find($id);
        $bcuser->delete();
        return redirect('/director/list')->with('success', 'Contact deleted!');
    }

    public function projects()
    {
        // Fetch projects with status equal to 1 directly in the query
        $projects = Project::where('status', 1)->get();
        $projectData = [];

        foreach ($projects as $project) {
            // Use optional() to handle cases where the relationship might not exist
            $user = User::find($project->n_spoc)->name ?? "NA";
            $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
            // Use ternary operator for status
            $stat = $project->status == 1 ? "Active" : "Inactive";
            $temp = [
                'id' => $project->id ?? "NA",
                'name' => $project->p_name,
                'details' => $project->p_details,
                'head' => $user,
                'f_year' => $project->f_year ?? "NA",
                'vertical' => $vertical,
                'status' => Status::find($project->status)->name ?? "NA",
                'report' => Media::where('project_id', $project->id)->orderBy('created_at', 'desc')->first()->name ?? "NA"

            ];
            $projectData[] = $temp;
        }
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'projects' => $projectData,
        ];
        return view('director.projects1', compact('data'));
    }

    public function getProject(int $id)
    {
        $project = Project::find($id);
        $name = $project->p_name;
        $f_year = $project->f_year;
        $p_target = $project->p_target;
        $p_status = $project->p_status;
        $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
        $head = User::where('id', $project->n_spoc)->get()->first()->name ?? "NA";
        $details = $project->p_details;
        $status = $project->status == 1 ? "Active" : "Inactive";
        $vendors = Vassociation::where('p_id', $project->id)->get();
        $report = $project->report ?? "NA";
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
        $media = Media::where('project_id', $id)->orderBy('created_at', 'desc')->get();

        $mediaData = [];
        foreach ($media as $m) {
            try {
                $vass = Vassociation::find($m->vass_id);
                if (!$vass || $vass->v_id == 0) {
                    $state = "NA";
                    $district = "NA";
                    $vendor = "NA";
                } else {
                    $state = $vass->state ?? "NA";
                    $district = $vass->district ?? "NA";
                    $vendor = Vendor::find($vass->v_id)->name ?? "NA";
                }
                $type = Document_type::find($m->type)->name ?? "NA";

                $temp = [
                    'id' => $m->id,
                    'name' => $m->name,
                    'original_name' => $m->original_name ?? "NA",
                    'type' => $type,
                    'vendor' => $vendor,
                    'state' => $state,
                    'district' => $district,
                    'upload_date' => $m->created_at ? $m->created_at->format('Y-m-d H:i:s') : "NA",
                ];
                $mediaData[] = $temp;
            } catch (\Throwable $th) {
                // Log or handle the exception as needed
            }
        }

        $data = [
            'u_name' => Auth::user()->name,
            'u_role' => Role::find(Auth::user()->role)->name ?? "NA",
            'id' => $project->id,
            'name' => $name,
            'report' => Media::where('project_id', $project->id)->orderBy('created_at', 'desc')->first()->name ?? "NA",
            'details' => $details,
            'head' => $head,
            'vertical' => $vertical,
            'status' => $status,
            'vendors' => $vendorData,
            'teams' => $teams,
            'media' => $mediaData,
            'f_year' => $f_year,
            'p_target' => $p_target,
            'p_status' => $p_status,

        ];
        return view('director.getProject2', compact('data', 'media'));
    }

    public function vendors()
    {
        $vendors = Vendor::where('status', 1)->get();
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'vendors' => $vendors,
        ];
        return view('director.vendors1', compact('data'));
    }

    public function getVendor(int $id)
    {
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
            'u_name' => Auth::user()->name,
            'u_role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
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
        return view('director.getVendor1', compact('data'));
    }

    public function getVertical(int $id)
    {
        $vertical = Vertical::find($id);
        $name = $vertical->name;
        $head = User::where('id', $vertical->head_id)->get()->first()->name ?? "NA";
        // Fetch projects with status equal to 1 directly in the query
        $projects = Project::where('vertical_id', $id)->get();
        $projectsData = [];
        foreach ($projects as $project) {
            $user = User::find($project->n_spoc)->name ?? "NA";
            $stat = $project->status == 1 ? "Active" : "Inactive";
            $temp = [
                'id' => $project->id ?? "NA",
                'name' => $project->p_name,
                'details' => $project->p_details,
                'target' => $project->p_target,
                'complete' => $project->p_status,
                'f_year' => $project->f_year ?? "NA",
                'head' => $user,
                'status' => $stat,
                'report' => $project->report ?? "NA",
            ];
            $projectsData[] = $temp;
        }
        $data = [
            'u_name' => Auth::user()->name,
            'u_role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'id' => $id,
            'name' => $name,
            'head' => $head,
            'projects' => $projectsData,
        ];
        return view('director.getVertical1', compact('data'));
    }

    public function users()
    {
        $users = User::whereIn('role', [3, 4, 5])->where('status', 1)->get();
        $userData = [];
        foreach ($users as $user) {
            $temp = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                //Role::find($user->role)->name ?? "NA"
                'role' => Role::find($user->role)->name ?? "NA",
                'vertical' => Vertical::find($user->vertical)->name ?? "NA",
                'status' => $user->status == 1 ? "Active" : "Inactive",
            ];
            $userData[] = $temp;
        }
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'users' => $userData,
        ];
        return view('director.users1', compact('data'));
    }

    public function forms()
    {
        return view('director.forms');
    }

    public function getTeam($id)
    {
        $team = Team::find($id);
        $name = $team->name;
        $project = Project::find($team->pro_id)->get()->first()->p_name ?? "NA";
        $members = Member::where('team_id', $team->id)->get();
        $memberData = [];
        foreach ($members as $member) {
            $u_id = $member->user_id;
            $temp = [
                'name' => User::find('id', $u_id)->get()->first()->name ?? "NA",
                'role' => Role::find($member->role)->name ?? "NA",
            ];
            $memberData[] = $temp;
        }
        $data = [
            'id' => $team->id,
            'u_name' => Auth::user()->name,
            'u_role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'name' => $name,
            'project' => $project,
            'members' => $memberData,
        ];
        return view('director.getTeam', compact('data'));
    }


    public function finance(Request $request)
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $key = $request->query('key');
        // Get filters from request or use current values
        $incomeyearFilter = $request->input('incomeyearFilter', $currentYear); // Correctly use current year as default
        $incomemonthFilter = $request->input('incomemonthFilter', $currentMonth); // Correctly use current month as default

        $gstyearFilter = $request->input('gstyearFilter', $currentYear); // Correctly use current year as default
        $gstmonthFilter = $request->input('gstmonthFilter', $currentMonth); // Correctly use current month as default

        $epfesiyearFilter = $request->input('epfesiyearFilter', $currentYear); // Correctly use current year as default
        $epfesimonthFilter = $request->input('epfesimonthFilter', $currentMonth); // Correctly use current month as default

        // Retrieve data based on filters
        $Gst = Gst::where('status', 1)->whereMonth('created_at', $gstmonthFilter)->whereYear('created_at', $gstyearFilter)->orderBy('created_at', 'desc')->get();
        $Epf = Epf::where('status', 1)->whereMonth('created_at', $epfesimonthFilter)->whereYear('created_at', $epfesiyearFilter)->orderBy('created_at', 'desc')->get();
        // $Epf = Epf::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();
        $Income = Income::where('status', 1)->whereMonth('created_at', $incomemonthFilter)->whereYear('created_at', $incomeyearFilter)->orderBy('created_at', 'desc')->get();
        $bank = Bank::where('status', 1)->orderBy('created_at', 'desc')->get();

        $Advances = Advance::where('status', 1)->orderBy('created_at', 'desc')->get();
        $Payments = Payment::where('status', 1)->orderBy('created_at', 'desc')->get();

        $key = $request->query('key');
        $incomeyearFilter = $request->query('incomeyearFilter');
        $incomemonthFilter = $request->query('incomemonthFilter');
        $gstyearFilter = $request->query('gstyearFilter');
        $gstmonthFilter = $request->query('gstmonthFilter');
        $epfesiyearFilter = $request->query('epfesiyearFilter');
        $epfesimonthFilter = $request->query('epfesimonthFilter');
        // Prepare data for the view
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'incomeyearFilter' => $incomeyearFilter,
            'incomemonthFilter' => $incomemonthFilter,
            'gstyearFilter' => $gstyearFilter,
            'gstmonthFilter' => $gstmonthFilter,
            'epfesiyearFilter' => $epfesiyearFilter,
            'epfesimonthFilter' => $epfesimonthFilter,
            'Gst' => $Gst,
            'Epf' => $Epf,
            'Income' => $Income,
            'Bank' => $bank,
            'Advances' => $Advances,
            'Payments' => $Payments,
            'key' => $key,



        ];

        // Return the view with the data
        return view('director.finance', compact('data'));
    }

    public function financedata(Request $request)
    {
        $key = $request->query('key'); // Retrieve the query parameter 'key'

        $Gst = Gst::where('status', 1)->orderBy('created_at', 'desc')->get();
        $Epf = Epf::where('status', 1)->orderBy('created_at', 'desc')->get();
        $Income = Income::where('status', 1)->orderBy('created_at', 'desc')->get();
        $bank = Bank::where('status', 1)->orderBy('created_at', 'desc')->get();

        $Advances = Advance::where('status', 1)->orderBy('created_at', 'desc')->get();
        $Payments = Payment::where('status', 1)->orderBy('created_at', 'desc')->get();



        // Prepare data for the view
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'incomeyearFilter' => $yearFilter ?? "NA",
            'incomemonthFilter' => $monthFilter ?? "NA",
            'Gst' => $Gst,
            'Epf' => $Epf,
            'Income' => $Income,
            'key' => $key,
            'Bank' => $bank,
            'Advances' => $Advances,
            'Payments' => $Payments

        ];

        return view('director.financedata', compact('data'));
    }


    public function profile()
    {
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'profile_pic' => Auth::user()->profile_pic,
            'mobile' => Auth::user()->mobile,
            'password' => Auth::user()->password

        ];


        return view('director.profile', compact('data'));
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