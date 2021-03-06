<!DOCTYPE html>
<html>
<head>
    <style>
        h2 {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>Patient List</h2>

<table>
    <tr>
        <th>#</th>
        @if (Auth::guard('doctor')->check())
        <th>Consultant date</th>
        @endif
        <th>Patient Id</th>
        <th>Name</th>
        <th>Mobile no</th>
        <th>Address</th>
    </tr>
    <tbody>
    @if (Auth::guard('doctor')->check())
        @foreach($patients as  $no =>  $patient_re)
                @foreach($patient_re->patient as $patient)
                    <tr>
                        <td>{{ $no + 1  }}</td>
                        <td>{{ $patient_re->consultant_date }}</td>
                        <td>{{$patient->patient_id}}</td>
                        <td>{{ ucfirst($patient->name) }}</td>
                        <td>{{$patient->mobile_no}}</td>
                        <td>{{ $patient->address }}</td>
                    </tr>
                @endforeach
        @endforeach
    @endif
    @if (Auth::guard('hospital')->check())
        @foreach($patients as $no => $patient)
            <tr>
                <td>{{ $no + 1  }}</td>
                <td>{{ $patient->patient_id }}</td>
                <td>{{ ucfirst($patient->name) }}</td>
                <td>{{$patient->mobile_no}}</td>
                <td>{{ $patient->address }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
    @empty($patient)
        <h4 style="text-align: center">No patient at time</h4>
    @endempty
</table>
</body>
</html>
