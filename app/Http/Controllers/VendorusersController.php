<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Document_type;
use App\Models\Vassociation;
use App\Models\Vendoruser;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\Media;
use App\Models\Role;
use Document_types;

class VendorusersController extends Controller {
    public function index() {
        return view('vauth.login');
    }

    public function dashboard() {
        if (Auth::guard('vendor')->check()) {
            $userId =  Auth::guard('vendor')->user()->id;
            $vendorid = Auth::guard('vendor')->user()->v_id;
            $vendor = Vendor::where('id', $vendorid)->get()->first();
            $name = $vendor->name;
            $state = $vendor->state;
            $district = $vendor->district;
            $address = $vendor->address;
            $email = $vendor->email;
            $mobile = $vendor->mobile;
            $status = $vendor->status == 1 ? "Active" : "Inactive";
            $projects = Vassociation::where('v_id', $vendor->id)->get()->first();

            $authRoleId = $user->role;
            $role = optional(Role::find($authRoleId))->name ?? "NA";

            $authRoleId = Auth::guard('vendor')->user()->role;
            $authName = Auth::guard('vendor')->user()->name;
            $role = Role::where('id', $authRoleId)->get()->first()->name ?? "NA";

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
                    'userId' => $userId,
                    'userName' => Auth::guard('vendor')->user()->name,
                    'vendorid' => $vendorid,
                    'vendor_name' => $name,
                    'vendor_state' => $state,
                    'vendor_district' => $district,
                    'vendor_address' => $address,
                    'vendor_email' => $email,
                    'vendor_mobile' => $mobile,
                    'vendor_status' => $status,
                    'vendor_projects' => $projectData,
                    'rolesname' => $role
                ];
            $mediaData = [];
            $media = Media::where('added_by', $userId )->orderBy('created_at', 'desc')->get()->first(); // Fetch media related to the specified project ID and order by created_at
            foreach ($media as $m) {
                $mediaData[] = [
                    'id' => $m->id,
                    'original_name' => $m->original_name,
                    'name' => $m->name,
                    'created_at' => date('M j, Y g:i A', strtotime($m->created_at)) // Format date and time
                ];
            }
            return view('vendor.index1', compact('data','mediaData'));
        }
            return redirect("vendor-login");
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('vendor')->attempt($credentials)) {
            return redirect("vendor-login/dashboard");
        }
        return redirect("vendor-login")->withSuccess('Login details are not valid');
    }

    public function createMedia($id) {
        if (Auth::guard('vendor')->check()) {
            $vassociationData = Vassociation::where('id', $id)->get()->first();
            $doc_types = Document_type::all();
            $data = [
                'vass_id' => $id,
                'added_by' => Auth::guard('vendor')->id(),
                'project_id' => $vassociationData->p_id,
                'doc_types' => $doc_types,
            ];
            return view('vendor.media', compact('data'));
        }
            return redirect("vendor-login");
    }

    public function storeMedia(Request $request) {
        try {
            $request->validate([
                'vass_id' => 'required',
                'project_id' => 'required',
                'added_by' => 'required',
                'remark' => 'nullable',
                'image_files' => 'required|array',
                'image_files.*' => 'max:2048|file',
            ]);
            $vendorId = $request->input('vass_id');
            $projectId = $request->input('project_id');
            $addedBy = $request->input('added_by');
            $filetype = 6;
            $remark = $request->input('remark');

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
            return redirect('vendor-login/media/' . $vendorId)->with(['success' => 'Files uploaded successfully.']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('vendor-login/media/' . $vendorId)->with(['error' => $th->getMessage()]);
        }
    }

    public function registration() {
        return view('auth.register');
    }

    public function create(array $data) {
        return Vendoruser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::guard('vendor')->logout();
        return Redirect('vendor-login');
    }
}