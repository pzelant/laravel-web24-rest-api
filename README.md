# Web24 API - Laravel

## Opis

REST API do zarządzania firmami oraz ich pracownikami. Pozwala na pełny CRUD dla obu encji. Pracownicy są powiązani z firmą przez pole `company_id`.

W katalogu `/requests` znajdują się przykładowe pliki do testowania API w PHPStorm. Każdy plik zawiera gotowe wywołania HTTP z przykładami danych.

## Wymagania
- PHP >= 8.0
- Composer
- MySQL lub inna baza obsługiwana przez Laravel

## Instalacja

1. Sklonuj repozytorium lub pobierz pliki projektu.
2. Zainstaluj zależności:
   ```bash
   composer install
   ```
3. Skopiuj plik `.env.example` do `.env` i ustaw dane dostępowe do bazy danych:
   ```env
   DB_DATABASE=twoja_baza
   DB_USERNAME=twoj_uzytkownik
   DB_PASSWORD=twoje_haslo
   ```
4. Utwórz bazę danych o nazwie jak w `DB_DATABASE`.
5. Wygeneruj klucz aplikacji:
   ```bash
   php artisan key:generate
   ```
6. Wykonaj migracje:
   ```bash
   php artisan migrate
   ```
7. Uruchom serwer deweloperski:
   ```bash
   php artisan serve
   ```

## Endpointy API

### Firmy (companies)
- `GET    /api/companies` - lista firm
- `POST   /api/companies` - dodaj firmę
- `GET    /api/companies/{id}` - szczegóły firmy
- `PUT    /api/companies/{id}` - edytuj firmę
- `DELETE /api/companies/{id}` - usuń firmę

#### Przykładowy JSON do dodania/edycji firmy:
```json
{
  "name": "Nazwa Firmy",
  "nip": "1234567890",
  "address": "ul. Przykładowa 1",
  "city": "Warszawa",
  "postal_code": "00-001"
}
```

### Pracownicy (employees)
- `GET    /api/employees` - lista pracowników
- `POST   /api/employees` - dodaj pracownika
- `GET    /api/employees/{id}` - szczegóły pracownika
- `PUT    /api/employees/{id}` - edytuj pracownika
- `DELETE /api/employees/{id}` - usuń pracownika
- `GET    /api/companies/{companyId}/employees` - lista pracowników danej firmy

#### Przykładowy JSON do dodania/edycji pracownika:
```json
{
  "company_id": 1,
  "first_name": "Jan",
  "last_name": "Kowalski",
  "email": "jan.kowalski@example.com",
  "phone": "123456789" // opcjonalne
}
```

## Dobre praktyki
- Wzorzec Repository do obsługi logiki dostępu do danych
- ValueObject do enkapsulacji danych wejściowych
- Walidacja danych po stronie backendu

## Testowanie
Możesz testować API na kilka sposobów:

### PHPStorm
W katalogu `requests/` znajdują się gotowe pliki do testowania API w PHPStorm:
- `companies/` - przykłady wywołań dla endpointów firm
  - `list.http` - pobieranie listy firm
  - `get.http` - pobieranie pojedynczej firmy
  - `create.http` - tworzenie firm
  - `update.http` - aktualizacja firm
  - `delete.http` - usuwanie firm
- `employees/` - przykłady wywołań dla endpointów pracowników
  - `list.http` - pobieranie listy pracowników
  - `get.http` - pobieranie pojedynczego pracownika
  - `create.http` - tworzenie pracowników
  - `update.http` - aktualizacja pracowników
  - `delete.http` - usuwanie pracowników

Aby użyć tych plików w PHPStorm:
1. Otwórz dowolny plik `.http`
2. Kliknij zielony przycisk "Run" obok wybranego wywołania
3. Upewnij się, że zmienna `{{host}}` jest ustawiona na adres Twojego API (np. `http://localhost:8000`)

### Inne narzędzia
Możesz również testować API za pomocą:
- Postman
- Insomnia
- curl

---

Autor: Paweł Zelant, email: p.zelant@gmail.com