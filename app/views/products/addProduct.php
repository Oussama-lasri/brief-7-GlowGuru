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
                <form action="<?php echo URLROOT; ?>/products/addProduct" method="post" id="add_form">
                    <hr class="mt-4 mb-4">
                    <div class="form-group" id="show_item">
                        <h2>Produit :</h2>
                        <!-- nom_produit -->
                        <label for="nom_produit">nom de produit : <sup>*</sup></label>
                        <input type="text" name="nom_produit[]" class="form-control form-control-lg <?php echo (!empty($data['nom_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['nom_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nom_produit_err']; ?></span>
                        <!-- PRIX DE PRODUIT -->
                        <label for="prix_produit" class="mt-3">prix de produit : <sup>*</sup></label>
                        <input type="number" name="prix_produit[]" class="form-control form-control-lg <?php echo (!empty($data['prix_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['prix_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['prix_produit_err']; ?></span>
                        <!-- image de produit -->
                        <label for="img_produit">image : <sup>*</sup></label>
                        <input type="file" name="img_produit[]" class="form-control form-control-lg <?php echo (!empty($data['img_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['img_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['img_produit_err']; ?></span>
                        <!-- description  -->
                        <label for="description" class="mt-3">description : <sup>*</sup></label>
                        <textarea name="description[]" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : '' ?>"><?php echo $data['description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <input type="submit" value="ajouter" class="btn text-light btn-success" id="add_btn">
                        </div>
                        <div class="col">
                            <button class="btn text-light btn-success add_item_btn">ajouter un nouveau produit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add_item_btn").click(function(e) {
                e.preventDefault();
                // alert("hello");
                $("#show_item").prepend(`
                    <div class="form-group position-relative" id="show_item">
                    <h2>Produit ajouter :</h2>
                    <div class="row mt-3 mb-3 ">
                        <div class="">
                            <i class="btn text-light btn-danger remove_item_btn position-absolute top-0 end-0">X</i>
                        </div>
                    </div>
                        <!-- nom_produit -->
                        <label for="nom_produit">nom de produit : <sup>*</sup></label>
                        <input type="text" name="nom_produit[]" class="form-control form-control-lg <?php echo (!empty($data['nom_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['nom_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nom_produit_err']; ?></span>
                        <!-- PRIX DE PRODUIT -->
                        <label for="prix_produit" class="mt-3">prix de produit : <sup>*</sup></label>
                        <input type="number" name="prix_produit[]" class="form-control form-control-lg <?php echo (!empty($data['prix_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['prix_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['prix_produit_err']; ?></span>
                        <!-- image de produit -->
                        <label for="img_produit">image : <sup>*</sup></label>
                        <input type="file" name="img_produit[]" class="form-control form-control-lg <?php echo (!empty($data['img_produit_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['img_produit']; ?>">
                        <span class="invalid-feedback"><?php echo $data['img_produit_err']; ?></span>
                        <!-- description  -->
                        <label for="description" class="mt-3">description : <sup>*</sup></label>
                        <textarea name="description[]" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : '' ?>"><?php echo $data['description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                        <hr>
                    </div>`);
            });
            $(document).on('click', '.remove_item_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent().parent();
                $(row_item).remove();
            });

            // ajax request to insert all from data 
            $("#add_form").submit(function(e) {
                e.preventDefault();
                $("#add_btn").val('adding...');
                $.ajax({
                    url: '<?php echo URLROOT; ?>/products/addProduct',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#add_btn").val('success');
                        $("add_form")[0].reset();
                        // console.log(response);
                    }
                })
            });
        })
    </script>

</body>

</html>