<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Mail\ContactMail;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Models\Role;
use App\Models\Gst;
use App\Models\Epf;
use App\Models\Income;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Activity;
use App\Models\Payment;

use DateTime;
use Projects;
use Teams;
use Users;
use Auth;
use DB;

class FinanceController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logActivity($type, $description)
    {
        try {
            $message = Auth::user()->name . ' ' . $description;
            $device = gethostname(); // Get the current device name

            $activity = new Activity();
            $activity->u_id = Auth::user()->id;
            $activity->type = $type;
            $activity->message = $message;
            $activity->device = $device;
            $activity->save();

        } catch (\Exception $e) {
            // Log the error message or handle it as needed
            \Log::error('Error saving activity: ' . $e->getMessage());

            // Optionally, return a response or throw an exception
            return response()->json(['error' => 'Failed to save activity.'], 500);
        }
    }


    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $Gst = Gst::where('added_by', Auth::user()->id)->where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();
        $Epf = Epf::where('added_by', Auth::user()->id)->where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();
        $Income = Income::where('added_by', Auth::user()->id)->where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderBy('created_at', 'desc')->get();
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password,
            'Gst' => $Gst,
            'Epf' => $Epf,
            'Income' => $Income
        ];

        return view('finance.index', compact('data'));
    }


    public function incometaxtds(Request $request)
    {
        // Get startDate and endDate from the request; set defaults if not provided
        $startDate = $request->query('startDate', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->query('endDate', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Fetch income records based on the provided start and end dates
        $Income = Income::where('added_by', Auth::user()->id)
            ->where('status', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare the data array with user information and income records
        $data = [
            'name' => Auth::user()->name,
            'role' => optional(Role::find(Auth::user()->role))->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'Income' => $Income
        ];

        // Return the view with the data
        return view('finance.Income_tax_tds', compact('data'));
    }






    public function add_income_tex_tds(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name_type' => 'required|string',
                'tds_amount' => 'required|numeric',
                'month' => 'required',
                'challan_no' => 'required|string',
                'challan_date' => 'required|date',
                'due_date' => 'required|date',
                'remark' => 'required|string|max:255',
            ]);
            $this->logActivity('Add Income Tax TDS', 'Added Income Tax TDS');




            // Create new Income entry
            $income = new Income();
            $income->name_type = $validatedData['name_type'];
            $income->tds_amount = $validatedData['tds_amount'];
            $income->month = $validatedData['month'];
            $income->challan_no = $validatedData['challan_no'];
            $income->challan_date = $validatedData['challan_date'];
            $income->due_date = $validatedData['due_date'];
            $income->added_by = Auth::user()->id;
            $income->remark = $validatedData['remark'];
            $income->save();

            return redirect()->back()->with('success', 'Income Tax TDS added successfully.');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function gsttdsliability(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Initialize the query
        $query = Gst::where('added_by', Auth::user()->id)->where('status', 1);

        // Check if startDate and endDate are provided in the request
        if ($request->has('startDate') && $request->has('endDate')) {
            $startDate = Carbon::parse($request->input('startDate'));
            $endDate = Carbon::parse($request->input('endDate'));

            // Add date range filter to the query
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } else {
            // Default to the current month and year if no date range is provided
            $query->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear);
        }

        // Fetch the filtered data
        $Gst = $query->orderBy('created_at', 'desc')->get();

        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password,
            'Gst' => $Gst,
        ];

        return view('finance.gst', compact('data'));
    }


    public function gst_tds(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name_type' => 'required|string',
                // 'tax_amount' => 'required|numeric',
                's_gst' => 'nullable|numeric', // Added numeric validation for GST fields if needed
                'c_gst' => 'nullable|numeric',
                'i_gst' => 'nullable|numeric',
                'challan_date' => 'required|date',
                'due_date' => 'required|date',
                'remark' => 'nullable|string', // Added string validation for remark
            ]);

            // Log activity (assuming logActivity is a custom method)
            $this->logActivity('Add GST TDS', 'Added GST TDS');

            // Create a new Gst instance and save data
            $gst = new Gst();
            $gst->name_type = $validatedData['name_type'];
            // $gst->tax_amount = $validatedData['tax_amount'];
            $gst->s_gst = $validatedData['s_gst'] ?? 0; // Default to 0 if null
            $gst->c_gst = $validatedData['c_gst'] ?? 0;
            $gst->i_gst = $validatedData['i_gst'] ?? 0;
            $gst->challan_date = $validatedData['challan_date'];
            $gst->due_date = $validatedData['due_date'];
            $gst->remark = $validatedData['remark'] ?? '';
            $gst->added_by = Auth::id(); // Auth::id() is cleaner than Auth::user()->id
            $gst->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', "GST {$validatedData['name_type']} added successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database errors)
            \Log::error('Error adding GST TDS: ' . $e->getMessage()); // Log the error
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }


    public function deletegst(int $id)
    {
        try {
            // Use findOrFail to automatically handle not found entries
            $gst = Gst::findOrFail($id);
            // Update the status to mark as deleted
            $gst->status = 0;
            $gst->save();
            $this->logActivity('Delete GST', 'Deleted GST');

            return redirect()->back()->with('success', 'GST entry status updated to deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'GST entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error deleting GST entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function deleteincome(int $id)
    {
        try {
            // Use findOrFail to automatically handle not found entries
            $income = Income::findOrFail($id);

            // Update the status to mark as deleted
            $income->status = 0;
            $income->save();
            $this->logActivity('Delete Income', 'Deleted Income');

            return redirect()->back()->with('success', 'Income TDS entry status deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'GST entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error deleting GST entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }
    public function updateGst(Request $request)
    {
        try {
            // Find the Gst entry by ID
            $gst = Gst::findOrFail($request->input('id')); // Ensure you're using 'input()' method to get the value from the request

            // Validate the request data
            $validatedData = $request->validate([
                'nameType' => 'required|string',
                'tax_amount' => 'required|numeric',
                's_gst' => 'nullable|numeric',
                'c_gst' => 'nullable|numeric',
                'i_gst' => 'nullable|numeric',
            ]);

            // Log activity
            $this->logActivity('Update GST', 'Updated GST');

            // Update the Gst entry with the new data
            $gst->name_type = $validatedData['nameType'];
            $gst->tax_amount = $validatedData['tax_amount'];
            $gst->s_gst = $validatedData['s_gst'] ?? 0;
            $gst->c_gst = $validatedData['c_gst'] ?? 0;
            $gst->i_gst = $validatedData['i_gst'] ?? 0;

            $gst->save();

            return redirect()->back()->with('success', 'GST entry updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'GST entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error updating GST entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function incometdsupdate(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id' => 'required|exists:incomes,id', // Assuming there's an 'incomes' table
                // 'name_type' => 'required|string',
                'tds_amount' => 'required|numeric',
                'challan_no' => 'required|string',
                // 'challan_date' => 'required|date',
                // 'due_date' => 'required|date',
                // 'remark' => 'nullable|string'
            ]);

            // Find the income record by ID
            $income = Income::findOrFail($request->id); // Assuming you have an Income model

            // Update the record
            // $income->name_type = $validatedData['name_type'];
            $income->tds_amount = $validatedData['tds_amount'];
            $income->challan_no = $validatedData['challan_no'];
            // $income->challan_date = $validatedData['challan_date'];
            // $income->due_date = $validatedData['due_date'];
            // $income->remark = $validatedData['remark'];

            // Save the updated record
            $income->save();
            $this->logActivity('Update Income TDS', 'Updated Income TDS');

            // Redirect or return response
            return redirect()->back()->with('success', 'Income TDS updated successfully.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case when income is not found
            return redirect()->back()->with('error', 'Income record not found.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other type of exception
            return redirect()->back()->with('error', 'An error occurred while updating the record. Please try again later.');
        }
    }

    public function epfesi(Request $request)
    {
        // Initialize the query
        $query = Epf::where('added_by', Auth::user()->id)->where('status', 1);

        // Check if startDate and endDate are present in the request
        if ($request->has('startDate') && $request->has('endDate')) {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');

            // Apply the date filter to the query
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Get the filtered or unfiltered data
        $Epf = $query->orderBy('created_at', 'desc')->get();

        // Prepare the data to pass to the view
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password,
            'Epf' => $Epf,
        ];

        // Return the view with data
        return view('finance.eps_esi', compact('data'));
    }


    public function addepfesi(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name_type' => 'required',
                'name' => 'required',
                'customname' => 'required_if:name,Custom', // Conditional validation for custom name
                'year' => 'required|integer',
                'amount' => 'required|numeric',
                'challan_period' => 'required|integer|between:1,12', // Ensure month is valid
                'challan_date' => 'required|date',
                'epf_due_date' => 'required|date', // Make sure this matches your form's input name
                'remark' => 'nullable|string',
            ]);

            // Convert month number to month name
            $dateObj = DateTime::createFromFormat('!m', $validatedData['challan_period']);
            $monthName = $dateObj->format('F'); // Full month name

            // Create new EPF entry
            $epf = new Epf();
            $epf->name_type = $validatedData['name_type'];
            $epf->name = ($validatedData['name'] === 'Custom') ? $validatedData['customname'] : $validatedData['name'];
            $epf->amount = $validatedData['amount'];
            $epf->challan_period = $monthName . "-" . $validatedData['year'];
            $epf->challan_date = $validatedData['challan_date'];
            $epf->due_date = $validatedData['epf_due_date']; // Corrected due_date key
            $epf->remark = $validatedData['remark'];
            $epf->added_by = Auth::user()->id;
            $epf->save();

            // Log activity
            $this->logActivity('Add Epf Esi', 'Added Epf Esi');

            return redirect()->back()->with('success', 'Epf Esi added successfully.');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function deletepfesi(int $id)
    {
        try {
            // Use findOrFail to automatically handle not found entries
            $gst = Epf::findOrFail($id);

            // Update the status to mark as deleted
            $gst->status = 0;
            $gst->save();
            $this->logActivity('Delete Epf Esi', 'Deleted Epf Esi');

            return redirect()->back()->with('success', 'EPS ESI  deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'EPS ESI entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error deleting EPS ESI entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function updateepf(Request $request)
    {

        try {
            $epf = Epf::findOrFail($request['id']);

            $validatedData = $request->validate([
                'amount' => 'required|numeric',
                'challan_period' => 'required|string',
                'remark' => 'required|string|max:255',
            ]);

            // Update the Gst entry with the new data

            $epf->amount = $validatedData['amount'];
            $epf->challan_period = $validatedData['challan_period'];
            $epf->remark = $validatedData['remark'];
            $epf->save();
            $this->logActivity('Update Epf Esi', 'Updated Epf Esi');

            return redirect()->back()->with('success', 'EPS ESI updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'EPS ESI entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error updating EPS ESI entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function advancetostaff()
    {
        $Advance = Advance::where('added_by', Auth::user()->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password,
            'Advance' => $Advance,
        ];
        return view('finance.advancetostaff', compact('data'));

    }


    public function deletadtostaff(int $id)
    {
        try {
            // Use findOrFail to automatically handle not found entries
            $gst = Advance::findOrFail($id);

            // Update the status to mark as deleted
            $gst->status = 0;
            $gst->save();
            $this->logActivity('Delete Advance', 'Deleted Advance');

            return redirect()->back()->with('success', 'Advance entry  deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Advance entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error Advance GST entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function advancestore(Request $request)
    {

        try {
            // Validate the request data
            $validatedData = $request->validate([
                'particulars' => 'required',
                'adv_amount' => 'required',
                'adv_date' => 'required',
                'pending_date' => 'required',
                'user_status' => 'required',
                'remark' => 'required',
            ]);

            // Create new Advance entry
            $advance = new Advance();
            $advance->particulars = $validatedData['particulars'];
            $advance->adv_amount = $validatedData['adv_amount'];
            $advance->adv_date = $validatedData['adv_date'];
            $advance->pending_date = $validatedData['pending_date'];
            $advance->user_status = $validatedData['user_status'];
            $advance->remark = $validatedData['remark'];
            $advance->added_by = Auth::user()->id;
            $advance->save();

            $this->logActivity('Add Advance', 'Added Advance');



            return redirect()->back()->with('success', 'Advance added successfully.');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function advanceupdate(Request $request)
    {

        try {
            $advance = Advance::findOrFail($request['id']);

            $validatedData = $request->validate([
                'adv_amount' => 'required',
                'adv_date' => 'required',
                'remark' => 'required',
            ]);

            // Update the Gst entry with the new data

            $advance->adv_amount = $validatedData['adv_amount'];
            $advance->adv_date = $validatedData['adv_date'];
            $advance->remark = $validatedData['remark'];
            $advance->save();
            $this->logActivity('Update Advance', 'Updated Advance');

            return redirect()->back()->with('success', 'Advance updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Advance entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error updating Advance entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }






    public function bankpage()
    {
        $Bank = Bank::where('added_by', Auth::user()->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password,
            'Bank' => $Bank,
        ];
        return view('finance.bank', compact('data'));
    }
    public function deletebank(int $id)
    {
        try {
            // Use findOrFail to automatically handle not found entries
            $gst = Bank::findOrFail($id);

            // Update the status to mark as deleted
            $gst->status = 0;
            $gst->save();
            $this->logActivity('Delete Bank', 'Deleted Bank');

            return redirect()->back()->with('success', 'Bank entry  deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Bank entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error BankT entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function bankupdate(Request $request)
    {

        try {
            $bank = Bank::findOrFail($request['id']);

            $validatedData = $request->validate([
                'bank_name' => 'required',
                'account_detail' => 'required',
                'amount' => 'required',

            ]);
            // Update the Gst entry with the new data
            $bank->bank_name = $validatedData['bank_name'];
            $bank->account_detail = $validatedData['account_detail'];
            $bank->amount = $validatedData['amount'];
            $bank->save();
            $this->logActivity('Update Bank', 'Updated Bank');

            return redirect()->back()->with('success', 'Bank updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Bank entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error updating Bank entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function bankstore(Request $request)
    {

        try {
            // Validate the request data
            $validatedData = $request->validate([
                'bank_name' => 'required',
                'account_detail' => 'required',
                'amount' => 'required',

            ]);

            // Create new Bank entry
            $bank = new Bank();
            $bank->bank_name = $validatedData['bank_name'];
            $bank->account_detail = $validatedData['account_detail'];
            $bank->amount = $validatedData['amount'];
            $bank->added_by = Auth::user()->id;
            $bank->save();


            return redirect()->back()->with('success', 'Bank added successfully.');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function payment()
    {
        $Payment = Payment::where('status', 1)->where('added_by', Auth::user()->id)->get();

        $data = [
            'name' => Auth::user()->name,
            'role' => Role::find(Auth::user()->role)->name ?? "NA",
            'email' => Auth::user()->email,
            'mobile' => Auth::user()->mobile,
            'profile_pic' => Auth::user()->profile_pic,
            'password' => Auth::user()->password,
            'Payment' => $Payment,
        ];
        return view('finance.vendorpayment', compact('data'));

    }
    public function addpayment(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'vendor_name' => 'required',
                'pay_amount' => 'required|numeric|min:0.01',
                'pay_date' => 'required|date',
                'initiated_by' => 'required',
                'checked_by' => 'required',
                'approved_by' => 'required', // Fixed validation rule
                'remark' => 'nullable|string',
            ]);

            // Create new Payment entry
            $payment = new Payment();
            $payment->vendor_name = $validatedData['vendor_name'];
            $payment->pay_amount = $validatedData['pay_amount'];
            $payment->pay_date = $validatedData['pay_date'];
            $payment->voucher_no = 'Payment';
            $payment->initiated_by = $validatedData['initiated_by'];
            $payment->checked_by = $validatedData['checked_by'];
            $payment->approved_by = $validatedData['approved_by'];
            $payment->remark = $validatedData['remark'] ?? null;
            $payment->added_by = Auth::user()->id;

            // Check if the remark is provided
            if ($request->has('remark')) {
                $payment->remark = $request->input('remark');
            }

            $payment->save();
            $this->logActivity('Add Payment', 'Added Payment to Vendor');

            return redirect()->back()->with('success', 'Payment added successfully.');
        } catch (\Exception $e) {
            \Log::error('Payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding the payment.');
        }
    }


    public function paymentdelete(int $id)
    {
        try {
            // Use findOrFail to automatically handle not found entries
            $gst = Payment::findOrFail($id);

            // Update the status to mark as deleted
            $gst->status = 0;
            $gst->save();
            $this->logActivity('Delete Payment', 'Deleted Payment');

            return redirect()->back()->with('success', 'Payment entry  deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Payment entry not found.');
        } catch (\Exception $e) {
            \Log::error('Error Payment entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
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


        return view('finance.profile', compact('data'));
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
            $this->logActivity('Update Profile', 'Updated Profile');
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Profile update failed. Please try again.');
        }
    }


}
