<?php

namespace App\ValueObjects;

class EmployeeData
{
    private int $companyId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phone;

    public function __construct(
        int $companyId,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone = null
    ) {
        $this->companyId = $companyId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function toArray(): array
    {
        return [
            'company_id' => $this->companyId,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
} 