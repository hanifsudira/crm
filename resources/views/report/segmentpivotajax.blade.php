<table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
    <thead>
    <tr>
        <th rowspan="2">SEGMEN</th>
        <th colspan="13" style="text-align: center;">Jumlah ID-AGREE</th>
    </tr>
    <tr>
        <th>Januari</th>
        <th>Februari</th>
        <th>Maret</th>
        <th>April</th>
        <th>Mei</th>
        <th>Juni</th>
        <th>Juli</th>
        <th>Agustus</th>
        <th>September</th>
        <th>Oktober</th>
        <th>November</th>
        <th>Desember</th>
        <th>TOTAL</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td>{{$d->SEGMEN}}</td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'01',$nowyear,'1'])}}" target="_blank">{{$d->jan}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'02',$nowyear,'1'])}}" target="_blank">{{$d->feb}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'03',$nowyear,'1'])}}" target="_blank">{{$d->mar}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'04',$nowyear,'1'])}}" target="_blank">{{$d->apr}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'05',$nowyear,'1'])}}" target="_blank">{{$d->mei}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'06',$nowyear,'1'])}}" target="_blank">{{$d->jun}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'07',$nowyear,'1'])}}" target="_blank">{{$d->jul}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'08',$nowyear,'1'])}}" target="_blank">{{$d->agu}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'09',$nowyear,'1'])}}" target="_blank">{{$d->sep}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'10',$nowyear,'1'])}}" target="_blank">{{$d->okt}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'11',$nowyear,'1'])}}" target="_blank">{{$d->nov}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'12',$nowyear,'1'])}}" target="_blank">{{$d->des}}</a></td>
            <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'00',$nowyear,'3'])}}" target="_blank">{{$d->jan+$d->feb+$d->mar+$d->apr+$d->mei+$d->jun+$d->jul+$d->agu+$d->sep+$d->okt+$d->nov+$d->des}}</a></td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','01',$nowyear,'2'])}}" target="_blank">{{$count[0]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','02',$nowyear,'2'])}}" target="_blank">{{$count[1]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','03',$nowyear,'2'])}}" target="_blank">{{$count[2]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','04',$nowyear,'2'])}}" target="_blank">{{$count[3]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','05',$nowyear,'2'])}}" target="_blank">{{$count[4]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','06',$nowyear,'2'])}}" target="_blank">{{$count[5]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','07',$nowyear,'2'])}}" target="_blank">{{$count[6]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','08',$nowyear,'2'])}}" target="_blank">{{$count[7]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','09',$nowyear,'2'])}}" target="_blank">{{$count[8]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','10',$nowyear,'2'])}}" target="_blank">{{$count[9]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','11',$nowyear,'2'])}}" target="_blank">{{$count[10]}}</a></td>
        <td align="right"><a href="{{route('report.segmentdetail',['1','12',$nowyear,'2'])}}" target="_blank">{{$count[11]}}</a></td>
        <td align="right">{{$grandtotal}}</td>
    </tr>
    </tbody>

</table>