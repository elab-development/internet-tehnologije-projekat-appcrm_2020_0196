<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 1);

        $query = Company::where('active', $status);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $companies = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($companies);
    }

    public function show($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }
        return response()->json($company);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
            'industry' => 'required|string|max:255',
        ]);

        $company = Company::create($validated);
        return response()->json($company, 201);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'active' => 'sometimes|required|boolean',
            'industry' => 'sometimes|required|string|max:255',
        ]);

        $company->update($validated);
        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}
