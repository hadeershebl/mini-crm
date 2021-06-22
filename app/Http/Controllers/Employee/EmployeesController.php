<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Employee\Employee;

class EmployeesController extends Controller
{
    //========== read all employees ==========
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {

            $employees = Employee::where('first_name', 'LIKE', "%$keyword%")
                ->orWhere('id', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhereHas('company', function ($query) use ($keyword) {
                    return $query->where('name', 'LIKE', "%$keyword%");
                })
                ->latest()->paginate($perPage);
        } else {
            $employees = Employee::paginate($perPage);
        }
        return view('employees.index', compact('employees'));
    }

    //========== create new employee ==========
    public function create()
    {
        $companies = Company::select('name', 'id')->get();
        return view('employees.create', compact('companies'));
    }

    public function store(Request $request)
    {
        // start validations

        $this->validate($request, [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'company_id' => 'required|exists:companies,id',
            'email' =>  'nullable|email',
            'phone' =>  'nullable|regex:/(01)[0-9]{9}/|size:11',
        ]);

        // end validations

        Employee::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_id' => $request['company_id'],
            'email' =>  $request['email'],
            'phone' =>  $request['phone'],
        ]);

        return redirect()->route('employee.index')->with('message', __('translations.employee_addded_successfully'));
    }

    //========== update employee ==========
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::select('name', 'id')->get();

        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request)
    {
        // start validations

        $this->validate($request, [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'company_id' => 'required|exists:companies,id',
            'email' =>  'nullable|email',
            'phone' =>  'nullable|regex:/(01)[0-9]{9}/|size:11',
        ]);

        // end validations

        $employee = Employee::find($request->id);

        $employee->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_id' => $request['company_id'],
            'email' =>  $request['email'],
            'phone' =>  $request['phone'],
        ]);

        return redirect()->route('employee.index')->with('message', __('translations.employee_updated'));
    }

    //========== show one employee details==========
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    //========== delete one employee ==========
    public function destroy($id)
    {
        $employee = employee::destroy($id);

        return redirect()->route('employee.index')->with('message', __('translations.employee_deleted'));
    }
}
