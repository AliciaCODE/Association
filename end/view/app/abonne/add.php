<?php // view/app/abonne/add.php ?>


<form action="" method="post">

    <?php echo $form->label('nom'); ?>
    <?php echo $form->input('nom'); ?>
    <?php echo $form->error('nom'); ?>

    <?php echo $form->label('prenom'); ?>
    <?php echo $form->input('prenom'); ?>
    <?php echo $form->error('prenom'); ?>

    <?php echo $form->label('email'); ?>
    <?php echo $form->input('email'); ?>
    <?php echo $form->error('email'); ?>

    <?php echo $form->label('age'); ?>
    <?php echo $form->input('age'); ?>
    <?php echo $form->error('age'); ?>

    <?php echo $form->submit(); ?>

</form>
