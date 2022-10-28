<?php
/**
 * Plugin Name:     Teste Suno By Luan Carvalho
 * Plugin URI:      https://github.com/LuanJCarvalho/teste-suno-by-luan-carvalho
 * Description:     Mostra dados de um ativo da Nasdaq
 * Author:          Luan Jacinto Carvalho
 * Author URI:      https://www.linkedin.com/in/luanjcarvalho/
 * Text Domain:     teste-suno-by-luan-carvalho
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Teste_Suno_By_Luan_Carvalho
 */

// Your code starts here.

// ativar isso pra evitar acesso direto ao arquivo do plugin
defined('ABSPATH') || exit;

// definindo qual ativo será importado os dados pela api da nasdaq
$ativo_nasdaq = "AAPL";
$key_nasdaq = "m4bx46hyk7GmKsRmkVjr";
$dataInicial = "2012-10-25";
$dataFinal = "2012-10-26";

// montar url de forma mais dinâmica
$url_api = "https://data.nasdaq.com/api/v3/datasets/WIKI/".$ativo_nasdaq.".json?start_date=".$dataInicial."&end_date=".$dataFinal."&api_key=".$key_nasdaq."";

$dados = file_get_contents($url_api);
$obj = json_decode($dados);

// capturando os dados
$nome = $obj->dataset->name;
$sigla = "(".$obj->dataset->dataset_code.")";
$fonte1_1 = "Nasdaq";
$fonte1_2 = "Listed";
$fonte2_1 = "Nasdaq";
$fonte2_2 = "100";
$variacaoPorcentagem = "(-x,x%)";
$variacaoValor = number_format($obj->dataset->data[0][4] - $obj->dataset->data[1][4], 2, '.', '');
$valor =  "$".number_format($obj->dataset->data[0][4], 2, '.', '');
$closedInfo1 = "CLOSED AT 4:00 PM ET ON OCT";
$closedInfo2 = "26, 2012";

?>

<style>
	div#ativoNasdaq {
		background-color: #722296;
		width: 100%;
		color: #DAE4E9;
		font-family: Courier New, Arial;
	}
	div#ativoNasdaq div.info1{
		background-color: #722296;
		float: left;
		width: 100%;
	}
	div#ativoNasdaq div.info1 div{
		float: left;
	}
	div#ativoNasdaq div.info1 div.nome{
		font-size: 30px;
		font-weight: bold;
		padding: 15px 10px 10px 5px;
		border-left: 4px solid;
	}
	div#ativoNasdaq div.info1 div.sigla{
		font-size: 24px;
		padding: 18px 10px 10px 0px;
	}

	div#ativoNasdaq div.info2{
		background-color: #722296;
		float: left;
		width: 100%;
	}
	div#ativoNasdaq div.info2 div{
		float: left;
		font-size: 17px;
		padding: 10px 10px 10px 5px;
	}
	div#ativoNasdaq div.info2 div.fonte1{
		border-left: 4px solid;
	}

	div#ativoNasdaq div.info3{
		background-color: #722296;
		text-align: right;
		float: right;
		width: 100%;
	}
	div#ativoNasdaq div.info3 div{
		float: right;
		font-size: 17px;
		padding: 10px 10px 10px 5px;
	}

	div#ativoNasdaq div.info4{
		background-color: #722296;
		text-align: right;
		width: 100%;
	}

	div#ativoNasdaq div.info4 div{
		padding: 10px 10px 10px 5px;
	}

	div#ativoNasdaq div.info5{
		background-color: #722296;
		text-align: right;
		width: 100%;
	}
	div#ativoNasdaq div.info5 div{
		padding: 0px 10px 10px 5px;
	}


</style>

<div id="ativoNasdaq">
	<div class="info1">
		<div class="nome">
			<?php echo $nome; ?>
		</div>
		<div class="sigla">
			<?php echo $sigla; ?>
		</div>
	</div>
	<div class="info2">
		<div class="fonte1">
			<b><?php echo $fonte1_1; ?></b> <?php echo $fonte1_2; ?>
		</div>
		<div class="fonte2">
			<b><?php echo $fonte2_1; ?></b> <?php echo $fonte2_2; ?>
		</div>
	</div>
	<div class="info3">
		<div class="variacaoPorcentagem">
			<?php echo $variacaoPorcentagem; ?>
		</div>
		<div class="variacaoValor">
			<?php echo $variacaoValor; ?>
		</div>
		<div class="valor">
			<?php echo $valor; ?>
		</div>
	</div>
	<div class="info4">
		<div class="closedInfo1">
			<?php echo $closedInfo1; ?>
		</div>
	</div>
	<div class="info5">
		<div class="closedInfo2">
			<?php echo $closedInfo2; ?>
		</div>
	</div>
</div>
