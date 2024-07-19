<?php

namespace App\Services;

use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhoneNumberService
{
    /**
     * Get filtered phone numbers.
     */
    public function getFilteredPhoneNumbers(Request $request)
    {
        $query = PhoneNumber::query();

        $validator = Validator::make($request->all(), [
            'country' => 'nullable|string',
            'state' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors(), 'code' => 422];
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        return $query->paginate(10);
    }

    /**
     * Get distinct countries.
     */
    public function getDistinctCountries()
    {
        return PhoneNumber::select('country')->distinct()->get();
    }
}
