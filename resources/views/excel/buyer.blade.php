<table>
    <thead>
        <tr>
            <th rowspan="2" colspan="11" style="font-size:15px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center; width:100%;">NEXUS QUALITY CONTROL - DATA BUYER</th>
        </tr>
    </thead>
</table><br>

<table>
    <thead>
        <tr>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">COMPANY</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">DESCRIPTION</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">ADDRESS</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">CITY</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">PROVINCE</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">COUNTRY</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" colspan="4">CONTACT</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">REMARK</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">STATUS</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">MODIFIED BY</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;" rowspan="2">DATE CREATED</th>
        </tr>
        <tr>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">OFFICE</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">HP</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">FAX</th>
            <th style="height:25px; font-size:9px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">EMAIL</th>
        </tr>
    </thead>
    <tbody>
        @if($data->count() > 0)
            @foreach($data as $d)
                <tr>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->company }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->description }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->address }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->city->name }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->province->name }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->country->name }}
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:left; vertical-align:center;">
                        @if($d->buyerContact()->where('type', 1)->count() > 0)
                            @foreach($d->buyerContact()->where('type', 1)->get() as $key => $bc)
                                @php $break = $d->buyerContact()->where('type', 1)->count() == $key + 1 ? '' : '<br><br>'; @endphp
                                {{ $bc->name }}<br>
                                {{ $bc->rank->rank }}<br>
                                {{ $bc->value }}<br>
                                {!! $break !!}
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:left; vertical-align:center;">
                        @if($d->buyerContact()->where('type', 2)->count() > 0)
                            @foreach($d->buyerContact()->where('type', 2)->get() as $key => $bc)
                                @php $break = $d->buyerContact()->where('type', 2)->count() == $key + 1 ? '' : '<br><br>'; @endphp
                                {{ $bc->name }}<br>
                                {{ $bc->rank->rank }}<br>
                                {{ $bc->value }}<br>
                                {!! $break !!}
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:left; vertical-align:center;">
                        @if($d->buyerContact()->where('type', 3)->count() > 0)
                            @foreach($d->buyerContact()->where('type', 3)->get() as $key => $bc)
                                @php $break = $d->buyerContact()->where('type', 3)->count() == $key + 1 ? '' : '<br><br>'; @endphp
                                {{ $bc->name }}<br>
                                {{ $bc->rank->rank }}<br>
                                {{ $bc->value }}<br>
                                {!! $break !!}
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:left; vertical-align:center;">
                        @if($d->buyerContact()->where('type', 4)->count() > 0)
                            @foreach($d->buyerContact()->where('type', 4)->get() as $key => $bc)
                                @php $break = $d->buyerContact()->where('type', 4)->count() == $key + 1 ? '' : '<br><br>'; @endphp
                                {{ $bc->name }}<br>
                                {{ $bc->rank->rank }}<br>
                                {{ $bc->value }}<br>
                                {!! $break !!}
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td style="font-size:9px; border:1px solid black; text-align:center; vertical-align:center;">
                        {{ $d->remark }}
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
                <td colspan="11" style="font-size:10px; font-weight:bold; border:1px solid black; text-align:center; vertical-align:center;">Data Not Available</td>
            </tr>
        @endif
    </tbody>
</table>
