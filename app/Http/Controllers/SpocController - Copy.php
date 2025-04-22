<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Validator, Redirect, Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

        // $authId = Auth::user()->id;
        // $associations = Vassociation::select(
        //     'projects.p_name',
        //     'vendors.name as vendor_name',
        //     'vassociations.state',
        //     'vassociations.district',
        //     'vassociations.start_date',
        //     'vassociations.end_date',
        //     'status.name as status_name'
        // )
        //     ->join('vendors', 'vassociations.v_id', '=', 'vendors.id')
        //     ->join('projects', 'vassociations.p_id', '=', 'projects.id')
        //     ->join('status', 'vassociations.status', '=', 'status.id')
        //     ->where('vendors.added_by', $authId)
        //     ->get();
        // $vendors = Vendor::where('added_by', Auth::user()->id)->get();
        // $projects = Project::where('n_spoc', Auth::user()->id)->get();
        // $data = [];

        // foreach ($projects as $project) {
        //     $user = User::find($project->n_spoc)->name ?? "NA";
        //     $vertical = Vertical::find($project->vertical_id)->name ?? "NA";
        //     $stat = $project->status == 1 ? "Active" : "Inactive";

        //     $temp = [

        //         'id' => $project->id ?? "NA",
        //         'name' => $project->p_name,
        //         'details' => $project->p_details,
        //         'head' => $user,
        //         'vertical' => $vertical,
        //         'status' => $stat,
        //     ];
        //     $data[] = $temp;
        // }
        return view('spoc.index1', compact('data'));
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
        return view('spoc.add', compact('authId', 'authdata'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'added_by' => 'required',
            'name' => 'required|max:50',
            'mobile' => 'required|max:10',
            'email' => 'required|email|max:50',
            'address' => 'required',
            'state' => 'required|max:50',
            'district' => 'required|max:50',
        ]);
        try {
            $data = Vendor::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to Register Vendor: ' . $e->getMessage()]);
        }
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
        return view('spoc.assignP', compact('projectData', 'vendors', 'Status', 'authId', 'authdata'));
    }

    public function storeAssign(Request $request)
    {
        try {
            $request->validate([
                'p_id' => 'required',
                'v_id' => 'required',
                'status' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'state' => 'required',
                'district' => 'required|string',
            ]);

            $districts = explode(',', $request->district);
            foreach ($districts as $district) {
                if ($district) {
                    Vassociation::create([
                        'p_id' => $request->p_id,
                        'v_id' => $request->v_id,
                        'status' => $request->status,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'state' => $request->state,
                        'district' => $district,
                        'added_by' => $request->added_by,
                        'remark' => $request->remark,
                    ]);
                }
            }
            return redirect()->route('spoc.saveAssign')->with(['success' => 'Successfully assign project.']);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function createMedia(int $id)
    {
        $projects = Project::where('id', '=', $id)->get();
        $authId = Auth::user()->id;
        $doc_types = Document_type::all();
        return view('spoc.media', compact('projects', 'authId', 'doc_types'));
    }

    public function storeMedia(Request $request)
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
        return redirect()->route('team.saveUpload')->with(['success' => 'Files uploaded successfully.']);
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
        return view('spoc.vendorLogin', compact('projectData', 'authIds', 'authdata'));
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
        $projects = Project::where('n_spoc', $userId)->get()->unique('id');
        ///ddd($projects);
        $mediaData = [];
        foreach ($projects as $project) {
            $p_id = $project->id;
            $medias = Media::where('project_id', $p_id)->whereIn('type', [1, 5])->orderByDesc('created_at')->get();

            //ddd($medias);
            foreach ($medias as $media) {
                $vassData = Vassociation::where('id', $media->vass_id);
                //$vid = optional($vassData)->v_id ?? 0;
                if ($vassData->get()->count() > 0) {
                    $vid = $vassData->get()->first()->id;
                    $vendorName = Vendor::find($vid)->get()->first()->name ?? "NA";
                    $uploadDate = date('M j, Y ', strtotime($media->created_at));
                    $state = $vassData->get()->first()->state ?? "NA";
                    $district = $vassData->get()->first()->district ?? "NA";
                } else {
                    $vendorName = 'Internal Report';
                    $state = 'Internal';
                    $district = 'Internal';
                }
                //$vendorName = ($vid != 0) ? Vendor::find($vid)->name : "NA";
                $uploadDate = date('M j, Y ', strtotime($media->created_at));
                $temp = [
                    'mediaName' => $media->original_name,
                    'vendorName' => $vendorName,
                    'projectName' => $project->p_name,
                    'stateName' => $state,
                    'districtName' => $district,
                    'uploadDate' => $uploadDate,
                    'view' => $media->name,
                ];
                $mediaData[] = $temp;
            }
        }
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
        return view('spoc.internal-reports', compact('data', 'authdata'));
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
            'role' => Role::find(Auth::user()->role)->first()->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'password' => Auth::user()->password

        ];


        return view('director.profile', compact('data'));
    }
}