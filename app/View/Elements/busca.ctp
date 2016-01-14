<form method="post" class="well form-search">
	<div class="list-actions row-fluid">
		<!-- Filtros -->
		<div class="list-filters pull-left">
			<div class="with-select">
				<input name="busca" placeholder="O que você procura?" type="text">
				<select name="buscar_em" id="PerfilBuscarEm">
					<?php foreach($options as $key => $value){?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>
					<?php } ?>
				</select>
				<button type="submit" class="btn"><i class="icon-search fa fa-search"></i></button>
			</div>
			<div class="filters-tags">
				<?php
				if(isset($_SESSION['Search'][$this->params["controller"]])){
					if(count($_SESSION['Search'][$this->params["controller"]])>0){
					?>
					<h4 class="title">Filtrado por:</h4>
					<?php
						foreach($_SESSION['Search'][$this->params["controller"]] as $key => $temo_busca){
					?>
						<span class="type-tag"><?php echo $options[$temo_busca['buscar_em']]?>: <?php echo $temo_busca['busca']?><?php echo $this->Html->link("", array("controller"=>"principal","action" => "excluirfiltro", $this->params["controller"], $key), array("class" => "fa fa-times")); ?></span>
					<?php	
						}
					}
				}
				?>
			</div>
		</div>
		<!-- /.list-filters -->
			<div class="list-actions-buttons pull-right">
			<?php if($this->ControleDeAcesso->validaAcessoElemento('adicionar')){?>
			<a class="btn btn-small btn-primary" href="<?php echo $this->base . "/" . $this->params["controller"] . "/adicionar";?>"><i class="fa fa-plus-circle"></i>Adicionar</a>
			<?php }?>
		</div><!-- /.list-actions -->
		<!-- end Filtros -->
	</div>
</form>