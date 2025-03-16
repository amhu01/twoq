<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use user;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(auth()->user()->is_admin);
        $companies = Company::pluck('comp_name','id');
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('companies.index')->with('error', 'You do not have access to create companies.');
        }
    }
}
