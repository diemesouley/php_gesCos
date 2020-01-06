<?php
  $page_title = 'Edit category';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $category = find_by_id('categories',(int)$_GET['id']);
  if(!$category){
    $session->msg("d","Missing category id.");
    redirect('category.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('category-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['category-name']));
  if(empty($errors)){
        $sql = "UPDATE categories SET name='{$cat_name}'";
       $sql .= " WHERE id='{$category['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Catégorie mis à jour");
       redirect('categories.php',false);
     } else {
       $session->msg("d", "Excuse! échec de la mise");
       redirect('category.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('category.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($category['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_category.php?id=<?php echo (int)$category['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="category-name" value="<?php echo remove_junk(ucfirst($category['name']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Modifier</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>