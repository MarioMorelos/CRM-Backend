<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Base64Image implements ValidationRule
{
    protected array $allowedMimes = [
        'image/jpeg',
        'image/png',
        'image/jpg'
    ];

    protected int $maxSizeKB = 2048; // 2MB

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            $fail("The {$attribute} must be a string.");
            return;
        }

        // Validar estructura Data URI
        if (!preg_match('~^data:(image/[a-zA-Z]+);base64,~', $value, $matches)) {
            $fail("The {$attribute} must be a valid base64 image.");
            return;
        }

        $mime = $matches[1];

        // Validar mime permitido
        if (!in_array($mime, $this->allowedMimes)) {
            $fail("The {$attribute} must be jpg or png.");
            return;
        }

        // Extraer base64
        $base64 = substr($value, strpos($value, ',') + 1);

        $decoded = base64_decode($base64, true);

        if ($decoded === false) {
            $fail("The {$attribute} is not valid base64.");
            return;
        }

        // Validar tamaño
        $sizeKB = strlen($decoded) / 1024;

        if ($sizeKB > $this->maxSizeKB) {
            $fail("The {$attribute} must be less than {$this->maxSizeKB} KB.");
            return;
        }

        // Validar que realmente sea imagen
        if (@imagecreatefromstring($decoded) === false) {
            $fail("The {$attribute} is not a real image.");
            return;
        }

        // Validar mime real
        $f = finfo_open();
        $realMime = finfo_buffer($f, $decoded, FILEINFO_MIME_TYPE);
        finfo_close($f);

        if (!in_array($realMime, $this->allowedMimes)) {
            $fail("The {$attribute} mime type is not allowed.");
        }
    }
}
