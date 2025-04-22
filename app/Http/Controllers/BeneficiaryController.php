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
use Projects;
use Teams;
use Users;
use Auth;
use DB;

class BeneficiaryController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $bcusers = User::orderBy('created_at','DESC')->get();
        return view('beneficiary.index', compact('bcusers'));
    }

    public function show(User $user, $id) {
        $bcuser = User::find($id);
        return view('beneficiary.view', compact('bcuser'));
    }

    public function edit(User $user, $id) {
    
        $bcuser = User::find($id);
        return view('beneficiary.edit', compact('bcuser')); 
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);
        $bcuser = User::find($id);
        $bcuser->name =  $request->get('name');
        $bcuser->email = $request->get('email');
        $bcuser->save();

        return redirect('/beneficiary')->with('success', 'Contact updated!');
    }
}
