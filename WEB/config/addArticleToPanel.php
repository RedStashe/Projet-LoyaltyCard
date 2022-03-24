<?php
session_start() ; 

include 'database.php' ; 

$clientId = $_SESSION['clientId'] ; 
$articleCode = $_GET['codeArticle'] ; 
$quantity = $_GET['quantity'] ; 

$sql = "SELECT * FROM Article WHERE codeArticle = ?"  ; 

$query = $con->prepare($sql) ; 

$query->execute([$articleCode]) ; 

$result = $query->fetch(PDO::FETCH_ASSOC) ; 

$articleName = $result['nom'] ; 
$saler = $result['vendeur'] ; 
$price = $result['prix'] ; 
$category = $result['catégorie'] ; 

$sql3 = "SELECT * FROM Panier WHERE article = ?" ; 

$existQuery = $con->prepare($sql3) ; 

$existQuery->execute([$articleName]) ;

$exist = $existQuery->fetch(PDO::FETCH_ASSOC) ; 

if (!empty($exist))   // verification si l'article est déja dans le panier
{
$existArticle = $exist['article'] ; 

if (!empty($existArticle))         // si oui in incrémente quantité
{
  $updateQuery = $con->prepare("UPDATE Panier SET quantité = quantité + 1 WHERE article = ?") ; 
  $updateQuery->execute([$existArticle]) ; 
}
}
else          // sinon on l'ajoute dans le panier
{
$insertQuery = $con->prepare("INSERT INTO Panier (client , article, prix , catégorie, quantité ) VALUES (? , ? , ? , ?,?)") ; 

$insertQuery->execute([
     $clientId , 
     $articleName ,
     $price , 
     $category,
     $quantity 

]) ; 

}




