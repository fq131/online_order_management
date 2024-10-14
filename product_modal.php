<!-- Edit Product -->
<div class="modal fade" id="edit_product<?php echo $row['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin:0px;"></button>
                <h4 class="modal-title fs-5" id="myModalLabel">Edit Product</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="edit_product.php?product=<?php echo $row['product_id']; ?>" enctype="multipart/form-data">

                    <!--Product Name-->
                    <div class="form-group">
                        <div class="row">
                            <div class="mb-3">
                                <label class="control-label">Product Name:</label>
                                <input type="text" class="form-control" value="<?php echo $row['product_name']; ?>" name="product_name">
                            </div>
                        </div>
                    </div>

                    <!--Product Category-->
                    <div class="form-group">
                        <div class="row">
                            <div class="mb-3">
                                <label class="control-label">Category:</label>
                                <select class="form-select" name="category" aria-label="Default select example">
                                    <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                                    <?php
                                        // Get the current value for category for the product
                                        $cat_query="select * from category where category_id != '".$row['category_id']."'";
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
                                <input class="form-control" type="number" value="<?php echo $row['price']; ?>" name="price" aria-label="Amount (to the nearest dollar)" required>
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
                <button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Delete Product -->
<div class="modal fade" id="delete_product<?php echo $row['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin:0px;"></button>
                <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
            </div>

            <!--Get the name of the product-->
            <div class="modal-body">
                <h3 class="text-center"><?php echo $row['product_name']; ?></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
                <a href="delete_product.php?product=<?php echo $row['product_id']; ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Delete</a>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>