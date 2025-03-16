<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
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
        // if (!auth()->user()->is_admin) {
        //     return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        // }
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        // if (!auth()->user()->is_admin) {
        //     return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        // }

        $logoPath = $request->file('comp_logo') ? $request->file('comp_logo')->store('comp_logos', 'public') : null;

        Company::create([
            'comp_name' => $request->comp_name,
            'comp_email' => $request->comp_email,
            'comp_logo' => $logoPath,
            'comp_website' => $request->comp_website,
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Company Created successfully.',
            'redirect' => route('companies.index'),
        ]);
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
        $company = Company::findOrFail($id); // Find the company or throw a 404 error
        if (!auth()->user()->is_admin && auth()->id() != $company->created_by) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to edit this company.');
        }

        return view('company.edit', compact('company'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        // Find the company
        $company = Company::findOrFail($id);

        // Authorization check
        if (!auth()->user()->is_admin && auth()->id() != $company->created_by) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to edit companies.');
        }

        // Handle the logo upload
        $logoPath = $company->comp_logo; // Keep the existing logo by default
        if ($request->hasFile('comp_logo')) {
            // Delete the old logo if it exists
            if ($company->comp_logo && Storage::disk('public')->exists($company->comp_logo)) {
                Storage::disk('public')->delete($company->comp_logo);
            }
            // Store the new logo
            $logoPath = $request->file('comp_logo')->store('comp_logos', 'public');
        }

        // Update the company
        $company->update([
            'comp_name' => $request->comp_name,
            'comp_email' => $request->comp_email,
            'comp_logo' => $logoPath,
            'comp_website' => $request->comp_website,
            'updated_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Company updated successfully.',
            'redirect' => route('companies.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        if (!auth()->user()->is_admin && auth()->id() != $company->created_by) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to Delete companies.');
        }

        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');

    }
}
