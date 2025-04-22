<?php

namespace App\Http\Controllers;

use Validator, Redirect,Response;
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
use App\Models\Vertical;
use App\Models\Vendor;
use App\Models\Vassociation;
use Vendors;
use Vassociations;
use Verticals;
use Projects;
use Teams;
use Users;
use Auth;
use DB;

class VendorController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
   
    public function showReport () {
        // $users = User::whereIN('role', array(3,4))->get();
        // $projects = Project::get();
      $teams = Team::get();
      
      $authUserId = auth()->user()->id;
        
        $data = DB::table('vassociations')
        ->join('projects', 'vassociations.p_id', '=', 'projects.id')
        ->where('projects.added_by', '=', $authUserId)
        ->select('vassociations.*', 'projects.p_name', 'projects.p_details') // Add other columns as needed
        ->get();
        return view('vendor.showReport', compact('data', 'teams'));
    }
    
    public function index() {
        $allowedVerticals = ['1', '2', '3', '4', '5'];
        
        // Check if the user's vertical is in the allowed verticals
        if (in_array(auth()->user()->vertical, $allowedVerticals)) {
            $users = User::whereIn('role', [4, 5])->get();
            $projects = Project::where('added_by', Auth::user()->id)->get();
            $teams = Team::where('added_by', Auth::user()->id)->get();
            return view('vendor.index', compact('users', 'projects', 'teams'));
            
            }elseif (in_array(auth()->user()->vertical, $allowedVerticals)) {
                //$users = User::whereIn('role', [4, 5])->get();
                $projects = Project::where('added_by', Auth::user()->id)->get();
                $teams = Team::where('added_by', Auth::user()->id)->get();
                return view('vendor.index', compact('users', 'projects', 'teams'));
            }elseif (in_array(auth()->user()->vertical, $allowedVerticals)) {
                //$users = User::whereIn('role', [4, 5])->get();
                $projects = Project::where('added_by', Auth::user()->id)->get();
                $teams = Team::where('added_by', Auth::user()->id)->get();
                return view('vendor.index', compact('users', 'projects', 'teams'));
            }
        return view('vendor.index');
    }

    public function show (User $user, $id) {
        $user  = User::find($id);
        return view('vendor.view', compact('user'));   
    }

    public function changePass() {
        //$user  = User::find($id);
        $users = User::first();
        return view('vendor.changePassword', compact('users'));
    } 

    public function UpdatePass(Request $request) {
        $data= $request->input();
        $request->validate([
            'password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
       if (Auth::attempt(['email' => auth()->user()->email, 'password' => $data['password']])) {
           User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        }else{
            return Redirect::back()->withErrors(['Alert-', 'Current password is wrong']);
        }
            //dd('Password change successfully.');
            return redirect('vendor')->with('success', 'Password change successfully!');
    }

    public function edit(User $user, $id) {  
        $user = User::find($id);
        return view('vendor.edit', compact('user')); 
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->project = $request->get('project');
        $user->email = $request->get('email');
        $user->save();
        return redirect('vendor.index')->with('success', 'Data updated!');
    }

    public function destroy($id) {
        $bcuser = User::find($id);
        $bcuser->delete();
        return redirect('vendor.index')->with('success', 'Contact deleted!');
    }
}