<?php // view/app/product/update.php ?>


<form action="" method="post">

    <?php echo $form->label('titre'); ?>
    <?php echo $form->input('titre',$product->titre); ?>
    <?php echo $form->error('titre'); ?>

    <?php echo $form->label('reference'); ?>
    <?php echo $form->input('reference',$product->reference); ?>
    <?php echo $form->error('reference'); ?>

    <?php echo $form->label('description'); ?>
    <?php echo $form->textarea('description',$product->description); ?>
    <?php echo $form->error('description'); ?>

    <?php echo $form->submit(); ?>

</form>

