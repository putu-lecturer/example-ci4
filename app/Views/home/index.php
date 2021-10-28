<?= $this->extend('layouts\default') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.css" />
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container mb-3 mt-3">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-success" href=<?= site_url('product/create') ?>>Add</a>
            </div>
        </div>
    </div>
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Buy Price</th>
                        <th>Quantity In Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $product) {
                    ?>
                        <tr>
                            <td><?= $product['productCode'] ?></td>
                            <td><?= $product['productName'] ?></td>
                            <td><?= $product['quantityInStock'] ?></td>
                            <td><?= $product['buyPrice'] ?></td>
                            <td>
                                <a href="<?= site_url('product/edit/'.$product['productCode']) ?>" class="btn btn-success">Edit</a>
                                <?= form_open('product/delete', array('style' => 'display: inline')) ?>
                                    <button type="submit" class="btn btn-danger" name="productCode" value="<?= $product['productCode'] ?>">Delete</button>
                                <?= form_close() ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('javascript') ?>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <?= $this->endSection() ?>