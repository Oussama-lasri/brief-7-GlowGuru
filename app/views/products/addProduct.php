<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/bootstrap/css/bootstrap.min.css">
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <div class="row justify-content-start g-2 container">
        <a href="<?php echo URLROOT; ?>/Products/showProduct" type="button" class="col-1 btn btn-secondary mx-2 my-3 ">go back</a>
    </div>
    <div class="row" id="col">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-3 m-5">
                <h2>cree un produit</h2>
                <p>please enter tous les champs de formulaire</p>
                <form action="<?php echo URLROOT; ?>/products/addProduct" method="post">
                    <div class="form-group">
                        <!-- nom_produit -->
                        <label for="nom_produit">nom de produit : <sup>*</sup></label>
                        <input type="text" name="nom_produit" class="form-control form-control-lg <?php echo (!empty($data['nom_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['nom_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nom_produit_err']; ?></span>
                        <!-- PRIX DE PRODUIT -->
                        <label for="prix_produit" class="mt-3">prix de produit : <sup>*</sup></label>
                        <input type="number" name="prix_produit" class="form-control form-control-lg <?php echo (!empty($data['prix_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['prix_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['prix_produit_err']; ?></span>
                        <!-- image de produit -->
                        <label for="img_produit">image : <sup>*</sup></label>
                        <input type="file" name="img_produit" class="form-control form-control-lg <?php echo (!empty($data['img_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['img_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['img_produit_err']; ?></span>
                        <!-- description  -->
                        <label for="description" class="mt-3">description : <sup>*</sup></label>
                        <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : '' ?>"><?php echo $data['description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <input type="submit" value="ajouter" class="btn text-light btn-success ">
                        </div>
                        <div class="col">
                            <input type="submit" value="ajouter un nouveau produit" class="btn text-light btn-success ">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>