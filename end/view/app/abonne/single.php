<?php // view/app/abonne/single.php ?>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>prenom</th>
        <th>email</th>
        <th>age</th>
        <th>created_at</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $abonne->id; ?></td>
            <td><?= $abonne->nom; ?></td>
            <td><?= $abonne->prenom; ?></td>
            <td><?= $abonne->email; ?></td>
            <td><?= $abonne->age; ?></td>
            <td><?= date('d/m/Y',strtotime($abonne->created_at)); ?></td>
        </tr>
    </tbody>
</table>
