<!-- <pre>
	<?php print_r($posts); ?>
</pre> -->
<div class="page-header">
	<h1>Listando as tabelas</h1>
</div>

<p>
	<i class="icon-plus-sign"></i>
	<?php echo $this->Html->link("Novo item", array('controller' => 'rodas', 'action' => 'add'),
		array('class' => 'btn btn-success')); ?>
</p>


<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Marca</th>
			<th>Tipo</th>
			<th>Tamanho</th>
			<th>Criado</th>
			<th>Atualizado em</th>
		
		</tr>
	</thead>

	<tbody>
		<?php foreach ($rodas as $roda): ?>
			<tr>
				<td><?php echo $roda["Roda"]["id"];?></td>
				<td><?php echo $roda["Roda"]["Marca"];?></td>
				<td><?php echo $roda["Roda"]["Tipo"];?></td>
				<td><?php echo $roda["Roda"]["Tamanho"];?></td>
				<td><?php echo $roda["Roda"]["created"];?></td>
				<td><?php echo $roda["Roda"]["modified"];?></td>
				<td>
					<a href="/post">Visualizar</a> 
					 <i class="icon-eye-open"></i>
					<?php echo $this->Html->link("Visualizar", array('controller' => 'rodas', 'action' => 'view',
						 $roda["Roda"]["id"]),array('class' => 'btn'));?>
				</td>
        		<td>
        			<i class="icon-edit"></i>
        			<?php echo $this->Html->link('Editar', array('controller' => 'rodas', 'action' => 'edit',
						 $roda["Roda"]["id"]), array('class' => 'btn btn-info'));?>
				</td>
				<td>
					<a class="btn btn-danger" href="#"><i class="icon-trash"></i>Remover</a>
					
						<?php echo $this->Form->postLink(
	            'Delete',
	            array('action' => 'delete', $roda['Roda']['id']),
	            array('confirm' => 'Excluir?'));
        			?>
        		</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

