<?php include APPROOT . '/views/inc/sidebare.php'; ?>


<div class="container-fluid px-4">
<h3 class="fs-4 mb-3">Products</h3>
<a href="<?php echo URLROOT; ?>/Products/addProduct" type="button" class="col-1 btn btn-success mx-2 my-3 ">Add</a>
    <div class="row my-5">
        <div class="col" id>
            <table class="table bg-white rounded shadow-sm  table-hover ">
                <thead>
                    <tr class="text-center">
                        <th class="col-lg-1">Id</th>
                        <th class="col-lg-2">date de création</th>
                        <th class="col-lg-1">nom</th>
                        <th class="col-lg-1">prix</th>
                        <th class="col-lg-1">image</th>
                        <th class="col-lg-3">description</th>
                        <th class="col-lg-4">action</th>
                    </tr>
                </thead>
                <tbody class="justify-content-center text-center">
                    <?php foreach ($data['products'] as $product) : ?>
                        <tr>
                            <th scope="row"><?php echo $product->id_produit ?></th>
                            <td><?php echo $product->nom_produit ?></td>
                            <td><?php echo $product->date_creation ?></td>
                            <td><?php echo $product->prix ?></td>
                            <td><?php echo $product->img_Produit ?></td>
                            <td><?php echo $product->description ?></td>
                            <td><button type="button" class="btn btn-danger mr-2">supprimer</button><button type="button" class="btn btn-primary">modifier</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<?php include APPROOT . '/views/inc/footerD.php'; ?>