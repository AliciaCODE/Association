<?php // view/app/product/single.php ?>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>titre</th>
        <th>ref</th>
        <th>description</th>

        <th>created_at</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $product->id; ?></td>
            <td><?= $product->titre; ?></td>
            <td><?= $product->reference; ?></td>
            <td><?= $product->description; ?></td>
            <td><?= date('d/m/Y',strtotime($product->created_at)); ?></td>
        </tr>
    </tbody>
</table>
