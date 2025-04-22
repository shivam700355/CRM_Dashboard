<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Models\Role;
use Projects;
use Teams;
use Users;
use Auth;
use DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::whereIn('role', [3, 4])->get();

        // Extract role IDs from $users collection
        $roleIds = $users->pluck('role')->unique();

        // Fetch roles based on extracted role IDs
        $rolename = Role::whereIn('id', $roleIds)->get();

        $projects = Project::get();
        $teams = Team::get();

        return view('admin.index', compact('users', 'rolename', 'projects', 'teams'));
    }


    public function show(User $user, $id)
    {
        $user = User::find($id);
        return view('admin.view', compact('user'));
    }

    public function createP(User $user)
    {
        $users = User::get();
        return view('admin.addProject', compact('users'));
    }

    public function storeP(Request $request)
    {
        $userid = $request->user()->id;
        $request->validate([
            'p_name' => 'required',
            'p_details' => 'required',
            'n_spoc' => 'required',
        ]);
        $data = Project::create([
            'p_name' => $request->p_name,
            'p_details' => $request->p_details,
            'n_spoc' => $request->n_spoc,
            'added_by' => $userid
        ]);
        return redirect('admin')->with('success', 'Add user successfully!');
        //return view ('admin.index')->with(['success' => 'Thank you for Add user.']);
    }

    public function createT()
    {
        $teams = Team::get();

        $users = User::get();
        $projects = Project::get();
        return view('admin.addTeam', compact('users', 'projects', 'teams'));
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

            $data = Team::create([
                'name' => $request->name,
                'pro_id' => $request->pro_id,
                'description' => $request->description,
                'added_by' => $userid
            ]);

            return redirect('admin.addTeam')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error('Failed to add user: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to add user. Please try again.');
        }
    }

    public function create()
    {
        $users = User::whereIn('role', [3, 4])->get();

        return view('admin.add', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $userid = $request->user()->id;

            $request->validate([
                'name' => 'required',
                'vertical' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required',
            ]);

            $data = User::create([
                'name' => $request->name,
                'vertical' => $request->vertical,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request['password']),
                'role' => $request->role,
                'added_by' => $userid
            ]);

            return redirect('admin')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add user: ' . $e->getMessage());
        }
    }


    public function changePass()
    {
        //$user  = User::find($id);
        $users = User::first();
        return view('admin.changePassword', compact('users'));
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
        return redirect('admin/list')->with('success', 'Password change successfully!');
    }

    public function edit(User $user, $id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->project = $request->get('project');
        $user->email = $request->get('email');
        $user->save();
        return redirect('admin.index')->with('success', 'Data updated!');
    }

    public function destroy($id)
    {
        $bcuser = User::find($id);
        $bcuser->delete();
        return redirect('admin.index')->with('success', 'Contact deleted!');
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


        return view('admin.profile', compact('data'));
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