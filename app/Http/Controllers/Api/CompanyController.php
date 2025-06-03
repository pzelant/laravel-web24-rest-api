<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\CompanyRepositoryInterface;
use App\ValueObjects\CompanyData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    private CompanyRepositoryInterface $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $companies = $this->companyRepository->all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|size:10|unique:companies',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|size:6',
        ]);

        $companyData = new CompanyData(
            $validated['name'],
            $validated['nip'],
            $validated['address'],
            $validated['city'],
            $validated['postal_code']
        );

        $company = $this->companyRepository->create($companyData);
        return response()->json($company, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(Request $request, Company $company): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|size:10|unique:companies,nip,' . $company->id,
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|size:6',
        ]);

        $companyData = new CompanyData(
            $validated['name'],
            $validated['nip'],
            $validated['address'],
            $validated['city'],
            $validated['postal_code']
        );

        $company = $this->companyRepository->update($company, $companyData);
        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        $this->companyRepository->delete($company);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
