<?php

require "../init.php";

if (!$_SESSION['user']) return redirect('/include/auth/login.php');

$categories = getAll("select * from category order by id desc");
?>

<?php require "../include/header.php"; ?>

<div class="row mt-2">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div>Category > <small class="badge bg-primary">All</small></div>

                <div class="my-2">
                    <a href="<?= $root . "category/create.php"; ?>" class="btn btn-sm btn-outline-dark">Create Category</a>
                </div>

                <div class="my-2">
                    <?php showMsg(); ?>
                    <?php showError(); ?>
                </div>

                <table class="table">
                    <thead>
                        <?php if (count($categories)) { ?>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Action</th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php

                        if (count($categories)) { ?>

                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?= $category->name ?></td>
                                    <td><?= $category->slug ?></td>
                                    <td class="btn-group">
                                        <a onclick="return confirm('Are your sure want to delete it?')" href="<?= $root . "category/delete.php?action=delete&slug=$category->slug"; ?>" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <a href="<?= $root . "category/edit.php?action=edit&slug=$category->slug"; ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php } else { ?>
                            <div class="alert alert-warning mt-3">Empty Category</div>
                        <?php } ?>

                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-danger px-4 py-1 fs-5">
                        <i class="fa-solid fa-angles-down"></i>
                        <!-- create Paginate  -->
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>