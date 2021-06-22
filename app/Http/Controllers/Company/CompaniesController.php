<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company\Company;

class CompaniesController extends Controller
{
    //========== read all companies ==========
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {

            $companies = Company::where('name', 'LIKE', "%$keyword%")
                ->orWhere('id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $companies = Company::paginate($perPage);
        }
        return view('companies.index', compact('companies'));
    }

    //========== create new company ==========
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        // start validations

        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' =>  'nullable|email|unique:companies,email',
            'website' =>  'nullable|url',
            'logo' =>  'nullable|image|dimensions:min_width=100,min_height=100',
        ]);

        // end validations

        if (isset($request->logo)) {
            $logo = $request->file('logo')->store('app', 'public');
        } else {
            $logo = null;
        }
        Company::create([
            'name' => $request['name'],
            'email' =>  $request['email'],
            'website' =>  $request['website'],
            'logo' =>  $logo,
        ]);

        return redirect()->route('company.index')->with('message', __('translations.company_addded_successfully'));
    }

    //========== update company ==========
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request)
    {
        // start validations

        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' =>  'nullable|email|unique:companies,email,' . $request->id,
            'website' =>  'nullable|url',
            'logo' =>  'nullable|image|dimensions:min_width=100,min_height=100',
        ]);

        // end validations


        $company = Company::find($request->id);

        if (isset($request->logo)) {
            $logo = $request->file('logo')->store('app', 'public');
        } else {
            $logo = $company->logo;
        }


        $company->update([
            'name' => $request['name'],
            'email' =>  $request['email'],
            'website' =>  $request['website'],
            'logo' =>  $logo,
        ]);

        return redirect()->route('company.index')->with('message', __('translations.company_updated'));
    }

    //========== show one company details==========
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.show', compact('company'));
    }

    //========== delete one company ==========
    public function destroy($id)
    {
        $company = Company::find($id);

        if ($company->employees->count() == 0) {
            $company->delete();
            return redirect()->route('company.index')->with('message', __('translations.company_deleted'));
        } else {
            return redirect()->route('company.index')->withErrors(__('translations.cannot_delete_company_have_employees'));
        }
    }
}
