<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CompanyWelcomeMail;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');

    //     $this->middleware('permission:view-companies|create-companies|update-companies|delete-companies', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:create-companies', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:update-companies', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete-companies', ['only' => ['destroy']]);
    // }

    public function index(): JsonResponse
    {
        try {
            $user = Auth::user();
            $companies = Company::orderBy('id', 'DESC')->get();

            if ($companies->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No company found'], 404);
            }
            return response()->json(['status' => 'success', 'message' => 'All ccompanies', 'data' => [
                'user' => $user,
                'companies' => $companies
            ]]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving companies record', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function create(Request $request) : JsonResponse
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'joining_date' => 'nullable|date_format:Y-m-d',
            'expiry_date' => 'nullable|date_format:Y-m-d',
            'phone' => 'nullable|numeric',
            'whatsapp' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

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
        $company->created_by = auth('sanctum')->user()->id;

        if ($request->hasFile('logo')) {
            $company->logo = $image_name;
        }
         try {
            if ($company->save()) {
                // Mail::to($company->email)->send(new CompanyWelcomeMail($company));
                return response()->json(['status' => 'success','message' => 'Company created successfully', 'company' => $company]);
            }
         } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error creating companies record', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request,$id) :JsonResponse
    {
        $validator = Validator::make($request->all(), [
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
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()],400);
        }

         try {
            $company = Company::find($id);

            if (!$company) {
                return response()->json(['status' => 'empty','message' => 'Company not found'], 404);
            }
    
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $image_name = time() . '_' . uniqid('', true) . '.' . $image->getClientOriginalExtension();
                $request->file('logo')->storeAs('public/companies_logo/', $image_name);
            }
    
            $post_data['name']         = $request->name;
            $post_data['email']        = $request->email;
            $post_data['joining_date'] = $request->joining_date;
            $post_data['expiry_date']  = $request->expiry_date;
            $post_data['phone']        = $request->phone;
            $post_data['whatsapp']     = $request->whatsapp;
            $post_data['updated_by']   = auth('sanctum')->user()->id;
    
            if ($request->hasFile('logo')) {
                $post_data['logo'] = $image_name;
            }
            $company->update($post_data);
            return response()->json(['status' => 'success','message' => 'Company updated successfully', 'company' => $company]);
         }  catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error on updating companies record', 'error' => $e->getMessage()], 500);
        }
         
    }

    public function destroy($id)
    {
         try {
            $company = Company::find($id);
            if (!$company) {
                return response()->json(['status' => 'empty','message' => 'Company result not found'], 404);
            }
            $company->delete(); 
            return response()->json(['status' => 'success','message' => 'Company deleted successfully']);
         }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in deleting companies record', 'error' => $e->getMessage()], 500);
        }
    }
}
