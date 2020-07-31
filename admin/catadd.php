<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php 
    $cat = new category();
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $catName = $_POST['catName'];

        $insertCat = $cat->insert_category($catName);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm danh mục mới</h2>
       <div class="block copyblock"> 
        <?php 
        if (isset($insertCat)) {
            echo $insertCat;
        }
         ?>
         <form action="catadd.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name='catName' placeholder="Tên danh mục..." class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>