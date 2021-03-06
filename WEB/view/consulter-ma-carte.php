<?php 
include "../controllers/client.php" ;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">

   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   

	<link rel="stylesheet" href="../back-office_/css/sb-admin-2.css">
    <link rel="stylesheet" href="../css/consulter-ma-carte.css">

   <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/UserAccount.css">
    <link rel="stylesheet" href="../css/user_footer.css"> 
  


    <title>Consulter ma carte </title>
</head>
<body>
<?php require("navbar.php"); ?>
<br><br>


<div class="container__">
	<div class="main-body">
		<div class="row">
			<?php require("menu.php") ?>
            <div class="col">

            <h2>Consulter ma carte</h2>

                <div id="toPDF" class=" card_">

                    <div class="left-side-card ">
                        <div class="loyalty-card">
                            <img src="../images/loyaltycard_logo.png" alt="" height="50px" width="10px">
                            <h1 class="font">Loyalty Card</h1>
                        </div>
                        <div class="nom font">
                            <h2><?php echo $user['nom']." ".$user['prenom'] ;  ?></h2>
                        </div>
                        <div class="num-de-carte font">
                            <?php echo $user['num_carte'] ; ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <img  src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive" />
                    </div>
                    
                </div>
                <div class="container-fluid">
                    <div class="form-horizontal">
                        <div class="form-group">
                          
                            <div  class="col-sm-10">
                            <h2 style="position:relative; left:45%;" id="content"><?php echo $user['num_carte'] ?></h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">

                                <!-- Button to generate QR Code for
                                the entered data -->
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="buttons">
                    <button style="margin-left: 30%;" id="getPDFf" type="button" class="btn btn-info" > Telecharger ma carte </button>
                </div>
                <!--<div id="editor"></div> -->
            </div>	
				
		</div>
	</div>
	
</div>

<?php require("footer.php"); ?>
<script src=
        "https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js">
</script>
<script>

    setUpDownloadPageAsImage();

    function setUpDownloadPageAsImage() {
        document.getElementById("getPDFf").addEventListener("click", function() {
            html2canvas(document.getElementById('toPDF')).then(function(canvas) {
                console.log(canvas);
                simulateDownloadImageClick(canvas.toDataURL(), 'LoayaltyCard.png');
            });
        });
    }

    function simulateDownloadImageClick(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download !== 'string') {
            window.open(uri);
        } else {
            link.href = uri;
            link.download = filename;
            accountForFirefox(clickLink, link);
        }
    }

    function clickLink(link) {
        link.click();
    }

    function accountForFirefox(click) { // wrapper function
        let link = arguments[1];
        document.body.appendChild(link);
        click(link);
        document.body.removeChild(link);
    }

</script>
