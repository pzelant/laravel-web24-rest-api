<?php

namespace App\Repositories;

use App\Models\Company;
use App\ValueObjects\CompanyData;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function create(CompanyData $data): Company;
    public function update(Company $company, CompanyData $data): Company;
    public function delete(Company $company): bool;
    public function find(int $id): ?Company;
    public function all(): Collection;
} 