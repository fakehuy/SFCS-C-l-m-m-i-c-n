<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php 
    $pd = new product();
    if(!isset($_GET['productid']) || $_GET['productid']==''){
        echo "<script>window.location ='productlist.php'</script>";
    }else{
        $id = $_GET['productid'];
    }
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){

        $updateProduce = $pd->update_produce($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">     
            <?php 
            if (isset($updateProduce)) {
                echo $updateProduce;
            }  
            $get_product_by_id = $pd->getProductById($id);
            if($get_product_by_id){
                while($result_product = $get_product_by_id->fetch_assoc()){


            ?>          
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value = "<?php echo $result_product['productName']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Chọn loại sản phẩm</option>
                            <?php 
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                              
                             ?>
                            <option
                            <?php if ($result['catId'] == $result_product['catId']){
                                echo 'selected';
                            } ?>
                                

                             value="<?php echo $result['catId'] ?>"> <?php echo $result['catName'] ?></option>



                            <?php 
                                    }
                                }
                             ?>   
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Miêu tả</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_product['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_product['image'] ?>" width=90><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Loại sản phẩm</option>
                            <?php 
                            if($result_product['type']==0){
                            ?>
                            <option value="1">Nổi bật</option>
                            <option selected value="0">Không nổi bật</
                            <?php 
                            }else {
                            ?>
                            <option selected value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</
                            <?php
                            }
                             ?> 
                                
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
            </table>
            <?php 
                }
            }
             ?>
            </form>
        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


