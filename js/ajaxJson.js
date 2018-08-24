$(document).ready(function () {

	$("#btn-enviar").click(function (e) {
		axios.get('http://files.cod3r.com.br/curso-js/funcionarios.json')
			.then((response) => recebeDadosServidor(response));

		function recebeDadosServidor(response) {

			var pacoteEnvio = Array();
			var contador = 0;

			while (contador < response.data.length) {
				pacoteEnvio.push(JSON.stringify(response.data[contador]));
				contador++;
			}

			$.ajax({
				url: "recebe.php",
				contentType: 'application/x-www-form-urlencoded',
				dataType: 'json',
				data: {
					'envio': pacoteEnvio
				},
				type: 'post',
				success: function (data, textStatus, jqxhr) {
					data.forEach((x, i) => console.log(`${i + 1}. Nome: ${x.nome}, salario: ${x.salario}`));
				},
				error: function (jqxhr, textStatus, error) {
					console.log(error);
				},
			});
		}
		e.preventDefault();
	});
});
