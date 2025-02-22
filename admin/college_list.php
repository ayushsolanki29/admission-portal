<?php include "../php/configs/db.php";
session_start();
if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
    header("Location:login.php");
    exit();
}
if (isset($_GET['delete_product'])) {
    $pid = $_GET['pid'];
    $img = "../assets/img/products/" . $_GET['img'];
    $query_d = mysqli_query($con, "DELETE FROM `products` WHERE `id`='$pid'");
    if ($query_d) {
        $message = "Product Added!";
        unlink($img);
        header("location:products_list.php?success=$message");
        exit;
    }
}

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>Products Lists - steam-games.in</title>
    <?php include 'php/pages/head.php' ?>
</head>

<body id="page-top">

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div id="wrapper">
        <?php include 'php/pages/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <?php include 'php/pages/nav.php' ?>
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Products List</h1>
                    <p class="mb-4">All product list is here. you want <a target="_blank" href="products_add.php">add more ?</a></p>
                    <?php
                    if (isset($_GET['err'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['err'] ?>
                        </div>
                    <?php }
                    if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['success'] ?>
                        </div>
                    <?php }
                    ?>
                    <br>
                    <form action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="<?= isset($_GET['s']) ? $_GET['s'] : "" ?>" name="s" placeholder="Search By Product name | keywords" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <div class="input-group-append">
                                    <?php if (isset($_GET['s'])) { ?>
                                        <button class="btn btn-outline-danger" onclick="window.location.href = 'products_list.php'" type="button">Reset</button>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-primary" type="submit">search</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </form>
                    <form action="">
                        <div class="input-group">
                            <select class="custom-select" id="inputGroupSelect04" name="f">
                                <option selected>Choose option for filter</option>
                                <option value="newest">By Newest</option>
                                <option value="oldest">By Oldest</option>
                                <option value="views">By Views</option>
                                <option value="price_higher">By Price Higher</option>
                                <option value="price_lower">By Price Lower</option>
                                <option value="a_to_z">By A to Z</option>
                            </select>
                            <div class="input-group-append">
                                <?php if (isset($_GET['f'])) { ?>
                                    <button class="btn btn-outline-danger" onclick="window.location.href = 'products_list.php'" type="button">Reset</button>
                                <?php } else { ?>
                                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php $run = mysqli_fetch_assoc(mysqli_query($con,  "SELECT COUNT(*) AS `totalProducts` FROM `products`"));   ?>
                            <h6 class="m-0 font-weight-bold text-primary"><strong><?= $run['totalProducts'] ?> </strong>products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>title</th>
                                            <th>description</th>
                                            <th>price</th>
                                            <th>category</th>
                                            <th>keywords</th>
                                            <th>TwoFactor</th>
                                            <th>Images</th>
                                            <th>Date</th>
                                            <th>views</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $base_query = "SELECT `id`, `title`, `price`, `discount`, `description`, `thumbnail`, `category_id`, `keywords`, `twofactor`, `date`, `views` FROM `products`";

                                        if (isset($_GET['s'])) {
                                            $search_value = "%" . $_GET['s'] . "%";
                                            $base_query .= " WHERE `title` LIKE ? OR `keywords` LIKE ?";
                                        }

                                        if (isset($_GET['f'])) {
                                            switch ($_GET['f']) {
                                                case 'newest':
                                                    $base_query .= " ORDER BY `id` DESC";
                                                    break;
                                                case 'oldest':
                                                    $base_query .= " ORDER BY `id` ASC";
                                                    break;
                                                case 'views':
                                                    $base_query .= " ORDER BY `views` DESC";
                                                    break;
                                                case 'price_higher':
                                                    $base_query .= " ORDER BY `price` DESC";
                                                    break;
                                                case 'price_lower':
                                                    $base_query .= " ORDER BY `price` ASC";
                                                    break;
                                                case 'a_to_z':
                                                    $base_query .= " ORDER BY `title` ASC";
                                                    break;
                                                default:
                                                    break;
                                            }
                                        } else {
                                            $base_query .= " ORDER BY `id` DESC LIMIT 10";
                                        }

                                        $stmt = mysqli_prepare($con, $base_query);

                                        if (isset($_GET['s'])) {
                                            mysqli_stmt_bind_param($stmt, "ss", $search_value, $search_value);
                                        }

                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);
                                        mysqli_stmt_bind_result($stmt, $p_id, $p_title, $p_price, $p_discount, $p_description, $p_thumbnail, $p_category_id, $p_keywords, $p_twofactor, $p_date, $views);

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            while (mysqli_stmt_fetch($stmt)) {
                                                $discounted_price = $p_price * (1 - $p_discount / 100);
                                        ?>
                                                <tr>
                                                    <td style="cursor: pointer;" title="click to see thumbnail" onclick="window.location.href ='../assets/img/products/<?= htmlspecialchars($p_thumbnail) ?>' "><?= htmlspecialchars($p_title) ?></td>
                                                    <td title="<?= htmlspecialchars($p_description) ?>">Mouse Hover here</td>
                                                    <td><?= number_format($discounted_price, 2) ?>₹</td>
                                                    <td> <?php
                                                            $fetch_cat = mysqli_query($con, "SELECT `id`, `category_name` FROM `category` WHERE `id` IN ($p_category_id)");
                                                            while ($cat_n = mysqli_fetch_assoc($fetch_cat)) { ?>
                                                            <?= htmlspecialchars($cat_n['category_name']) ?> | 

                                                        <?php }
                                                        ?></td>
                                                    <td title="<?= htmlspecialchars($p_keywords) ?>">Mouse Hover here</td>
                                                    <td><?= $p_twofactor ? "Yes" : "No" ?></td>

                                                    <?php
                                                    // Fetch count of multiple images using another query (assuming it works correctly)
                                                    $query2 = "SELECT COUNT(*) AS `totalmultiple_images` FROM `multiple_images` WHERE `product_id` = ?";
                                                    $stmt2 = mysqli_prepare($con, $query2);
                                                    mysqli_stmt_bind_param($stmt2, "i", $p_id);
                                                    mysqli_stmt_execute($stmt2);
                                                    mysqli_stmt_bind_result($stmt2, $totalmultiple_images);
                                                    mysqli_stmt_fetch($stmt2);
                                                    mysqli_stmt_close($stmt2);
                                                    ?>

                                                    <td><?= $totalmultiple_images ?></td>
                                                    <td><?= htmlspecialchars($p_date) ?></td>
                                                    <td><?= htmlspecialchars($views) ?></td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#deleteModel<?= $p_id ?>" class="btn btn-danger btn-sm btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td> <a href="products_edit.php?p=<?= $p_id ?>" class="btn btn-primary btn-sm btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal for delete confirmation -->
                                                <div class="modal" id="deleteModel<?= $p_id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure want to delete <?= htmlspecialchars($p_title) ?>?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" onclick="window.location.href = 'products_list.php?delete_product=true&pid=<?= $p_id ?>&img=<?= htmlspecialchars($p_thumbnail) ?>'" class="btn btn-danger">Delete Now</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No Products Available</td></tr>";
                                        }


                                        ?>
                                    </tbody>

                                </table>
                                <div class="text-center">

                                    <button class="btn btn-primary btn-icon-split " id="loadMore">
                                        <input type="hidden" id="start" value="0">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-sync-alt"></i>
                                        </span>
                                        <span class="text">Load More</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="modals-container"></div>

            <?php include 'php/pages/footer.php' ?>
            <script>
                $(document).ready(function() {
                    $("#loadMore").click(function() {
                        let start = parseInt($("#start").val());
                        const perpage = 10;
                        start = start + perpage;
                        $("#start").val(start);

                        $.ajax({
                            url: "php/lib/get_product.php",
                            method: "POST",
                            dataType: "json",
                            data: {
                                starting: start
                            },
                            success: function(response) {
                                if (response.rows.trim() !== "") {
                                    $("#img_List").append(response.rows);
                                    $("#modals-container").append(response.modals);
                                } else {
                                    $("#loadMore").attr('disabled', 'disabled');
                                    $(".text").text("You've seen all");
                                }
                            }
                        });
                    });
                });
            </script>