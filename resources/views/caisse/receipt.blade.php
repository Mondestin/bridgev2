
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Impréssion du reçu N° {{ $data->id}}</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />
  		<link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				/*max-width: 800px;*/
				margin: auto;
				padding: 15px;
				font-size: 18px;
				line-height: 35px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 3px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				/* padding-bottom: 20px; */
			}

			.invoice-box table tr.top table td.title {
				font-size: 25px;
				line-height: 25px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				/* padding-bottom: 40px; */
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				/* padding-bottom: 20px; */
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>
<!--  -->
	<body onload="window.print();">
    	<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
	           <table>
				<tr class="top">
					<td colspan="2">

							<table>
							<tr>
								<td class="title">
									<img src="{{asset('images/en_tete.jpg')}}"  height="85px">
								</td>
								<td>
									<h6>
										<br>
										<i>Tél: +242 05 380 07 04</i><br>
										<i>BP: 1216 - Pointe-Noire</i><br>
										<i>avenue Charles de Gaulle</i><br>
										<i>consulatgeneraldubenin.pnr@gmail.com</i><br>

									  </h6>

								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr class="information">
					<td colspan="2">

							<table>
							<tr>
								<td class="text-center">
									  <?php setlocale(LC_TIME, "fr_FR");?>
									  <h2><b>Reçu N°: {{ $data->id}}</b></h2>

									<small>Date: {{ date("d/m/Y",  strtotime($data->created_at))}}</small>

								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="">
					<td>Mode de paiement: <b>Espèces</b></td>

					<td></td>
				</tr>
				<tr class="">
					<td>Article: <b>{{ $data->types}}</b>


				</tr>

				<tr class="">
                    <td> @if ($check == 1 )
                        N° matricule:
                        <b>{{ $data->dem_no }}  </b> <br>
                        N° de CIC: <b>{{ $cardId->card_no }}</b>
                        @else
                         Citoyen: <strong>{{ $data->dem_no }} </strong>
                        @endif

				</tr>
                <tr class="">
                    @if ($check == 1 )
                    <td>Citoyen: <b>{{ $data->name }} {{ $data->surname }}</td>

                    @else
                    <td></td><br>
                    @endif
                    <br><td>Montant</td>
				</tr>
				<tr>
                    <td></td>
				<td> {{ $data->montant}}</td>
				</tr>
				<tr class="total">
                   <td></td>
					<td>Total: <b>{{ $data->montant}} Fcfa</b></td>
				</tr>
			</table>
			<div class="row mt-3" style="margin-bottom: 8%!important;">
					<h5 style="margin-left: 160px;">
						 <strong>Le Client</strong>
					</h5>
					<h5 style="margin-left: 500px;">
						<strong>La Caisse</strong>
					</h5>
				</div>
		</div>
		<br>
		<hr class="mt-3" style=" height: 10px;">
        {{-- ------------------------------------------------------------------------------------------------------------- --}}
		<br>
			<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
	           <table>
				<tr class="top">
					<td colspan="2">

							<table>
							<tr>
								<td class="title">
									<img src="{{asset('images/en_tete.jpg')}}"  height="85px">
								</td>
								<td>
									<h6>
										<br>
										<i>Tél: +242 05 380 07 04</i><br>
										<i>BP: 1216 - Pointe-Noire</i><br>
										<i>avenue Charles de Gaulle</i><br>
										<i>consulatgeneraldubenin.pnr@gmail.com</i><br>

									  </h6>
								</i>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr class="information">
					<td colspan="2">

							<table>
							<tr>
								<td class="text-center">
									  <?php setlocale(LC_TIME, "fr_FR");?>
									  <h2><b>Reçu N°: {{ $data->id}}</b></h2>

									<small>Date: {{ date("d/m/Y",  strtotime($data->created_at))}}</small>

								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="">
					<td>Mode de paiement: <b>Espèces</b></td>

					<td></td>
				</tr>
				<tr class="">
					<td>Article: <b>{{ $data->types}}</b>
				</tr>

				<tr class="">
					<td> @if ($check == 1 )
                          N° matricule:
                          <b>{{ $data->dem_no }}  </b> <br>
                          N° de CIC: <b>{{ $cardId->card_no }}</b>
                          @else
                           Citoyen: <strong>{{ $data->dem_no }} </strong>
                          @endif
                  </td>
				</tr>
                 <tr class="">
                    @if ($check == 1 )
                    <td>Citoyen: <b>{{ $data->name }} {{ $data->surname }}</td>

                    @else
                    <td></td><br>
                    @endif
                    <br>
                          <td>Montant</td>
				</tr>
				<tr>
                    <td></td><td>{{ $data->montant}}</td>
				</tr>
				<tr class="total">
                   <td></td>
					<td>Total: <b>{{ $data->montant}} Fcfa</b></td>
				</tr>
			</table>
			<div class="row mt-3" style="margin-bottom: 8%!important;">
					<h5 style="margin-left: 160px;">
						 <strong>Le Client</strong>
					</h5>
					<h5 style="margin-left: 500px;">
						<strong>La Caisse</strong>
					</h5>
				</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
			$('.btnprn').printPage();
			});
			</script>
	</body>
</html>
