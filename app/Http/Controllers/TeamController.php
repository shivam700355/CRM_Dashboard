<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Carbon\Carbon;
use App\Models\Document_type;
use App\Models\Vassociation;
use App\Models\Member;
use App\Models\Media;
use App\Models\Project;
use App\Models\Vertical;
use App\Models\Team;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Role;
use Document_types;
use Verticals;
use Projects;
use Medias;
use Teams;
use Users;
use Roles;
use DB;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $doc_types = Document_type::all();
        $data = [
            'name' => $authName,
            'role' => $role
        ];
        $authId = Auth::user()->id;
        $media = Media::where('added_by', $authId)->get();
        $mediaIds = [];

        foreach ($media as $medias) {
            $mediaIds[] = [
                'id' => $medias->id,
                'original_name' => $medias->original_name,
                'name' => $medias->name,
                'project_name' => Project::where('id', $medias->project_id)->value('p_name'),
                'project_id' => $medias->project_id,
                'remark' => $medias->remark,
                'created_at' => $medias->created_at,
                'updated_at' => $medias->updated_at,
            ];
        }

        // Order $mediaIds by 'created_at' in descending order
        usort($mediaIds, function ($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });

        $projects = Project::where('vertical_id', 1)
            ->whereRaw("FIND_IN_SET(?, allot_uid)", [$authId])
            ->get();


        return view('team.index', compact('projects', 'role', 'data', 'mediaIds', 'authId'));
    }


    public function create()
    {
        return view('team.create');
    }

    public function createUpload(Request $request)
    {
        $projects = Project::where('vertical_id', '=', 1)->get();
        $authId = Auth::user()->id;
        $doc_types = Document_type::all();
        $authName = Auth::user()->name;
        $role = Role::where('id', Auth::user()->id)->first()->name ?? "NA";

        $data = [
            'name' => $authName,
            'role' => $role
        ];
        return view('team.upload', compact('projects', 'doc_types', 'authId', 'data'));
    }
    public function storeUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'type' => 'required',
            'remark' => 'nullable|string',
            'image_files' => 'required|array', // Make sure it's an array
            'image_files.*' => 'max:2048|file', // Validate each file
        ]);

        if ($validator->fails()) {
            return redirect()->route('team.saveUpload')->withErrors($validator)->withInput();
        }
        $addedBy = $request->input('added_by');
        $filetype = $request->input('type');
        $remark = $request->input('remark');
        $projectId = $request->input('project_id');
        $vendorId = $projectId == 1 ? 0 : $request->input('vass_id');
        $baseFolderPath = "document/";
        $folderPath = $baseFolderPath;
        foreach ($request->file('image_files') as $file) {
            $originalFilename = $file->getClientOriginalName();
            $filename = hash('md5', time() . $originalFilename) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($folderPath, $filename);

            // Store the file details in the database
            Media::create([
                'added_by' => $addedBy,
                'vass_id' => $vendorId,
                'type' => $filetype,
                'name' => $filename,
                'original_name' => $originalFilename,
                'remark' => $remark,
                'project_id' => $projectId,
            ]);
        }

        return redirect()->route('team.index')->with(['success' => 'Files uploaded successfully.']);
    }

    public function getProject(int $id)
    {
        $authName = Auth::user()->name;
        $role = Role::where('id', Auth::user()->id)->first()->name ?? "NA";

        $data = [
            'name' => $authName,
            'role' => $role
        ];
        $mediaData = [];
        $media = Media::where('project_id', $id)->orderBy('created_at', 'desc')->get(); // Fetch media related to the specified project ID and order by created_at
        foreach ($media as $m) {
            $mediaData[] = [
                'id' => $m->id,
                'original_name' => $m->original_name,
                'name' => $m->name,
                'created_at' => date('M j, Y g:i A', strtotime($m->created_at)) // Format date and time
            ];
        }

        return view('team.getProject', compact('mediaData', 'data'));
    }

    public function storefsdfsaf(Request $request)
    {
        $userid = $request->user()->id;
        $deptid = $request->user()->dept_id;
        $uname = $request->user()->name;

        $save = new Attendance;
        $save->u_id = $userid;
        $save->dept_id = $deptid;
        $save->u_name = $uname;
        $save->checkin_date = $request->checkin_date;
        $save->checkin_time = $request->checkin_time;
        $save->checkout_time = $request->checkout_time;
        $save->status = '1';
        $save->save();
        return view('team.create')->with(['success' => 'Thank you for Add user.']);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        return redirect()->back()->with('error', 'You have already checked out for today.');
    }

    public function show(User $user, $id)
    {
        $user = User::find($id);

        return view('team.view', compact('user'));
    }

    public function changePass()
    {
        $users = User::first();
        return view('team.changePassword', compact('users'));
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
        return redirect('team')->with('success', 'Password change successfully!');
    }

    public function edit(User $user, $id)
    {
        $user = User::find($id);
        return view('team.edit', compact('user'));
    }


    public function internalReports()
    {

        $userId = Auth::user()->id;

        $medias = Media::where('added_by', $userId)
            ->whereIn('type', [1, 5])
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->get();

        $mediaData = [];

        foreach ($medias as $me) {
            $project = Project::find($me->project_id);
            $temp = [
                'id' => $me->id,
                'project_name' => $project ? $project->p_name : 'N/A',
                'f_year' => $project ? $project->f_year : 'N/A',
                'original_name' => $me->original_name,
                'name' => $me->name,
                'created_at' => $me->created_at,
            ];

            $mediaData[] = $temp;
        }

        $data = [
            'name' => 'Internal/Project Reports',
            'media' => $mediaData,
        ];

        $authUser = Auth::user();
        $authRole = Role::find($authUser->role)->name ?? "NA"; // Check if role exists, otherwise use "NA"

        $authdata = [
            'name' => $authUser->name,
            'role' => $authRole,
        ];

        return view('team.internalreports', compact('data', 'authdata'));
    }

    public function updatedpstatus(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'pid' => 'required',
            'p_status' => 'required',
        ]);

        // Retrieve the project by its ID
        $project = Project::find($request->pid);

        if ($project) {
            // Update the project status
            $project->p_status = $request->p_status;

            // Save the changes to the database
            $project->save();

            // Flash success message to the session
            return redirect()->back()->with('success', 'Project status updated successfully.');
        } else {
            // Flash error message to the session
            return redirect()->back()->with('error', 'Project not found.');
        }
    }


    public function deletereport(int $id)
    {
        try {
            $media = Media::findOrFail($id); // This will throw an exception if not found

            // Check if the current status is not already 0
            if ($media->status !== 0) {
                $media->status = 0; // Set status to 0
                $media->save();

                return redirect()->back()->with('success', 'Report deleted successfully');
            } else {
                return redirect()->back()->with('info', 'Report is already deleted.');
            }
        } catch (\Exception $e) {
            // Log the exception if necessary
            // Log::error($e);

            return redirect()->back()->with('error', 'Failed to delete report: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->mobile = $request->get('mobile');
        $user->email = $request->get('email');
        $user->save();
        return redirect('team.index')->with('success', 'Data updated!');
    }

    public function destroy($id)
    {
        $bcuser = User::find($id);
        $bcuser->delete();
        return redirect('team.index')->with('success', 'Contact deleted!');
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


        return view('team.profile', compact('data'));
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
