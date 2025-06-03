<?php

namespace App\Repositories;

use App\Models\Employee;
use App\ValueObjects\EmployeeData;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function create(EmployeeData $data): Employee;
    public function update(Employee $employee, EmployeeData $data): Employee;
    public function delete(Employee $employee): bool;
    public function find(int $id): ?Employee;
    public function all(): Collection;
    public function findByCompany(int $companyId): Collection;
} 