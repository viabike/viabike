<?php
	require_once("../conexao/conexao.php");
	$pdo = conectar();

		// Preparando a QUERY
		$updatePonto = $pdo -> prepare("UPDATE ponto_interesse set nome = :nome, bairro = :bairro, rua = :rua, num = :num, cep = :cep, telefone = :telefone, hr_inicio = :hr_inicio, hr_fecha = :hr_fecha, categoria = :categoria, latitude = :latitude, longitude = :longitude WHERE id_ponto = :id_ponto");
			$updatePonto -> bindValue(":nome"      ,  $_POST["nome"     ]);
			$updatePonto -> bindValue(":bairro"    ,  $_POST["bairro"   ]);
			$updatePonto -> bindValue(":rua"       ,  $_POST["rua"      ]);
			$updatePonto -> bindValue(":num"       ,  $_POST["num"      ]);
			$updatePonto -> bindValue(":cep"       ,  $_POST["cep"      ]);
			$updatePonto -> bindValue(":telefone"  ,  $_POST["telefone" ]);
			$updatePonto -> bindValue(":hr_inicio" ,  $_POST["hr_inicio"]);
			$updatePonto -> bindValue(":hr_fecha"  ,  $_POST["hr_fecha" ]);
			$updatePonto -> bindValue(":categoria" ,  $_POST["categoria"]);
			$updatePonto -> bindValue(":latitude"  ,  $_POST["latitude" ]);
			$updatePonto -> bindValue(":longitude" ,  $_POST["longitude"]);
			$updatePonto -> bindValue(":id_ponto"  ,  $_POST["id_ponto" ]);
		// executando a QUERY
		$updatePonto -> execute();
	header("location: consulta_pontos.php");
?>
