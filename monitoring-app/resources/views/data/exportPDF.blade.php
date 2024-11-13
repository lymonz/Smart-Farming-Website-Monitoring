<head>
    <style>
        table,
			td,
			th {
				border: 1px solid;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-left: 10px;
				padding-right: 10px;
			}

			table {
				width: 100%;
				border-collapse: collapse;
			}
    </style>
</head>
<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Device</th>
            <th>Kelembaban Tanah (TT)</th>
            <th>Kelembaban Tanah (SM)</th>
            <th>Kelembaban Udara</th>
            <th>Intensitas Cahaya</th>
            <th>Battery</th>
            <th>Temperature</th>
            <th>Kadar Garam</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_device }}</td>
            <td>{{ $item->kelembaban_tanah_th }}</td>
            <td>{{ $item->kelembaban_tanah_sm }}</td>
            <td>{{ $item->kelembaban_udara }}</td>
            <td>{{ $item->i_cahaya }}</td>
            <td>{{ $item->battery }}</td>
            <td>{{ $item->temperature }}</td>
            <td>{{ $item->kadar_garam }}</td>
        </tr>
        @endforeach
    </tbody>
</table>