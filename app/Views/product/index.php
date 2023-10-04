<?= $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row mt-3 align-items-center">
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb" class="bg-light p-3">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                                </ol>
                                </nav>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="/product/new" class="btn btn-outline-dark">New Product</a>
                        </div>

                        <div class="row mt-4">
                        <table class="table table-striped w-100" id="productTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Product Price</th>
                                    <th>Product Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><img src="<?=base_url('upload/' . $product['img']) ?>" alt="Product Image" width="250px" height="250px" style="object-fit: contain;"></td>
                                <td><?= $product['price']; ?></td>
                                <td><?= $product['stock']; ?></td>
                                <td>
                                    <div class="row">
                                    <div class="col-auto">
                                        <a href="/product/<?= $product['id']; ?>/edit" class="btn btn-outline-warning mr-2">Edit</a>
                                    </div>
                                    <div class="col-auto px-0">
                                        <form action="/product/<?= $product['id']; ?>" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                    </div>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </main>

<?= $this->endSection(); ?>