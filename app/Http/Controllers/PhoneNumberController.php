<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhoneNumberService;

class PhoneNumberController extends Controller
{
    protected $phoneNumberService;

    public function __construct(PhoneNumberService $phoneNumberService)
    {
        $this->phoneNumberService = $phoneNumberService;
    }

    /**
     * Display a listing of the phone numbers.
     */
    public function index(Request $request)
    {
        $result = $this->phoneNumberService->getFilteredPhoneNumbers($request);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], $result['code']);
        }

        $phoneNumbers = $result;

        if ($request->ajax()) {
            return $this->handleAjaxRequest($phoneNumbers);
        } else {
            return $this->handleRegularRequest($phoneNumbers);
        }
    }

    /**
     * Handle AJAX request for phone numbers.
     */
    private function handleAjaxRequest($phoneNumbers)
    {
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
    private function handleRegularRequest($phoneNumbers)
    {
        $countries = $this->phoneNumberService->getDistinctCountries();

        return view('phone_numbers.index', compact('phoneNumbers', 'countries'));
    }
}
