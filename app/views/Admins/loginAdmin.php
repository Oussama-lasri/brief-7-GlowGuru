<?php include APPROOT.'/views/inc/header.php'; ?>

<div class="row" style="padding-top:120px ;">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5 m-5">
            <h2>Enter Your Account</h2>
            <p>please fill out this form to login</p>
            <form action="<?php echo URLROOT; ?>/Admins/loginAdmin" method="post">
                <div class="form-group">
                    

                    <label for="email">email : <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

                    <label for="password">password : <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>

                    
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <input type="submit" value="connect" class="btn btn-light btn-block">
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
<?php include APPROOT.'/views/inc/footer.php'; ?>