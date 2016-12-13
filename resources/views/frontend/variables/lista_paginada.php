<ul class="nav nav-list tree indice_variables">
	<?php foreach($variables as $variable){ ?>
        <li><a href="#" class="selector_variable" data-id="<?php echo $variable->id ?>" data-nombre="<?php echo $variable->nombre ?>"><?php echo $variable->nombre ?></a></li>
    <?php } ?>
</ul>
<div class="contenedor_paginacion">
<?php echo $variables->render() ?>
</div>