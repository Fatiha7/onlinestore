<?php 
session_start();
if(! isset($_POST["envoi"])) $_POST["envoi"]=""; 
if(! isset($_SESSION['prixTotal'])) $_SESSION['prixTotal']=0; 
if(! isset($_SESSION['code'])) $_SESSION['code']=0;
if(! isset($_SESSION['article'])) $_SESSION['article']=""; 
if(! isset($_SESSION['prix'])) $_SESSION['prix']=0; 
if($_POST["envoi"]=="AJOUTER" && $_POST["code"]!="" && $_POST["article"]!="" && $_POST["prix"]!="") 
{
    $code=$_POST["code"];  
    $article= $_POST["article"]; 
    $prix= $_POST["prix"];
    $_SESSION['code']= $_SESSION['code']."//".$code;
    $_SESSION['article']= $_SESSION['article']."//".$article; 
    $_SESSION['prix']= $_SESSION['prix']."//".$prix; 
 } 
 if($_POST["envoi"]=="VERIFIER") 
{ 
  echo "<table border=\"1\">";
  echo "<tr><td colspan=\"3\"><b>Récapitulatif de votre commande</b></td>";
  echo "<tr><th>&nbsp;code&nbsp;</th><th>&nbsp;article&nbsp;</ th><th>&nbsp; ?prix&nbsp;</th>";
  $total=0; 
  $tab_code=explode("//",$_SESSION['code']);
  $tab_article=explode("//",$_SESSION['article']); 
  $tab_prix=explode("//",$_SESSION['prix']);
 for($i=1;$i<count($tab_code);$i++) 
 { echo "<tr><td>{$tab_code[$i]}</td><td>{$tab_article[$i]}</td><td> ?".sprintf("%01.2f", $tab_prix[$i])."</td>";
   $_SESSION['prixTotal']+=$tab_prix[$i];
 } 
  echo "<tr><td colspan=2> PRIX TOTAL </td><td>".sprintf("%01.2f", $_SESSION['prixTotal'])." ?</td>"; echo "</table>";
 }

if($_POST["envoi"]=="ENREGISTRER")
{
  $idfile=fopen("commande.txt",'w');
  $tab_code=explode("//",$_SESSION['code']);
  $tab_article=explode("//",$_SESSION['article']);
  $tab_prix=explode("//",$_SESSION['prix']); 
  for($i=0;$i<count($tab_code);$i++)
    fwrite($idfile, $tab_code[$i]." ; ".$tab_article[$i]." ; ".$tab_prix[$i].";\n");
  fclose($idfile); 
} 
 if($_POST["envoi"]=="LOGOUT") 
{ 
   session_unset(); 
   session_destroy(); 
   echo "<h3>La session est terminée</h3>";
}
 $_POST["envoi"]="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gestion de panier</title>
<style type="text/css">
	input {
		  width: 10%;
  padding: 12px 20px;
  margin:8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  position: relative;left:20px;
	}
	input[type=submit] {
  width: 10%;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
#panier {
	position: relative;left:400px;top:80px;
}
#saiser{
	position: relative;left:200px;
}
label {
	 	   font-variant: small-caps;
	 	   font-size: 120%;
}
legend {
	font-size: 120%;
}

body{
  background-color:gray;

}


 #input{
color:pink;
background-color:black;
 }
</style>
</head>
<body>
	<div id="panier">
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" ?enctype="application/x-www-form-urlencoded">
<legend ><b> reserve a article</b></legend>
 <div id="saiser">
   <label>code :</label><br>
     <input type="text" name="code" /><br><br>
   <label>article :</label><br> 
     <input type="text" name="article" /><br><br>
   <label>price :</label><br>
    <input type="text" name="prix" /><br><br>
</div >
          <input id="input" type="submit" name="envoi" value="add" />
          <input id="input" type="submit" name="envoi" value="verify" />
          <input id="input" type="submit" name="envoi" value="SAVE" />
          <input id="input" type="submit" name="envoi" value="LOGOUT" />

</form>
</div>




</body>
</html> 