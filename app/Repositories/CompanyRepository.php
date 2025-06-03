<?php

namespace App\Repositories;

use App\Models\Company;
use App\ValueObjects\CompanyData;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function create(CompanyData $data): Company
    {
        return Company::create($data->toArray());
    }

    public function update(Company $company, CompanyData $data): Company
    {
        $company->update($data->toArray());
        return $company;
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }

    public function find(int $id): ?Company
    {
        return Company::find($id);
    }

    public function all(): Collection
    {
        return Company::all();
    }
} 