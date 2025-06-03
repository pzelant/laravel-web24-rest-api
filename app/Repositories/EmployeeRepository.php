<?php

namespace App\Repositories;

use App\Models\Employee;
use App\ValueObjects\EmployeeData;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function create(EmployeeData $data): Employee
    {
        return Employee::create($data->toArray());
    }

    public function update(Employee $employee, EmployeeData $data): Employee
    {
        $employee->update($data->toArray());
        return $employee;
    }

    public function delete(Employee $employee): bool
    {
        return $employee->delete();
    }

    public function find(int $id): ?Employee
    {
        return Employee::find($id);
    }

    public function all(): Collection
    {
        return Employee::all();
    }

    public function findByCompany(int $companyId): Collection
    {
        return Employee::where('company_id', $companyId)->get();
    }
} 