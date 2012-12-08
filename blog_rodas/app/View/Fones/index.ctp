<!-- <pre>
	<?php print_r($posts); ?>
</pre> -->
<div class="page-header">
	<h1>Listando as tabelas</h1>
</div>

<p>
	<i class="icon-plus-sign"></i>
	<?php echo $this->Html->link("Novo item", array('controller' => 'fones', 'action' => 'add'),
		array('class' => 'btn btn-success')); ?>
</p>


<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Tipo</th>
			<th>Criado</th>
			<th>Atualizado em</th>
		
		</tr>
	</thead>

	<tbody>
		<?php foreach ($fones as $fone): ?>
			<tr>
				<td><?php echo $fone["Fone"]["id"];?></td>
				<td><?php echo $fone["Fone"]["Marca"];?></td>
				<td><?php echo $fone["Fone"]["Modelo"];?></td>
				<td><?php echo $fone["Fone"]["tipo"];?></td>
				<td><?php echo $fone["Fone"]["created"];?></td>
				<td><?php echo $fone["Fone"]["modified"];?></td>
				<td>
					<a href="/post">Visualizar</a> 
					 <i class="icon-eye-open"></i>
					<?php echo $this->Html->link("Visualizar", array('controller' => 'fones', 'action' => 'view',
						 $fone["Fone"]["id"]),array('class' => 'btn'));?>
				</td>
        		<td>
        			<i class="icon-edit"></i>
        			<?php echo $this->Html->link('Editar', array('controller' => 'fones', 'action' => 'edit',
						 $fone["Fone"]["id"]), array('class' => 'btn btn-info'));?>
				</td>
				<td>
					<a class="btn btn-danger" href="#"><i class="icon-trash"></i>Remover</a>
					
						<?php echo $this->Form->postLink(
	            'Delete',
	            array('action' => 'delete', $fone['Fone']['id']),
	            array('confirm' => 'Voce deseja mesmo excluir?'));
        			?>
        		</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

