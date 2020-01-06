<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $d_sale = find_by_id('sales',(int)$_GET['id']);

  if(!$d_sale){
    $session->msg("d","Identifiant de vente manquant.");
    redirect('sales.php');
  }
	// increase - add inventory back to stock
  if( increase_product_qty( $d_sale['qty'], $d_sale['product_id']) )
  {
  $delete_id = delete_by_id('sales',(int)$d_sale['id']);
}
  
  if($delete_id)
  {
      $session->msg("s","vente supprimée.");
      redirect('sales.php');
  } else {
      $session->msg("d","la suppression de la vente a échoué.");
      redirect('sales.php');
  }

?>