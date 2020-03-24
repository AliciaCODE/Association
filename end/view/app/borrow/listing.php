<?php // view/app/borrow/listing.php ?>

<form action="" method="post">
    <?php echo $form->label('Abonné'); ?>
    <?php echo $form->select('id_abonne',$abonnes,'nom'); ?>
    <?php echo $form->error('id_abonne'); ?>


    <?php echo $form->label('Produit'); ?>
    <?php echo $form->select('id_product',$products,'titre'); ?>
    <?php echo $form->error('id_product'); ?>


    <?php echo $form->submit(); ?>

</form>


<a href="<?= $view->path('borrow_historique'); ?>">Historique</a>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Nom - prenom</th>
        <th>Titre produit</th>
        <th>date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($borrows as $borrow) { ?>
        <tr>
            <td><?= $borrow->id; ?></td>
            <td><?= $borrow->nom . ' ' . $borrow->prenom  ; ?></td>
            <td><?= $borrow->titre; ?></td>
            <td><?= date('d/m/Y',strtotime($borrow->date_start)); ?></td>
            <td>
                <a href="<?= $view->path('renduemprunt',array($borrow->id)); ?>">Rendu par abonné</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

