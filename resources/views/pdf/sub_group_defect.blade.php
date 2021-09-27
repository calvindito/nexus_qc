<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            margin-top: 35px;
            width: 100%;
            font-size: 10px;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 10px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #07074b;
            color: white;
        }

        table td {
            height: auto;
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>
    <div style="text-align:center;">
        <h2 style="margin-top:35px;">NEXUS QUALITY CONTROL</h2>
        <h4 style="color:gray;">DATA SUB GROUP DEFECT</h4>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Group</th>
                    <th>Code</th>
                    <th>Sub Group</th>
                    <th>Status</th>
                    <th>Modified By</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
                @if($data->count() > 0)
                    @foreach($data as $key => $d)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $d->parent()->name }}</td>
                            <td>{{ $d->code }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{!! $d->status() !!}</td>
                            <td>{{ $d->updatedBy->name }}</td>
                            <td>{{ $d->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">Data not available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
