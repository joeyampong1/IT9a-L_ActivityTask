<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', [
            'items' => $employees
        ]);
    }

// insert
    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255', 
            'LastName' => 'required|string|max:255',
            'Job' => 'required|string|max:255',
            'Salary' => 'required|numeric',
        ]);

        Employee::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Job' => $request->Job,
            'Salary' => $request->Salary,
        ]);

        return redirect('/employees');
    }

// shows
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('Employee.show', compact('employee'));
    }

// edit
    public function edit($id)
    {
         $employee = Employee::findOrFail($id);
         return view('employee.edit', compact('employee'));
    }

// update
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update([
            'FirstName'=> $request->FirstName,
            'LastName'=> $request->LastName,
            'Job'=> $request->Job,
            'Salary'=> $request->Salary
            ]);
      return redirect('/employees');
    }

    // delete
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/employee');
    }

}