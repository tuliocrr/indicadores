<?php 
/**
 *
 * Copyright [2016] -  Civis Gestão Inteligente
 * Este arquivo é parte do programa Civis Estratégia
 * O civis estratégia é um software livre, você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF) na versão 2 da Licença.
 * Este programa é distribuído na esperança que possa ser  útil, mas SEM NENHUMA GARANTIA, sem uma garantia implícita de ADEQUAÇÃO a qualquer  MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/GPL em português para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "licença GPL.odt", junto com este programa. Se não encontrar,
 * Acesse o Portal do Software Público Brasileiro no endereço www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA 
 *
 */

// Carregamento das variáveis para controle de acesso.
$editar = $this->ControleDeAcesso->validaAcessoElemento('editar');
$excluir = $this->ControleDeAcesso->validaAcessoElemento('excluir');
?>
<div class="container">
	
	<h4><?php echo $title;?></h4>
	
	<div class="buttons">
		<?php
		if($editar){
		echo $this->Html->link(
					__("<i class='fa fa-edit'></i>Editar"),
					array('action' => 'editar', $registro['Perfil']['id']),
					array('class'=>'btn btn-small btn-primary pull-right', 'escape' => false)
				);
		echo "&nbsp;&nbsp;";
		}
		if($excluir){
			echo $this->Form->postLink(
					__("<i class='fa fa-trash'></i>Excluir"), 
					array('action' => 'excluir', $registro['Perfil']['id']), 
					array('class'=>'btn btn-small btn-primary pull-right', 'escape' => false),
					__("Deseja realmente excluir o registro?", $registro['Perfil']['id'])
				);
		}
		?>
	</div>
	
	<div class="row">
		<div class="span12">
			<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
				<tbody>
					<tr>
						<td><strong><?php echo __('Titulo'); ?></strong></td>
						<td><?php echo h($registro['Perfil']['titulo']); ?></td>
					</tr>
					<tr>
						<td colspan="2">
							<?php foreach($restricoes as $sessao => $listaPermissoes){?>
							<div class="span3">
			                	<div class="form-group">
									<h4><?php echo $sessao;?></h4>
									<ul>						
										<?php foreach($listaPermissoes as $nomePermissao => $item){?>
											<?php 
												echo "<li>";
												echo $nomePermissao;
												
												if(in_array($sessao.'.'.$nomePermissao, $permissoes)){
													echo " <img src='{$this->base}/img/test-pass-icon.png' width=12 />";
												}else{
													echo " <img src='{$this->base}/img/test-fail-icon.png' width=12 />";
												}
												
												echo "</li>";
											?>					
										<?php } ?>
									</ul>
								</div>
							</div>
							<?php }?>
						</td>
					</tr>
				</tbody>				
			</table>			
		</div>
	</div>
</div>