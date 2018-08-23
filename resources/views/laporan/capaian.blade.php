<title>Rekapitulasi Capaian Seluruh Bab</title>
<style>
	.title { text-align: center; }
	table { border-collapse: collapse; }
	table, th, td { border: 1px solid black; padding: 5px 5px; }
	th { text-align: center; }
	th, td { height: 30px;  }
	.text-center { text-align: center; }
</style>
<h3 class="title">REKAPITULASI CAPAIAN SELURUH BAB</h3>
<table width="100%">
	<thead>
		<tr>
			<th width="5%">NO</th>
			<th>BAB</th>
			<th width="15%">SKOR</th>
			<th width="15%">MAKSIMAL</th>
			<th width="15%">CAPAIAN</th>
		</tr>
	</thead>
	<tbody>
		@php 
			$total_skor = 0;
			$total_maksimal = 0;
			$status = 'Lulus';
		@endphp

		@foreach($pokjas as $index => $pokja)
			@php 
				$bab_skor = 0;
				$bab_maksimal = 0;
			@endphp
			@foreach($pokja->standar as $standar)
				@php 
					$skor = 0;
					$maksimal = 0;
				@endphp

				@foreach($standar->elemen as $elemen)
					@php 
						$skor += $elemen->nilai;
						$maksimal += 10;
					@endphp
				@endforeach
				
				@php 
					$bab_skor += $skor;
					$bab_maksimal += $maksimal;
				@endphp

			@endforeach

			<tr>
				<td class="text-center">{{ ($index + 1) }}</td>
				<td>{{ $pokja->kepanjangan }}</td>
				<td class="text-center">{{ $bab_skor }}</td>
				<td class="text-center">{{ $bab_maksimal }}</td>
				<td class="text-center">{{ number_format($bab_maksimal == 0 ? 0 : (($bab_skor / $bab_maksimal) * 100), 2) }}%</td>
			</tr>

			@php 
				$total_skor += $bab_skor;
				$total_maksimal += $bab_maksimal;
			@endphp

			@if($bab_skor < 80)
				@php
					$status = 'Tidak Lulus';
				@endphp
			@endif
		@endforeach

		<tr>
			<td class="text-center" colspan="2">Total</td>
			<td class="text-center">{{ $total_skor }}</td>
			<td class="text-center">{{ $total_maksimal }}</td>
			<td class="text-center">{{ number_format((($total_skor / $total_maksimal) * 100), 2) }}%</td>
		</tr>
	</tbody>
</table>

<h3>Status : {{ $status }}</h3>
<p class="text-muted">
    Kriteria Kelulusan : <br>
    Semua bab skor >= 80% (min 80%)
</p>