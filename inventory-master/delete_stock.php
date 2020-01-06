<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $d_stock = find_by_id('stock',(int)$_GET['id']);

  if(!$d_stock){
    $session->msg("d","Identifiant de stock manquant.");
    redirect('stock.php');
  }

// for each sale
	// decrease inventory
  if( decrease_product_qty( $d_stock['quantity'], $d_stock['product_id']) )
  {
	
  $delete_id = delete_by_id('stock',(int)$d_stock['id']);
}
  
  if($delete_id)
  {
      $session->msg("s","stock supprimé.");
      redirect('stock.php');
  } else {
      $session->msg("d","la suppression du stock a échoué.");
      redirect('stock.php');
  }

?>
