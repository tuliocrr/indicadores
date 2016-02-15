<div class="row-fluid">
	<?php
		echo $this->Html->script(array('highcharts.js','modules/exporting.js', 'highcharts-more.js'));
	?>
	<div class="span">
		<div class="row-fluid application-graphs">
			<div class="span6">
				<div class="box-graph-w-numbers">
					<div class="graph-number">30</div>
					<div class="graph-number-desc">Produtos
						<!-- <span class="desc-arrow negative">-5% <span class="fa fa-caret-down"></span></span>-->
					</div>
					<div id="container3" class="graph" ></div>
					<div class="graph-number-desc">Produtos com margem maior 30%
						<span class="desc-arrow positive">10% <span class="fa fa-caret-up"></span></span>
					</div>	
				</div><!-- /.box-graph-w-numbers -->
			</div><!-- /.span6 -->
			<div class="span6">
				<div class="box-graph-w-numbers">
					<div class="graph-number">20</div>
					<div class="graph-number-desc">Produtos
						<!--  <span class="desc-arrow negative">-8% <span class="fa fa-caret-down"></span></span>-->
					</div>
					<div id="container4" class="graph"></div>
					<div class="graph-number-desc">Produtos com margem menor que 30%
						<span class="desc-arrow positive">30%<span class="fa fa-caret-up"></span></span>
					</div>
				</div><!-- /.box-graph-w-numbers -->
			</div><!-- /.span6 -->
		</div><!-- /.row-fluid -->
		<div class="row-fluid application-graphs">
			<div class="span6">
				<div id="container1" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
			</div><!-- /.span6 -->
			<div class="span6">
				<div id="container2" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
			</div><!-- /.span6 -->
		</div><!-- /.applications-graphs -->
	
		<div class="row-fluid application-boxes">
			
			<div class="span6">
				<div class="box box-border box-tasks">
					<div class="box-title">
						<h3 class="title"><span class="icon fa fa-tasks"></span> Últimos Produtos Atualizados</h3>
					</div>
					<div class="box-content">
						<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed table-tasks">
						<?php 
						
						foreach($produtos as $produto){	
							
							?>
							<tr>
								<td class="t-text"><?php echo $this->Html->link($produto["Produto"]['titulo'], array('controller' => 'Produto', 'action' => 'visualizar', $produto["Produto"]['id'])) ?></td>
							
								<td class="t-label" data-hide="phone,tablet">
								<?php
								$diff=10;
								if ($diff<0){
									echo '<span class="label label-important">Atrasada</span>';
								}elseif ($diff==0){
									echo '<span class="label label-warning">Hoje</span>';
								}elseif ($diff==1){
									echo '<span class="label label-info">Amanhã</span>';
								}elseif ($diff>1 and $diff<8){
									echo '<span class="label label-success">1 Semana</span>';
								}elseif ($diff>=8 and $diff<15){
									echo '<span class="label label-inverse">2 Semanas</span>';
								}elseif ($diff>=15){
									echo '<span class="label label-warning">+ 2 Semanas</span>';
								}
								?>
						
								
								</td>
						
							</tr>
							<?php } ?>
							
						</table>
					</div><!-- /.box-content -->
				</div><!-- /.box-tasks -->
			</div><!-- /.span6 -->
			<div class="span6">
				<div class="box box-border box-forum">
					<div class="box-title">
						<h3 class="title"><span class="icon fa fa-folder-open"></span> Projetos em andamento</h3>
					</div>
					
					<div class="box-content">
						<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
							<?php 
							/**
							* Leitura do array de projetos carregado com dados de projeto e atividades
							*/
							foreach($projetos as $id=>$projeto){?>
							<tr>
								<td>
								<?php 
								
								/**
								* Link para página do projeto
								*/
								echo $this->Html->link($projeto["titulo"], array('controller' => 'Projeto', 'action' => 'visualizar', $id));
								
								$corProjeto="";
								if ($projeto["saude_projeto"]=="2"){
										$corProjeto ="progress-danger";
								}elseif ($projeto["saude_projeto"]=="1"){
										$corProjeto ="progress-warning";
								}elseif ($projeto["saude_projeto"]=="0"){
										$corProjeto ="progress-success";
								}
								
								?>
									<div class="progress <?php echo $corProjeto ?> progress-striped">
										  <div class="bar" style="width: <?php echo number_format($projeto["andamento"],2,".",".")?>%;"><?php echo number_format($projeto["andamento"],2,",",".")?>%</div>
									</div>
								</td>
							</tr>
							<?php } ?>
							
						</table>
					</div><!-- /.box-content -->
				</div><!-- /.box-forum -->
			</div><!-- /.span6 -->

		</div><!-- /.application-boxes -->
	</div><!-- /.span9 -->

</div><!-- /.row-fluid -->

