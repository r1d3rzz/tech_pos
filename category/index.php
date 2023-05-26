<?php

require "../init.php";

if (!$_SESSION['user']) return redirect('/include/auth/login.php');

$categories = getAll("select * from category order by id desc limit 2");

if (isset($_GET['page'])) {
    categoryPaginate(2);
    die();
}
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
                    <tbody id="tblData">
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

                <!-- category paginate  -->
                <div class="d-flex justify-content-center">
                    <button class="btn btn-danger px-4 py-1 fs-5" id="fetchBtn">
                        <i class="fa-solid fa-angles-down"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>

<script>
    $(function() {
        let page = 1;
        const tblData = $('#tblData');
        const fetchBtn = $('#fetchBtn');

        fetchBtn.click(function() {
            page++;
            $.get(`index.php?page=${page}`)
                .then((data) => {
                    const d = JSON.parse(data);
                    let htmlString = ``;

                    if (!d.length) return fetchBtn.attr('disabled', 'disabled');

                    d.map(function(d) {
                        htmlString += `
                        <tr>
                            <td>${d.name}</td>
                            <td>${d.slug}</td>
                            <td class="btn-group">
                                <a onclick="return confirm('Are your sure want to delete it?')" href="delete.php?action=delete&slug=${d.slug}" class="btn btn-sm btn-danger">
                                     <i class="fa-solid fa-trash"></i>
                                </a>
                                <a href="edit.php?action=edit&slug=${d.slug}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        `;
                    });

                    tblData.append(htmlString);
                });
        });
    });
</script>