<table>
    <thead>
        <tr>
            <th rowspan="2" colspan="6" style="font-size:15px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center; width:100%;">NEXUS QUALITY CONTROL - SUB GROUP DEFECT</th>
        </tr>
    </thead>
</table><br>

<table>
    <thead>
        <tr>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">GROUP</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">CODE</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">SUB GROUP</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">STATUS</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">MODIFIED BY</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">DATE CREATED</th>
        </tr>
    </thead>
    <tbody>
        @if($data->count() > 0)
            @foreach($data as $d)
                <tr>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->parent()->name }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->code }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->name }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        @if($d->status == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->updatedBy->name }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->created_at->format('d M Y') }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" style="font-size:10px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">Data Not Available</td>
            </tr>
        @endif
    </tbody>
</table>
