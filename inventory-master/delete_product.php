<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","ID de produit manquant.");
    redirect('products.php');
  }
?>
<?php
  $delete_id = delete_by_id('products',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Produits supprimés.");
      redirect('products.php');
  } else {
      $session->msg("d","La suppression des produits a échoué.");
      redirect('products.php');
  }
?>
