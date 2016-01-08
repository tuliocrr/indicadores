<?php 
/**
 *
 * Copyright [2014] -  Civis Gestão Inteligente
 * Este arquivo é parte do programa Civis Estratégia
 * O civis estratégia é um software livre, você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF) na versão 2 da Licença.
 * Este programa é distribuído na esperança que possa ser  útil, mas SEM NENHUMA GARANTIA, sem uma garantia implícita de ADEQUAÇÃO a qualquer  MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/GPL em português para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "licença GPL.odt", junto com este programa. Se não encontrar,
 * Acesse o Portal do Software Público Brasileiro no endereço www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="uft-8">
		<title>Autenticação | Civis Estratégia</title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->Html->css(
				array(
					'bootstrap.min',
					'bootstrap-responsive.min',
					'cake.generic',
					'footable.core',
					'jquery-ui.min',
					'plugins/treetable/stylesheets/jquery.treetable.theme.default.css',
					'plugins/treetable/stylesheets/jquery.treetable.css',
					'plugins/lwMultiSelect/jquery.lwMultiSelect.css',
					'dhtmlxgantt',
					'slickmap',
					'gantt',
					'core',
					'font-awesome',
					'main'
				)
			);
			echo $this->fetch('css');
		?>
	</head>
	<body>
		<div id="wrapper">
			<header id="header" class="clearfix">
		    	<div id="header-content" class="container clearfix">
		    		<span class="header-logo">
		    			<a href="<?php echo $this->base;?>/" class="header-logo-a" title="Civis Estratégia">
		    				<img src="<?php echo $this->base;?>/img/logo-civis-estrategia.png" alt="Civis Estratégia">
		    				<span class="visuallyhidden">Civis Estratégia</span>
		    			</a>
		    		</span>
		        </div><!-- fim #header-conteudo -->
		    </header><!-- fim #header -->
			<div class="wrapper-content">
				<div class="content container">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>	<!-- /.corpo-conteudo -->
			</div><!-- /.corpo -->
			<footer class="footer">
				 <div class="footer-bg">
					<div class="footer-content container clearfix"></div>
				</div>
			</footer><!-- /.rodape -->
		</div><!-- #wrapper -->
		<!-- Scripts -->
		<?php echo $this->Html->script(array('libs/jquery','libs/footable','libs/jquery-ui.min','plugins/treetable/javascripts/src/jquery.treetable.js'));?>
		<?php 
		echo $this->Html->script(
			array(
				'libs/jquery.maskedinput',
				'libs/jquery.maskMoney',
				'libs/bootstrap.min',
				'libs/geral',
				'libs/jquery.ui.datepicker'
			)
		);
		echo $this->fetch('script');
		echo $this->Js->writeBuffer(); // note: write cached scripts 
		?>
		<script>
			$(function() {
				$.datepicker.setDefaults( $.datepicker.regional[""] );
				$(".datepicker").datepicker( $.datepicker.regional["pt-BR"] );
			});
		</script>
		<!-- end Scripts -->
	</body>
</html>