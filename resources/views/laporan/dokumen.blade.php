<title>Rekapitulasi Dokumen Seluruh Bab</title>
<style>
	h3 { text-align: center; }
	table { border-collapse: collapse; }
	table, th, td { border: 1px solid black; padding: 5px 5px; }
	th { text-align: center; }
	th, td { height: 40px;  }
	.text-center { text-align: center; }
</style>
<h3 style="text-align: center;">REKAPITULASI DOKUMEN SELURUH BAB</h3>
<table width="100%">
	<thead>
		<tr>
			<th width="5%">NO</th>
			<th>BAB</th>
			<th width="20%">JUMLAH DOKUMEN</th>
		</tr>
	</thead>
	<tbody>
		@php
			$total = 0;
		@endphp
		@foreach($pokjas as $index => $pokja)
			@php
				$jumlah = 0;
			@endphp
			@foreach($pokja->standar as $standar)
				@foreach($standar->elemen as $elemen)
					@foreach($elemen->dokumen as $dokumen)
						@php
							$jumlah += 1;
						@endphp
					@endforeach
				@endforeach
			@endforeach
			@php
				$total += $jumlah;
			@endphp

			<tr>
				<td class="text-center">{{ ($index + 1) }}</td>
				<td>{{ $pokja->kepanjangan }}</td>
				<td class="text-center">{{ $jumlah }}</td>
			</tr>

		@endforeach

		<tr>
			<td class="text-center" colspan="2">Total</td>
			<td class="text-center">{{ $total }}</td>
		</tr>
	</tbody>
</table>