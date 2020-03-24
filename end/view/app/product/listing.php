<?php // view/app/product/listing.php ?>


<p>il y a <?= $count; ?> produits</p>
<a href="<?= $view->path('addproduit'); ?>">Ajouter un produit</a>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>titre</th>
        <th>ref</th>
        <th>description</th>
        <th>created_at</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($products as $product) { ?>
        <tr>
            <td><?= $product->id; ?></td>
            <td><?= $product->titre; ?></td>
            <td><?= $product->reference; ?></td>
            <td><?= $product->description; ?></td>
            <td><?= date('d/m/Y',strtotime($product->created_at)); ?></td>
            <td>
                <a href="<?= $view->path('detailproduit',array($product->id)); ?>">Voir</a>
                <a href="<?= $view->path('updateproduit',array($product->id)); ?>">Edit</a>
                <a href="<?= $view->path('deleteproduit',array($product->id)); ?>" onclick="return confirm('Voulez vous vraiment effacer ce produit ?');">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
