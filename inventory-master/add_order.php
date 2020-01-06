<?php
  $page_title = 'Tous les ordres';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_orders = find_all('orders');
  $order_id = last_id('orders');
  $new_order_id = $order_id['id'] + 1;

?>

<!--     *************************     -->

<?php
 if(isset($_POST['add_order'])){
   $customer = remove_junk($db->escape($_POST['customer']));
  $paymethod = remove_junk($db->escape($_POST['paymethod']));
  $notes = remove_junk($db->escape($_POST['notes']));
   $current_date    = make_date();
   if(empty($errors))
   {
      $sql  = "INSERT INTO orders (id,customer,paymethod,notes,date)";
      $sql .= " VALUES ('{$new_order_id}','{$customer}','{$paymethod}','{$notes}','{$current_date}')";
      if($db->query($sql))
      {
        $session->msg("s", "Commande ajoutée avec succès");
	 redirect( ( 'add_sale_to_order.php?id=' . $new_order_id ) , false);
      } else {
        $session->msg("d", "Désolé n'a pas pu insérer.");
	 redirect( 'add_order.php' , false);
      }
   } else {
     $session->msg("d", $errors);
	 redirect( 'add_order.php' , false);
   }
 }
/**
	print "<pre>";
	print_r($all_orders);
	print "</pre>\n";
**/

?>

<!--     *************************     -->

<?php include_once('layouts/header.php'); ?>


<div class="login-page">
    <div class="text-center">
<!--     *************************     -->
       <h2>Ajouter une commande</h3>
       <h3>#<?php echo $new_order_id;?></h3>
<!--     *************************     -->
     </div>
     <?php echo display_msg($msg); ?>

      <form method="post" action="" class="clearfix">
<!--     *************************     -->
        <div class="form-group">
        </div>

        <div class="form-group">
              <label for="name" class="control-label">Nom du client </label>
              <input type="text" class="form-control" name="customer" value="" placeholder="Nom Client">
        </div>

           <div class="form-group">
                    <select class="form-control" name="paymethod">
                      <option value="">Sélectionnez le mode de paiement</option>
                      <option value="Cash">En espèces</option>
                      <option value="Check">Chéque</option>
                      <option value="Credit">Credit</option>
                      <option value="Charge">Charge au compte</option>
                    </select>
           </div>

           <div class="form-group">
               <input type="text" class="form-control" name="notes" value="<?php echo remove_junk(ucfirst($order['notes']));?>" placeholder="Notes">
           </div>

<!--     *************************     -->
        <div class="form-group clearfix">
         <div class="pull-right">
                <button type="submit" name="add_order" class="btn btn-info">Ordre de départ</button>
        </div>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
