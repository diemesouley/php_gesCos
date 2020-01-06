<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

  if(empty($errors)){

    $user = authenticate_v2($username, $password);

        if($user):
           //create session with id
           $session->login($user['id']);
           //Update Sign in time
           updateLastLogIn($user['id']);
           // redirect user to group home page by user level
           if($user['user_level'] === '1'):
             $session->msg("s", "Bonjour ".$user['username'].", Bienvenue dans GestCos Admin.");
             redirect('admin.php',false);
           elseif ($user['user_level'] === '2'):
              $session->msg("s", "Bonjour ".$user['username'].", Bienvenue dans GestCos UserSpecial.");
             redirect('special.php',false);
           else:
              $session->msg("s", "Bonjour ".$user['username'].", Bienvenue dans GestCos.");
             redirect('home.php',false);
           endif;

        else:
          $session->msg("d", "Désolé nom d'utilisateur ou mot de passe incorrect.");
          redirect('index.php',false);
        endif;

  } else {

     $session->msg("d", $errors);
     redirect('login_v2.php',false);
  }

?>
