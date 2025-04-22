<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Validator, Redirect, Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Models\Vassociation;
use App\Models\Passociation;
use App\Models\Document_type;
use App\Models\Vendoruser;
use App\Models\Application;
use App\Models\Attendance;
use App\Models\Project;
use App\Models\Vertical;
use App\Models\Vendor;
use App\Models\Member;
use App\Models\Status;
use App\Models\Media;
use App\Models\Team;
use App\Models\User;
use App\Models\Role;
use Document_types;
use Attendances;
use Vendorusers;
use Verticals;
use Members;
use Projects;
use Medias;
use Users;
use Teams;
use Roles;
use Auth;
use DB;

class SpocController extends Controller
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
        $userId = Auth::user()->id;
        $projects = Passociation::where('u_id', $userId)->get();
        $projectData = [];
        foreach ($projects as $prj) {
            $p_id = $prj->p_id;
            // projects table se data
            $project = Project::where('id', $p_id)->get()->first();
            $vertical = Vertical::where('id', $project->vertical_id)->get()->first()->name ?? "NA";
            $vendors = Vassociation::where('p_id', $p_id)->get();
            $temp = [
                'id' => $p_id,
                'name' => $project->p_name,
                'f_year' => $project->f_year,
                'p_status' => $project->p_status,
                'p_target' => $project->p_target,
                'vertical' => $vertical,
                'role' => Role::where('id', $prj->role)->get()->first()->name ?? "NA",
            ];
            $projectData[] = $temp;
        }
        $vendors = Vendor::where('added_by', Auth::user()->id)->get();
        $data = [
            'projectsCount' => $projects->count(),
            'vendorCount' => $vendors->count(),
            'addedVendors' => $vendors->count(),
            'projects' => $projectData,
            'authRoleId' => $role,
            'authName' => $authName
        ];
        $authUser = Auth::user();
        $authRole = Role::find($authRoleId)->name ?? "NA";
        $authdata = [
            'id' => $authUser->id,
            'name' => $authUser->name,
            'role' => $authRole
        ];

        return view('spoc.index1', compact('data', 'authdata'));
    }

    public function create()
    {
        $authId = Auth::user()->id;
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $vendordata = Vendor::where('added_by', Auth::user()->id)->get();
        return view('spoc.add', compact('authId', 'authdata', 'vendordata'));
    }

    public function store(Request $request)
    {
        print_r($request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'added_by' => 'required',
            'name' => 'required',
            'mobile' => 'required', // Ensure mobile is exactly 10 digits
            'email' => 'required',
            'address' => 'required',
            'state' => 'required',
            'district' => 'required',
        ]);

        try {
            // Use validated data for creation
            $data = Vendor::create($validatedData);
        } catch (\Exception $e) {
            // Handle exception and redirect with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Register Vendor: ' . $e->getMessage()]);
        }

        // Redirect with success message
        return redirect()->route('spoc.save')->with(['success' => 'Successfully Registered Vendor.']);
    }


    public function createAssign()
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $projectData = [];
        $Status = Status::all();
        $authId = Auth::user()->id;
        $vendors = Vendor::where('added_by', '=', Auth::user()->id)->get();
        $projects = Passociation::where('u_id', $authId)->get();
        foreach ($projects as $prj) {
            $p_id = $prj->p_id;
            $project = Project::where('id', $p_id)->get()->first();
            $temp = [
                'id' => $p_id,
                'name' => $project->p_name,
            ];
            $projectData[] = $temp;
        }
        $vassociationdata = Vassociation::where('added_by', $authId)->get();
        $vassociations = [];

        foreach ($vassociationdata as $va) {
            $v_id = $va->v_id;
            $vendor = Vendor::where('id', $v_id)->get()->first();
            $project = Project::where('id', $va->p_id)->get()->first();
            $temp = [
                'id' => $v_id,
                'name' => $vendor->name,
                'project' => $project->p_name,
                'start_date' => $va->start_date,
                'end_date' => $va->end_date,
                'status' => $va->status,
                'state' => $va->state,
                'district' => $va->district,
                'remark' => $va->remark,
            ];

            $vassociations[] = $temp;
        }




        return view('spoc.assignP', compact('projectData', 'vendors', 'Status', 'vassociations', 'authId', 'authdata'));
    }

    public function storeAssign(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'p_id' => 'required|integer',
                'v_id' => 'required|integer',
                'status' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'state' => 'required|string',
                'district' => 'required|array',
                'district.*' => 'string', // Ensure each district is a string
                'added_by' => 'nullable|integer',
                'remark' => 'nullable|string',
            ]);
            $stateName = explode('_', $request->state)[1] ?? '';
            // Loop through each district and create a Vassociation record
            foreach ($request->district as $district) {
                $district = trim($district); // Trim whitespace

                if (!empty($district)) {
                    Vassociation::create([
                        'p_id' => $request->p_id,
                        'v_id' => $request->v_id,
                        'status' => $request->status,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'state' => trim($stateName),
                        'district' => $district,
                        'added_by' => $request->added_by, // Optional field
                        'remark' => $request->remark, // Optional field
                    ]);
                }
            }

            // Redirect with success message
            return redirect()->route('spoc.saveAssign')->with('success', 'Successfully assigned project.');

        } catch (ValidationException $e) {
            // Redirect back with validation errors
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function createMedia(int $id)
    {
        $projects = Project::where('id', '=', $id)->get();
        $authId = Auth::user()->id;
        $doc_types = Document_type::all();
        $authUser = Auth::user();
        $authRole = Role::find($authId)->name ?? "NA";
        $authdata = [
            'id' => $authUser->id,
            'name' => $authUser->name,
            'role' => $authRole
        ];
        return view('spoc.media', compact('projects', 'authdata', 'authId', 'doc_types'));
    }

    public function storeMedia(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'type' => 'required',
            'remark' => 'nullable|string',
            'image_files' => 'required|array',
            'image_files.*' => 'file|max:2048', // Added file type validation
        ]);

        if ($validator->fails()) {
            return redirect()->route('team.saveUpload')->withErrors($validator)->withInput();
        }

        $addedBy = $request->input('added_by');
        $fileType = $request->input('type');
        $remark = $request->input('remark');
        $projectId = $request->input('project_id');
        $vendorId = ($projectId == 1) ? 0 : $request->input('vass_id');
        $baseFolderPath = "document/";
        $folderPath = storage_path('app/' . $baseFolderPath); // Use storage_path for folder path

        // Ensure the folder exists
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        foreach ($request->file('image_files') as $file) {
            $originalFilename = $file->getClientOriginalName();
            $filename = hash('md5', time() . $originalFilename) . '.' . $file->getClientOriginalExtension();

            try {
                // Store the file
                $file->storeAs($baseFolderPath, $filename);

                // Store the file details in the database
                Media::create([
                    'added_by' => $addedBy,
                    'vass_id' => $vendorId,
                    'type' => $fileType,
                    'name' => $filename,
                    'original_name' => $originalFilename,
                    'remark' => $remark,
                    'project_id' => $projectId,
                ]);
            } catch (\Exception $e) {
                // Handle file storage exception
                return redirect()->route('spoc.index')->withErrors(['error' => 'Failed to upload file: ' . $e->getMessage()])->withInput();
            }
        }

        return redirect()->route('spoc.index')->with(['success' => 'Files uploaded successfully.']);
    }


    public function createVendor()
    {
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";

        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $projectData = [];
        $authIds = Auth::user()->id;
        $vendors = Vendor::where('added_by', Auth::user()->id)->get();
        $projects = Passociation::where('u_id', $authIds)->get();
        foreach ($projects as $prj) {
            // project ki id
            $p_id = $prj->p_id;
            // projects table se data
            $project = Project::where('id', $p_id)->get()->first();
            $vendors = Vassociation::where('p_id', $p_id)->get();
            $temp = [
                'id' => $p_id,
                'name' => $project->p_name,
            ];

            $projectData[] = $temp;
        }
        $Vendoruserdatas = [];
        $Vendorusers = Vendoruser::where('added_by', Auth::user()->id)->get();
        foreach ($Vendorusers as $va) {
            $v_id = $va->v_id;
            $vendor = Vendor::where('id', $v_id)->get()->first();
            $project = Project::where('id', $va->p_id)->get()->first();
            $temp = [
                'id' => $v_id,
                'name' => $va->name,
                'mobile' => $va->mobile,
                'email' => $va->email,
                'vendor_name' => $vendor->name,
                'project_name' => $project->name,

            ];

            $Vendoruserdatas[] = $temp;
        }

        return view('spoc.vendorLogin', compact('projectData', 'authIds', 'Vendoruserdatas', 'authdata'));
    }

    public function storeVendor(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email|max:255|unique:vendorusers,email',
            'password' => 'required|string',
            'p_id' => 'required|integer',
            'v_id' => 'required|integer',
            'added_by' => 'required|integer',
        ]);

        // Hash the password
        $hashedPassword = Hash::make($validatedData['password']);
        // Create and save the Vendoruser instance
        $vendorUser = Vendoruser::create([
            'name' => $validatedData['name'],
            'mobile' => $validatedData['mobile'],
            'email' => $validatedData['email'],
            'password' => $hashedPassword,
            'p_id' => $validatedData['p_id'],
            'v_id' => $validatedData['v_id'],
            'added_by' => $validatedData['added_by'],
        ]);
        // Redirect with success message
        return redirect()->route('spoc.saveVendor')->with(['success' => 'Successfully assigned  project.']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('spoc.edit', compact('user'));
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
        $project = Project::find($id);
        $name = $project->p_name;
        $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
        $head = User::where('id', $project->n_spoc)->get()->first()->name ?? "NA";
        $details = $project->p_details;
        $status = $project->status == 1 ? "Active" : "Inactive";
        $vendors = Vassociation::where('p_id', $project->id)->orderBy('start_date', 'desc')->get();
        // ddd($vendors);  
        $vendorData = [];
        foreach ($vendors as $vendor) {
            $temp = [
                'vaa_id' => $vendor->id,
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
        $data = [
            'id' => $project->id,
            'name' => $name,
            'details' => $details,
            'head' => $head,
            'vertical' => $vertical,
            'status' => $status,
            'vendors' => $vendorData,
            'teams' => $teams,
        ];
        return view('spoc.getProject', compact('data', 'mediaData', 'authdata'));
    }

    public function getVendor(int $id)
    {
        // $vendor = Vendor::find($id);
        // $name = $vendor->name;
        // $state = $vendor->state;
        // $district = $vendor->district;
        // $address = $vendor->address;
        // $email = $vendor->email;
        // $mobile = $vendor->mobile;
        // $status = $vendor->status == 1 ? "Active" : "Inactive";
        // $projects = Vassociation::where('v_id', $vendor->id)->get();
        // $projectData = [];
        // foreach ($projects as $project) {
        //     $temp = [
        //         'id' => $project->id,
        //         'name' => Project::where('id', $project->p_id)->get()->first()->p_name ?? "NA",
        //         'state' => $project->state,
        //         'district' => $project->district,
        //         'start_date' => $project->start_date,
        //         'end_date' => $project->end_date ?? "NA",
        //         'status' => $project->status == 1 ? "Ongoing" : "Completed",
        //     ];
        //     $projectData[] = $temp;
        // }
        // $data = [
        //     'id' => $vendor->id,
        //     'name' => $name,
        //     'state' => $state,
        //     'district' => $district,
        //     'address' => $address,
        //     'email' => $email,
        //     'mobile' => $mobile,
        //     'status' => $status,
        //     'projects' => $projectData,
        // ];
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";
        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        $mediaData = [];
        $media = Media::where('vass_id', $id)->orderBy('created_at', 'desc')->get(); // Fetch media related to the specified project ID and order by created_at
        foreach ($media as $m) {
            $mediaData[] = [
                'id' => $m->id,
                'original_name' => $m->original_name,
                'name' => $m->name,
                'created_at' => date('M j, Y g:i A', strtotime($m->created_at)) // Format date and time
            ];
        }
        return view('spoc.view', compact('authdata', 'mediaData'));
    }

    public function internalReports123()
    {
        $userId = Auth::user()->id;
        $projects = Project::where('n_spoc', $userId)->get()->unique('id');

        $mediaData = [];
        foreach ($projects as $project) {
            $p_id = $project->id;
            $medias = Media::where('project_id', $p_id)->whereIn('type', [1, 5])->get();
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
            'name' => 'Internal/Project Reports',
            'media' => $mediaData,
        ];
        $authRoleId = Auth::user()->role;
        $authName = Auth::user()->name;
        $role = Role::where('id', $authRoleId)->first()->name ?? "NA";

        $authdata = [
            'name' => $authName,
            'role' => $role
        ];
        return view('spoc.internal-reports', compact('data', 'authdata'));
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

        return view('spoc.internal-reports', compact('data', 'authdata'));
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
        return view('spoc.internal-reports', compact('data', 'authdata'));
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


        return view('spoc.profile', compact('data'));
    }

    //profile updateprofile
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










}