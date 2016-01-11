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
		<title><?php echo $title_for_layout;?></title>
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
		    			<a href="<?php echo $this->base;?>/Aplicacao" class="header-logo-a" title="Civis Estratégia">
		    				<img src="<?php echo $this->base;?>/img/logo-civis-estrategia.png" alt="Civis Estratégia">
		    				<span class="visuallyhidden">Civis Estratégia</span>
		    			</a>
		    		</span>
		    		<div class="topo-usuario clearfix">
		    			<p class="topo-usuario-login">
		    				<em class="descricao">Departamento:</em>
		    				<strong class="titulo cor-destaque login-titulo"><?php echo "Departamento";?></strong>
		    			</p>
		    			<div class="topo-usuario-bloco clearfix">
		    				<img src="" alt="" height="56"/>
		    				<div class="texto">
		    					<strong class="nome">Fulano da Silva</strong>
								<br />Grupo
		    					<div class="links">
		    						<?php echo $this->Html->link("Alterar Dados", array("controller"=>"usuario","action"=>"alterardados"));?>	
		    						<span class="separador"> | </span>
		    						<?php echo $this->Html->link("Sair", array("controller"=>"autenticacao","action"=>"logout"));?>		
		    					</div>
		    				</div>
		    			</div><!-- fim .topo-usuario-bloco -->
		    		</div><!-- fim .topo-usuario -->
		        </div><!-- /#header-content -->
		    </header><!-- /#header -->
		    
			<div class="navbar navbar-static-top" style="position:relative; !important;">
				<div class="navbar-inner">
					<div class="container">
				    	<button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				      	</button>
						<div class="nav-collapse collapse" style="height: 0px;">
				        	<ul class="nav">
				          		<li class="">
				            		<a href="<?php echo $this->base;?>/Aplicacao">Home</a>
				          		</li>
				          		<li class="dropdown">
					          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						          		Comunicação<b class="caret"></b>
							  		</a>
								  	<ul class="dropdown-menu">
										<li><?php echo $this->Html->link(__('Reuniões'), array('controller' => 'Reuniao','action' => 'index'));?></li>
										<li><?php echo $this->Html->link(__('Tarefas'), array('controller' => 'Tarefa','action' => 'index'));?></li>
										<li><?php echo $this->Html->link(__('Marcadores'), array('controller' => 'Marcador','action' => 'index'));?></li>
										<li><?php echo $this->Html->link(__('Procedimentos'), array('controller' => 'Procedimento','action' => 'index'));?></li>
								  	</ul>
				          		</li>
						  		<li class="dropdown">
				            		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				            		Cadastros<b class="caret"></b>
						    		</a>
						    		<ul class="dropdown-menu">
								    	<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'Usuario','action' => 'index'));?></li>
								      	<li><?php echo $this->Html->link(__('Empresas'), array('controller' => 'Empresa','action' => 'index'));?></li>
								      	<li><?php echo $this->Html->link(__('Grupos'), array('controller' => 'Grupo','action' => 'index'));?></li>
								      	<li><?php echo $this->Html->link(__('Cargos'), array('controller' => 'Cargo','action' => 'index'));?></li>
								      	<li><?php echo $this->Html->link(__('Vinculos'), array('controller' => 'Vinculo','action' => 'index'));?></li>
								      	<li><?php echo $this->Html->link(__('Setores'), array('controller' => 'Setor','action' => 'index'));?></li>
								      	<li><?php echo $this->Html->link(__('Departamentos'), array('controller' => 'Departamento','action' => 'index'));?></li>
						    		</ul>
				          		</li>
				          		<li class="dropdown">
				            		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				            			Gestão Estratégica<b class="caret"></b>
						    		</a>
						    		<ul class="dropdown-menu">
						     			<li><?php echo $this->Html->link(__('Dimensões'), array('controller' => 'dimensao','action' => 'index'));?></li>
						      			<li><?php echo $this->Html->link(__('Objetivos'), array('controller' => 'objetivo','action' => 'index'));?></li>
							  			<li><?php echo $this->Html->link(__('Indicadores'), array('controller' => 'indicador','action' => 'index'));?></li>
							  			<li><?php echo $this->Html->link(__('Ações Estratégicas'), array('controller' => 'AcaoEstrategica','action' => 'index'));?></li>
							  			<li><?php echo $this->Html->link(__('Revisão das Ações'), array('controller' => 'AcaoEstrategica','action' => 'indice_revisao'));?></li>
							  			<li><?php echo $this->Html->link(__('Painel Geral de Ações'), array('controller' => 'AcaoEstrategica','action' => 'painel_acoes'));?></li>
						      			<li><?php echo $this->Html->link(__('Atividades'), array('controller' => 'atividade','action' => 'index'));?></li>
						      			<li><?php echo $this->Html->link(__('Faixas'), array('controller' => 'faixa','action' => 'index'));?></li>
						      			<li><?php echo $this->Html->link(__('Anomalia'), array('controller' => 'anomalia','action' => 'index'));?></li>
						    		</ul>
				          		</li>
								<li class="dropdown">
				            		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				            			Gestão de Portfólio<b class="caret"></b>
						    		</a>			
						    		<ul class="dropdown-menu">
										<li><?php echo $this->Html->link(__('Projetos'), array('controller' => 'Projeto','action' => 'index'));?></li>
										<li><?php echo $this->Html->link(__('Programas'), array('controller' => 'Programa','action' => 'index'));?></li>
									</ul>
						  		</li>
								<li><?php echo $this->Html->link(__('Mapa estratégico'), array('controller' => 'MapaEstrategico','action' => 'index'));?></li>
				          		<li><?php echo $this->Html->link(__('Organograma'), array('controller' => 'Organograma','action' => 'index'));?></li>
				        	</ul>
						</div>
					</div>
				</div><!-- /.navbar-inner -->
			</div><!-- /.navbar -->
			
			<div class="wrapper-content">
				<div class="content container">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>	<!-- /.content -->
			</div><!-- /.wrapper -->
	
			<footer class="footer">
				<div class="footer-bg">
					<div class="footer-content container clearfix"></div>
				</div>
			</footer><!-- /.footer -->
	
		</div><!-- /#wrapper -->
	
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