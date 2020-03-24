<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Nom - prenom</th>
        <th>Titre produit</th>
        <th>Date start</th>
        <th>Date rendu</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($borrows as $borrow) { ?>
        <tr>
            <td><?= $borrow->id; ?></td>
            <td><?= $borrow->nom . ' ' . $borrow->prenom  ; ?></td>
            <td><?= $borrow->titre; ?></td>
            <td><?= date('d/m/Y',strtotime($borrow->date_start)); ?></td>
            <td><?= date('d/m/Y',strtotime($borrow->date_end)); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