<script>
	
$(function () {
	
    $('#container3').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: '#f5f5f5',
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
			   spacingTop:0,
			   spacingLeft:0,
			   spacingRight:0,
			   spacingBottom:0,
			   
	        plotShadow: false
	    },
	     credits: {
      enabled: false
  },
	    title: {
	        text: ''
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       plotOptions: {
            series: {
                dataLabels: {
                    
                    enabled: false
                }
            }
        },
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 100,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 2,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 30,
	        tickWidth: 1,
	        tickPosition: 'inside',
	        tickLength: 4,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: ''
	        },
	        plotBands: [{
	            from: 50,
	            to: 100,
	            color: '#55BF3B' // green
	        }, {
	            from: 10,
	            to: 50,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 0,
	            to: 10,
	            color: '#DF5353' // red
	        }]        
	    },
		
	    series: [{
	        name: 'Percentual',
	        data: [20],
	        
	    }], navigation: {
            buttonOptions: {
                enabled: false
            }
        }
	
	}, 
	// Add some life
	function (chart) {
		
	});

	$('#container4').highcharts({
				
		    chart: {
		        type: 'gauge',
		        plotBackgroundColor: '#f5f5f5',
		        plotBackgroundImage: null,
		        plotBorderWidth: 0,
				   spacingTop:0,
				   spacingLeft:0,
				   spacingRight:0,
				   spacingBottom:0,
				   
		        plotShadow: false
		    },
		     credits: {
	      enabled: false
	  },
		    title: {
		        text: ''
		    },
		    
		    pane: {
		        startAngle: -150,
		        endAngle: 150,
		        background: [{
		            backgroundColor: {
		                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
		                stops: [
		                    [0, '#FFF'],
		                    [1, '#333']
		                ]
		            },
		            borderWidth: 0,
		            outerRadius: '109%'
		        }, {
		            backgroundColor: {
		                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
		                stops: [
		                    [0, '#333'],
		                    [1, '#FFF']
		                ]
		            },
		            borderWidth: 1,
		            outerRadius: '107%'
		        }, {
		            // default background
		        }, {
		            backgroundColor: '#DDD',
		            borderWidth: 0,
		            outerRadius: '105%',
		            innerRadius: '103%'
		        }]
		    },
		       
		    // the value axis
		    yAxis: {
		        min: 0,
		        max: 100,
		        
		        minorTickInterval: 'auto',
		        minorTickWidth: 1,
		        minorTickLength: 10,
		        minorTickPosition: 'inside',
		        minorTickColor: '#666',
		
		        tickPixelInterval: 30,
		        tickWidth: 2,
		        tickPosition: 'inside',
		        tickLength: 10,
		        tickColor: '#666',
		        labels: {
		            step: 2,
		            rotation: 'auto'
		        },
		        title: {
		            text: ''
		        },
		        plotBands: [{
		            from: 50,
		            to: 100,
		            color: '#55BF3B' // green
		        }, {
		            from: 10,
		            to: 50,
		            color: '#DDDF0D' // yellow
		        }, {
		            from: 0,
		            to: 10,
		            color: '#DF5353' // red
		        }]        
		    },
		
		    series: [{
		        name: '',
		        data: [30],
		        remove: true
		    }], navigation: {
	            buttonOptions: {
	                enabled: false
	            }
	        }
		
		}, 
		// Add some life
		function (chart) {
			
		});
$(function () {
    $('#container1').highcharts({
        title: {
            text: 'Margem dos 5 melhores produtos',
            x: -20 //center
        },
        subtitle: {
            text: 'Ano: 2016.com',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        },
        yAxis: {
            title: {
                text: 'Margem (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Saquê',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Hot Harumaki',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Hot Holl',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'Coca Cola',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
});
			    
			        // Create the chart
			        $('#container2').highcharts({
			        	  chart: {
			                  plotBackgroundColor: null,
			                  plotBorderWidth: null,
			                  plotShadow: false
			              },
			              title: {
			                  text: 'Status das atividades de todos os projetos'
			              },
			              tooltip: {
			          	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			              },
			              plotOptions: {
			                  pie: {
			                      allowPointSelect: true,
			                      cursor: 'pointer',
			                      dataLabels: {
			                          enabled: true,
			                          color: '#000000',
			                          connectorColor: '#000000',
			                          format: '<b>{point.name}</b>: {point.percentage:.1f} %'
			                      }
			                  }
			              },
			              series: [{
			                  type: 'pie',
			                  name: '% de Atividades',
			                  data: [
			                      ['Concluídas',  10],
			                      ['Aguardando outra pessoa',  2],
			                      ['Em andamento', 4],
			                      ['Não Iniciada', 3],
			                      ['Cancelada',2]
			                  ]
			              }]
			        });

});	

</script>