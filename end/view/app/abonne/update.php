<?php // view/app/abonne/update.php ?>


<form action="" method="post">

    <?php echo $form->label('nom'); ?>
    <?php echo $form->input('nom',$abonne->nom); ?>
    <?php echo $form->error('nom'); ?>

    <?php echo $form->label('prenom'); ?>
    <?php echo $form->input('prenom',$abonne->prenom); ?>
    <?php echo $form->error('prenom'); ?>

    <?php echo $form->label('email'); ?>
    <?php echo $form->input('email',$abonne->email); ?>
    <?php echo $form->error('email'); ?>

    <?php echo $form->label('age'); ?>
    <?php echo $form->input('age',$abonne->age); ?>
    <?php echo $form->error('age'); ?>

    <?php echo $form->submit(); ?>

</form>

