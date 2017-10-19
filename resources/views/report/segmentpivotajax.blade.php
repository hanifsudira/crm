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
            <td align="right">{{$d->jan}}</td>
            <td align="right">{{$d->feb}}</td>
            <td align="right">{{$d->mar}}</td>
            <td align="right">{{$d->apr}}</td>
            <td align="right">{{$d->mei}}</td>
            <td align="right">{{$d->jun}}</td>
            <td align="right">{{$d->jul}}</td>
            <td align="right">{{$d->agu}}</td>
            <td align="right">{{$d->sep}}</td>
            <td align="right">{{$d->okt}}</td>
            <td align="right">{{$d->nov}}</td>
            <td align="right">{{$d->des}}</td>
            <td align="right">{{$d->jan+$d->feb+$d->mar+$d->apr+$d->mei+$d->jun+$d->jul+$d->agu+$d->sep+$d->okt+$d->nov+$d->des}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td align="right">{{$count[0]}}</td>
        <td align="right">{{$count[1]}}</td>
        <td align="right">{{$count[2]}}</td>
        <td align="right">{{$count[3]}}</td>
        <td align="right">{{$count[4]}}</td>
        <td align="right">{{$count[5]}}</td>
        <td align="right">{{$count[6]}}</td>
        <td align="right">{{$count[7]}}</td>
        <td align="right">{{$count[8]}}</td>
        <td align="right">{{$count[9]}}</td>
        <td align="right">{{$count[10]}}</td>
        <td align="right">{{$count[11]}}</td>
        <td></td>
    </tr>
    </tbody>

</table>