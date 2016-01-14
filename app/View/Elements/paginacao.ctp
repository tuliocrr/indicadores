<div class="row">
	<div class="span6">
		<small>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Página {:page} de {:pages}, exibindo {:current} registro(s) de {:count} no total.')
			));
			?>
		</small>	
	</div>	
	<div class="span6">
			<div class="pagination pagination-mini pull-right" style="margin:0;">
			<ul>
			<?php
				echo $this->Paginator->prev(__('< anterior'), array(
					'escape'=>false,
					'tag'=>'li'
				), '<a onclick="return false;">' . '< anterior' . '</a>', 
				array('class'=>'disabled prev','escape'=>false,'tag'=>'li'));
				
				echo $this->Paginator->numbers(
					array(
						'separator' => '',
						'currentClass' => 'active',
						'currentTag' => 'a',
						'tag'=>'li'
					)
				);
				
				echo $this->Paginator->next(__('próxima >'), array(
					'escape'=>false,
					'tag'=>'li'
				), '<a onclick="return false;">' . 'próxima >' . '</a>', 
				array('class'=>'disabled next','escape'=>false,'tag'=>'li'));

			?>
			</ul>
			</div>
		</div>
</div>