<?php // view/app/abonne/listing.php ?>


<p>il y a <?= $count; ?> abonnés</p>
<a href="<?= $view->path('addabonne'); ?>">Ajouter un abonné</a>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>prenom</th>
        <th>email</th>
        <th>age</th>
        <th>created_at</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($abonnes as $abonne) { ?>
        <tr>
            <td><?= $abonne->id; ?></td>
            <td><?= $abonne->nom; ?></td>
            <td><?= $abonne->prenom; ?></td>
            <td><?= $abonne->email; ?></td>
            <td><?= $abonne->age; ?></td>
            <td><?= date('d/m/Y',strtotime($abonne->created_at)); ?></td>
            <td>
                <a href="<?= $view->path('detailabonne',array($abonne->id)); ?>">Voir</a>
                <a href="<?= $view->path('updateabonne',array($abonne->id)); ?>">Edit</a>
                <a href="<?= $view->path('deleteabonne',array($abonne->id)); ?>" onclick="return confirm('Voulez vous vraiment effacer cet abonne ?');">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
