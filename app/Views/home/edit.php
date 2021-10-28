<?= $this->extend('layouts\default') ?>

<?= $this->section('title') ?>
Edit
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
        <div class="row justify-content-sm-center">
            <div class="col-sm-4">
                <?php 
                    if(isset($validation)) {
                ?>
                    <div class="alert alert-danger mt-4" role="alert">
                       <?= $validation->listErrors() ?>
                    </div>
                <?php
                    }    
                ?>
                <?= form_open('product/edit/'.$data['productCode']) ?>
                <!-- <form action="doEdit.php" method="post"> -->
                    <div class="mb-3">
                        <label for="productCode" class="form-label">Product Code</label>
                        <input type="text" class="form-control" id="productCode" name="productCode" disabled value="<?= $data['productCode'] ?>">
                        <input type="hidden" name="productCode" value="<?= $data['productCode'] ?>">

                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" value="<?= $data['productName'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="quantityInStock" class="form-label">Quantity In Stock</label>
                        <input type="number" class="form-control" id="quantityInStock" name="quantityInStock" value="<?=  $data['quantityInStock'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="buyPrice" class="form-label">Buy Price</label>
                        <input type="number" step="0.01" class="form-control" id="buyPrice" name="buyPrice" value="<?= $data['buyPrice'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                <!-- </form> -->
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>