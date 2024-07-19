<!DOCTYPE html>
<html>
<head>
    <title>Phone Numbers</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Phone Numbers</h1>
    <form id="filter-form">
        <select name="country" id="country">
            <option value="">Select country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->country }}">{{ $country->country }}</option>
            @endforeach
        </select>
        <select name="state" id="state">
            <option value="">Valid phone numbers</option>
            <option value="OK">Valid</option>
            <option value="NOK">Invalid</option>
        </select>
    </form>
    <table>
        <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>Country Code</th>
            <th>Phone Number</th>
        </tr>
        </thead>
        <tbody id="phone-numbers">
        @foreach ($phoneNumbers as $phoneNumber)
            <tr>
                <td>{{ $phoneNumber->country }}</td>
                <td>{{ $phoneNumber->state }}</td>
                <td>{{ $phoneNumber->country_code }}</td>
                <td>{{ $phoneNumber->number }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="pagination-links">
        {{ $phoneNumbers->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    $(document).ready(function() {
        function fetchPhoneNumbers(url = "{{ route('phone_numbers.index') }}") {
            const country = $('#country').val();
            const state = $('#state').val();

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    country: country,
                    state: state
                },
                success: function(response) {
                    $('#phone-numbers').html(response.html);
                    $('#pagination-links').html(response.pagination);
                }
            });
        }

        $('#country, #state').change(function() {
            fetchPhoneNumbers();
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            fetchPhoneNumbers(url);
        });
    });
</script>
</body>
</html>
