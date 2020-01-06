<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_id('user_groups',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Le groupe a été supprimé.");
      redirect('group.php');
  } else {
      $session->msg("d","Échec de la suppression du groupe ou PRM manquant.");
      redirect('group.php');
  }
?>
