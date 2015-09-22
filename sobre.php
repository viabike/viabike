<?php include("template/header.php");?>
<script>
$(document).ready(function(){
	$('.img-pb').mouseenter(function() {
		$(this).hide();
		$(this).siblings('.img-hover').show();
	});
	$('.img-hover').mouseleave(function() {
		$(this).hide();
		$(this).siblings('.img-pb').show();
	});
});

</script>

<center><h1>Sobre</h1></center><br>
<p class="paragrafo">O projeto <b>ViaBike.me</b> tem por objetivo auxiliar os ciclistas de Caraguatatuba com um mapa que permite a visualização das ciclovias disponíveis na cidade, pontos de interesses como bicicletarias e postos de gasolina para calibrar pneus e utilizar outros serviços, além de permitir ao usuário cadastrado enviar sinalizações para o mapa, informando problemas nas ciclovias: interdições, alagamentos, obras, etc.</p><br>

<p class="paragrafo">Este sistema web foi desenvolvido pelos alunos do Instituto Federal de São Paulo - Campus Caraguatatuba, do curso técnico de Informática para Internet, na disciplina de Projeto Interdisciplinar do último módulo do curso, durante 19 semanas do semestre.</p><br>

<p class="paragrafo">A proposta de trabalho foi utilizar um método educativo de aprendizagem baseada em problemas (Problem-based learning - PBL) com a meta de produzir uma ferramenta social de utilidade pública para região.</p><br>

<p class="paragrafo">Os alunos do curso aplicaram neste trabalho diversas tecnologias web como: as linguagens HTML, CSS, JavaScript, PHP e SQL; o Banco de Dados MySQL; e a API de mapas do Google.</p><br>

<p class="paragrafo">O projeto foi desenvolvido utilizando métodos de engenharia de software de desenvolvimento ágil (framework Scrum) e Projetos Centrado no Usuário (User-Centered Design - UCD) com técnicas de prototipação e avaliações de usabilidade.</p><br>

<p class="paragrafo">A disciplina foi ministrada pelo Professor Me. Renan Cavichi, envolvendo os alunos: Brian Soares, Haryel Luyde, Itallo Ferreira, Jorge Fernando, Lucas Marques, Lucas Perrotta e William Melo.</p><br><br>
<center>
<img src="imagens/equipe/equipe-pb.jpg" alt="Nossa Equipe" class="img-pb">
<img src="imagens/equipe/equipe.jpg" alt="Nossa Equipe" class="img-hover">
</center>
<?php include("template/footer.php");?>