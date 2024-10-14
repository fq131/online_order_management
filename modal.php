<!-- Modal for Add Product -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin:0px;"></button>
                <h4 class="modal-title fs-5" id="myModalLabel">Add New Product</h4>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="add_product.php" enctype="multipart/form-data">

                    <!--Product Name-->
                    <div class="form-group">
                        <div class="row">
                            <div class="mb-3">
                                <label class="control-label">Product Name:</label>
                                <input type="text" class="form-control" name="product_name" required>
                            </div>
                        </div>
                    </div>

                    <!--Product Category-->
                    <div class="form-group">
                        <div class="row">
                            <div class="mb-3">
                                <label class="control-label">Category:</label>
                                <select class="form-select" name="category" aria-label="Default select example">
                                    <?php

                                        $cat_query="select * from category order by category_id asc";
                                        $cat_result = mysqli_query($con,$cat_query);
                                        while($cat_row = mysqli_fetch_assoc($cat_result)){
                                            ?>
                                            <option value="<?php echo $cat_row['category_id']; ?>"><?php echo $cat_row['category_name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--Product Price-->
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label">Price:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">RM</span>
                                <input class="form-control" type="number" name="price" aria-label="Amount (to the nearest dollar)" required>
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>

                    <!--Product Status-->
                    <div class="form-group">
                        <div class="row">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="active" value="Active" checked>
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                            </div>

                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="Inactive" >
                            <label class="form-check-label" for="inactive">
                                Inactive
                            </label>
                            </div>
                        </div>
                    </div>

                    <!--Product Photo-->
                    <div class="form-group">
                        <div class="row">
                            <div class="mb-3">
                                <label class="control-label">Photo:</label>
                                <input class="form-control" id="formFile" type="file" name="photo">
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
                <button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Save</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>