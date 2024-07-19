@foreach ($phoneNumbers as $phoneNumber)
    <tr>
        <td>{{ $phoneNumber->country }}</td>
        <td>{{ $phoneNumber->state }}</td>
        <td>{{ $phoneNumber->country_code }}</td>
        <td>{{ $phoneNumber->number }}</td>
    </tr>
@endforeach
