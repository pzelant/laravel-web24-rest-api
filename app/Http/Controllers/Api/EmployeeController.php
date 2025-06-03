<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;
use App\ValueObjects\EmployeeData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $employees = $this->employeeRepository->all();
        return response()->json($employees);
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
            'company_id' => 'required|exists:companies,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|string|max:20',
        ]);

        $employeeData = new EmployeeData(
            $validated['company_id'],
            $validated['first_name'],
            $validated['last_name'],
            $validated['email'],
            $validated['phone'] ?? null
        );

        $employee = $this->employeeRepository->create($employeeData);
        return response()->json($employee, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(Request $request, Employee $employee): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $employeeData = new EmployeeData(
            $validated['company_id'],
            $validated['first_name'],
            $validated['last_name'],
            $validated['email'],
            $validated['phone'] ?? null
        );

        $employee = $this->employeeRepository->update($employee, $employeeData);
        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $this->employeeRepository->delete($employee);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function byCompany(int $companyId): JsonResponse
    {
        $employees = $this->employeeRepository->findByCompany($companyId);
        return response()->json($employees);
    }
}
