<?php
// to do : verificartion de formulaire de l'ajout d'entreprise //

include "../models/entrepriseModel.php" ;

include_once "admin.php" ;

function valideDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


// ajout d'une entreprise //

if (isset($_POST['addNewEntreprise'])) {
    include "../config/password.php";
    /*
    if (empty($_POST['entreprise']) || empty($_POST['gérant']) || empty($_POST['création']) || empty($_POST['activité']) || empty($_POST['siret']) || empty($_POST['email']) || empty($_POST['num'])
        || empty($_POST['adress']) || empty($_POST['ville']) || empty($_POST['code_postal']) || empty($_POST['pays']) || empty($_POST['chif_affaire']) || empty($_POST['contrat'])) {
        $error = "Veuillez remplir tous les champs ";

    } else {*/
        $candidat['nom'] = htmlspecialchars($_POST['entreprise']);
        $candidat['gérant'] = htmlspecialchars($_POST['gérant']);
        $candidat['date_de_création'] = htmlspecialchars($_POST['création']);
        $candidat['activité'] = htmlspecialchars($_POST['activité']);
        $candidat['siret'] = htmlspecialchars($_POST['siret']);
        $candidat['email'] = htmlspecialchars($_POST['email']);
        $string = Password::generatePassword();

        $password = base64_encode(hash_hmac('sha256', $string, 'toto'));   /*hash du mot de pass */
        $candidat['mdp'] = $password;
        $candidat['numéro_tel'] = htmlspecialchars($_POST['num']);
        $candidat['adresse'] = htmlspecialchars($_POST['adress']);
        $candidat['ville'] = htmlspecialchars($_POST['ville']);
        $candidat['code_postal'] = htmlspecialchars($_POST['code_postal']);
        $candidat['pays'] = htmlspecialchars($_POST['pays']);
        $candidat['chiffre_daffaire'] = htmlspecialchars($_POST['chif_affaire']);
        $candidat['contrat'] = htmlspecialchars($_POST['contrat']);
        $candidat['date_de_payement'] = "";
/*
        if (!filter_var($candidat['email'] , FILTER_VALIDATE_EMAIL)) {$error = "email non valide" ;}
        elseif (!is_int((int)$candidat['numéro_tel']) || strlen($candidat['numéro_tel'] != 10)) {$error = "numéro de téléphone non valide" ;}
        elseif (!in_int((int)$candidat['code_postal'])) {$error = "adress postal non valide" ; }
        elseif (!is_int((int)$candidat['chiffre_daffaire'])) {$error = "chiffre d'affaire non valide" ;}
        elseif (!valideDate($candidat['date_de_création'] , "d/m/Y")) {$error = "date au format dd/mm/yyyy" ; }
        else
        {*/
            EntrepriseModel::insertEntreprise($candidat);


        $message = "<html>
    <p>Nous vous informant que votre candidature a été accepter vous trouvez au dessous votre mote de passe temporaire</p>
    <br>
    <p>nous vous recommendons de changer votre mot de passe aprés votre premier connexion</p>
    <p> votre nouveau mot de passe : <?php $password ?> </p>
    </html>";
        $headers = 'From: loyalty.card6@gmail.com' . "\r\n";

        mail($candidat['email'], "candidaure", $message);

        header('location:../back-office_/gestion_entreprise.php');

}



// le nombre des entreprise
    $companyCount = EntrepriseModel::count() ;

// séléctionne tous les entreprise enregistrer dans la base de donnée
$companys = EntrepriseModel::selectAll() ;

// supprimer une entreprise de la base de donnée
if (isset($_GET['removeCompany']) && !empty($_GET['removeCompany'])) 
{
    $id = $_GET['removeCompany'] ; 
        
    EntrepriseModel::deletWhere("id" , $id) ; 

    header('location:../back-office_/gestion_entreprise.php') ; 

    die() ; 
}

// affichage des information d'une entreprise en fonction de son id récupérer en GET
if (isset($_GET['id']))

{
    $company = EntrepriseModel::selectWhere("id" , $_GET['id']) ;

}
// Modification d'une entreprise
if (isset($_POST['updateEntreprise'])) {
    if (empty($_POST['email']) || empty($_POST['num']) || empty($_POST['date']) || empty($_POST['gérant']) || empty($_POST['chif_affaire']) || empty($_POST['contrat']))
    {
        $error = "Tous les champs doivent etre remplis" ;

    }
    else
    {    // récupération des donnée
        $updates['email'] = $_POST['email'];
        $updates['num'] = $_POST['num'];
        $updates['gérant'] = $_POST['gérant'];
        $updates['chif_affaire'] = (int)$_POST['chif_affaire'];
        $updates['contrat'] = (int)$_POST['contrat'];
        $updates['date'] = $_POST['date'];

        // vérification des erreur possible
        if (!filter_var($updates['email'], FILTER_VALIDATE_EMAIL)) {$error = "Email non valude";}
        elseif (strlen($updates['num']) != 10 || !is_int((int)$updates['num'])) { $error = "numéro de téléphone non valide";}
        elseif (!is_int($updates['chif_affaire'])) {$error = "chiffre d'affaire est une valeur numérique" ;}
        elseif (!is_int($updates['contrat'])) {$error = "la durée de contrat est une valeur numérique" ;}
        elseif (!valideDate($updates['date'] , "d/m/Y")) {$error = "date au format dd/mm/yyyy" ;}


        else{EntrepriseModel::updateWhere($updates , $company['id']) ;}   // update des donnée d'entreprise

    }

}

