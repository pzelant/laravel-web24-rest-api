<?php

namespace App\ValueObjects;

class CompanyData
{
    private string $name;
    private string $nip;
    private string $address;
    private string $city;
    private string $postalCode;

    public function __construct(
        string $name,
        string $nip,
        string $address,
        string $city,
        string $postalCode
    ) {
        $this->name = $name;
        $this->nip = $nip;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'nip' => $this->nip,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postalCode,
        ];
    }
} 