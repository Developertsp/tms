<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CompanyWelcomeMail;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('permission:view-companies|create-companies|update-companies|delete-companies', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-companies', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-companies', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-companies', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $companies = Company::orderBy('id', 'DESC')->get();

        return response()->json([
            'user' => $user,
            'companies' => $companies
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'joining_date' => 'nullable|date_format:Y-m-d',
            'expiry_date' => 'nullable|date_format:Y-m-d',
            'phone' => 'nullable|numeric',
            'whatsapp' => 'nullable|numeric',
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image_name = time() . '_' . uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/companies_logo/', $image_name);
        }

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->joining_date = $request->joining_date;
        $company->expiry_date = $request->expiry_date;
        $company->phone = $request->phone;
        $company->whatsapp = $request->whatsapp;
        $company->created_by = Auth::id();

        if ($request->hasFile('logo')) {
            $company->logo = $image_name;
        }

        if ($company->save()) {
            try {
                Mail::to($company->email)->send(new CompanyWelcomeMail($company));
            } catch (\Exception $e) {
                // Log the error or handle it accordingly
            }
            return response()->json(['message' => 'Company created successfully', 'company' => $company]);
        } else {
            return response()->json(['message' => 'Company was not created'], 500);
        }
    }

    public function edit($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json([
            'company' => $company
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('companies')->ignore($id),
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'joining_date' => 'nullable|date_format:Y-m-d',
            'expiry_date' => 'nullable|date_format:Y-m-d',
            'phone' => 'nullable|numeric',
            'whatsapp' => 'nullable|numeric',
        ]);

        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image_name = time() . '_' . uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/companies_logo/', $image_name);
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->joining_date = $request->joining_date;
        $company->expiry_date = $request->expiry_date;
        $company->phone = $request->phone;
        $company->whatsapp = $request->whatsapp;
        $company->updated_by = Auth::id();

        if ($request->hasFile('logo')) {
            $company->logo = $image_name;
        }

        if ($company->save()) {
            return response()->json(['message' => 'Company updated successfully', 'company' => $company]);
        } else {
            return response()->json(['message' => 'Company was not updated'], 500);
        }
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete(); // Soft delete

        return response()->json(['message' => 'Company deleted successfully']);
    }
}

