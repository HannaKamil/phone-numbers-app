<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneNumber;
use Illuminate\Support\Facades\Validator;

class PhoneNumberController extends Controller
{
    /**
     * Display a listing of the phone numbers.
     */
    public function index(Request $request)
    {
        $query = PhoneNumber::query();

        // Apply filters if present
        $this->applyFilters($query, $request);

        if ($request->ajax()) {
            return $this->handleAjaxRequest($query);
        } else {
            return $this->handleRegularRequest($query);
        }
    }

    /**
     * Apply filters to the query.
     */
    private function applyFilters($query, $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'nullable|string',
            'state' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }
    }

    /**
     * Handle AJAX request for phone numbers.
     */
    private function handleAjaxRequest($query)
    {
        $phoneNumbers = $query->paginate(10);

        $html = view('phone_numbers.partials.phone_numbers', compact('phoneNumbers'))->render();
        $pagination = view('phone_numbers.partials.pagination', compact('phoneNumbers'))->render();

        return response()->json([
            'html' => $html,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Handle regular request for phone numbers.
     */
    private function handleRegularRequest($query)
    {
        $phoneNumbers = $query->paginate(10);
        $countries = PhoneNumber::select('country')->distinct()->get();

        return view('phone_numbers.index', compact('phoneNumbers', 'countries'));
    }
}
