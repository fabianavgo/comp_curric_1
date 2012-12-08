<!-- <pre>
	<?php print_r($posts); ?>
</pre> -->
<div class="page-header">
	<h1>Listando as tabelas</h1>
</div>

<p>
	<i class="icon-plus-sign"></i>
	<?php echo $this->Html->link("Novo item", array('controller' => 'posts', 'action' => 'add'),
		array('class' => 'btn btn-success')); ?>
</p>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Título</th>
			<th>Texto</th>
			<th>Criado</th>
			<th>Atualizado em</th>
			<th colspan="3">Ações</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($posts as $post): ?>
			<tr>
				<td><?php echo $post["Post"]["id"];?></td>
				<td><?php echo $post["Post"]["title"];?></td>
				<td><?php echo $post["Post"]["body"];?></td>
				<td><?php echo $post["Post"]["created"];?></td>
				<td><?php echo $post["Post"]["modified"];?></td>
				<td>
					<!--<a href="/post">Visualizar</a> -->
					 <i class="icon-eye-open"></i>
					<?php echo $this->Html->link("Visualizar", array('controller' => 'posts', 'action' => 'view',
						 $post["Post"]["id"]),array('class' => 'btn'));?>
				</td>
        		<td>
        			<i class="icon-edit"></i>
        			<?php echo $this->Html->link('Editar', array('controller' => 'posts', 'action' => 'edit',
						 $post["Post"]["id"]), array('class' => 'btn btn-info'));?>
				</td>
				<td>
					<i class="icon-trash"></i>
					
					<?php echo $this->Form->postLink("Remover",
					array('controller' => 'posts', 'action' => 'delete',
					$post["Post"]["id"]),
					array('class' => 'btn btn-danger')); 
				?> 
        		</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

