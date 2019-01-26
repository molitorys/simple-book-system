<?php

namespace App\Validators;

use Illuminate\Validation\Validator;
use App\Models\Book;

class ReaderBookUnique
{
    /**
     * Check if book already belongs to a reader
     *
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param Illuminate\Validation\Validator $validator
     * @return boolean
     */
    public function validate(string $attribute, $value, array $parameters, Validator $validator): bool
    {
        $nick = array_get($validator->getData(), 'nick');
        if (!$nick && !empty($value)) {
            return true;
        }

        $bookNum = Book::whereHas('reader', function($query) use ($nick) {
                    $query->where('nick', $nick);
                })
                ->where('title', $value)
                ->count();
            
        if ($bookNum > 0) {
            return false;
        }

        return true;
    }
}