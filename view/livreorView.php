<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TI2 | Livre d'or</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/validation.css">
</head>
<body>
    <div id="title">
        <h1>Formulaire</h1>
    </div>
    <div id="photo">
        <img src="img/contact-7239360_640.jpg" alt="">
    </div>
    <form action="" method="POST" class="form" onsubmit="return check()">
        <h1>Laissez-nous un message</h1>
        <div id="leprenom">
            <label for="prenom">Prénom *</label>
            <input type="text" name="firstname" id="prenom" required>
        </div>
        <div id="lenom">
            <label for="nom">Nom</label>
            <input type="text" name="lastname" id="nom">
        </div>
        <div id="lusername">
            <label for="username">E-mail *</label>
            <input type="text" id="username" name="usermail">
        </div>
        <div id="lemessage">
            <label for="message">Message *</label>
            <textarea name="message" id="message" cols="30" rows="10" maxlength="600"></textarea>
        </div>
        <div>
            <p>(*) Ce champ est obligatoire</p>
        </div>
        <div id="envoi">
            <input type="submit" value="Envoyer">
        </div>
        <?php if(isset($message) && $insert){
            ?>
        <div id="insertmessage"> 
        <?php  echo $message;?></div>
        <?php
        }
        ?>
    </form>  
    <div>
        <?php
        if (isset($message) && !$insert) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $message; ?>
            </div>
            <?php
        }
        ?>
    </div> 
       
    <section id="informations"> 
        <h1>Messages Précédents</h1>
        <h2><?php if(empty($informations)) echo "Il n'y a pas de message" ?></h2>
        <h2>Il y a <?=$nbComments ?> message(s)</h2>
        <?php 
            foreach($informations as $information):
        ?>
        <div class="information">
            <div>                
                <p><?= (new DateTime($information["datemessage"]))->format('d/m/Y à H:i')?></p>
                <p><?= $information["firstname"] ?></p>
                <p><?= wordwrap($information["message"],20,"\n",true) ?></p>
            </div>
            
        </div>
        <?php
            endforeach;
        ?>
        <div id="pagination">
        <?php
        if(isset($pagination)) echo "$pagination"; 
        ?>
        </div>
    </section>
    
<script src="js/validation.js"></script>
</body>
</html>
