<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use user;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::get();
        return view('company.index', compact('companies'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        }
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        }

        $logoPath = $request->file('comp_logo') ? $request->file('comp_logo')->store('comp_logos', 'public') : null;

        Company::create([
            'comp_name' => $request->comp_name,
            'comp_email' => $request->comp_email,
            'comp_logo' => $logoPath,
            'comp_website' => $request->comp_website,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id); // Find the company or throw a 404 error
        return view('company.show', compact('company'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to Edit companies.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to Edit companies.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to Delete companies.');
        }
    }
}
