<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class KodeBukuFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Memastikan kode buku diaanwali dengan karakter 'BK-'
        if (!str_starts_with(strtoupper($value), 'BK-')) {
            $fail('Format :attribute harus diawalan dengan "BK-" (Contoh: BK-TEST-001).');
        }
    }
}