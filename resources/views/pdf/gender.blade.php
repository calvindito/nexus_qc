<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <div style="text-align:center;">
        <img src="{{ asset('website/logo-big.PNG') }}" style="max-width:250px; display:block;">
        <h2 style="margin-top:35px;">DATA GENDER</h2>
        <table cellspacing="0" border="1" cellpadding="10" style="margin-top:35px; width:100%;">
            <thead>
                <tr style="text-align:center;">
                    <th>No</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
                @if($data->count() > 0)
                    @foreach($data as $key => $d)
                        <tr>
                            <td align="center" style="height:auto; vertical-align:center;">{{ $key + 1 }}</td>
                            <td align="center" style="height:auto; vertical-align:center;">{{ $d->name }}</td>
                            <td align="center" style="height:auto; vertical-align:center;">{!! $d->status() !!}</td>
                            <td align="center" style="height:auto; vertical-align:center;">{{ $d->createdBy->name }}</td>
                            <td align="center" style="height:auto; vertical-align:center;">{{ $d->updatedBy->name }}</td>
                            <td align="center" style="height:auto; vertical-align:center;">{{ $d->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr style="text-align:center;">
                        <td align="center" colspan="6">Data not available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
