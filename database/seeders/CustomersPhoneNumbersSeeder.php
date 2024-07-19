<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use App\Models\PhoneNumber;

class CustomersPhoneNumbersSeeder extends Seeder
{
    public function run()
    {

        $data = Customer::all();

        foreach ($data as $item) {
            $phone = $item['phone'];
            $countryCode = substr($phone, 1, 3);
            $number = substr($phone, 6);

            $state = $this->validatePhoneNumber($countryCode, $number) ? 'OK' : 'NOK';

            PhoneNumber::create([
                'name' => $item['name'],
                'country' => $this->getCountryByCode($countryCode),
                'state' => $state,
                'country_code' => '+' . $countryCode,
                'number' => $number,
            ]);
        }
    }

    private function validatePhoneNumber($countryCode, $number)
    {
        $patterns = [
            '237' => '/^[2368]\d{7,8}$/',
            '251' => '/^[1-59]\d{8}$/',
            '212' => '/^[5-9]\d{8}$/',
            '258' => '/^[28]\d{7,8}$/',
            '256' => '/^\d{9}$/'
        ];

        return isset($patterns[$countryCode]) && preg_match($patterns[$countryCode], $number);
    }

    private function getCountryByCode($countryCode)
    {
        $countries = [
            '237' => 'Cameroon',
            '251' => 'Ethiopia',
            '212' => 'Morocco',
            '258' => 'Mozambique',
            '256' => 'Uganda'
        ];

        return $countries[$countryCode] ?? 'Unknown';
    }
}
