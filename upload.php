<?php
session_start();
include('server.php');

if($_POST['newprocate'] == 'ARAI') {
    $targetindir = "picture/product/arai/";

}

elseif($_POST['newprocate'] == 'AGV') {
    $targetindir = "picture/product/agv/";

}

elseif($_POST['newprocate'] == 'BILMOLA') {
    $targetindir = "picture/product/bilmola/";
    
}

elseif($_POST['newprocate'] == 'BRG') {
    $targetindir = "picture/product/brg/";

}

elseif($_POST['newprocate'] == 'KYT') {
    $targetindir = "picture/product/kyt/";

}

elseif($_POST['newprocate'] == 'SHARK') {
    $targetindir = "picture/product/shark/";
 
}

elseif($_POST['newprocate'] == 'SHOEI') {
    $targetindir = "picture/product/shoei/";

}

elseif($_POST['newprocate'] == 'X-LITE') {
    $targetindir = "picture/product/x-lite/";

}

$insertpic = "";
$inpicnames = array_filter($_FILES['pic']['name']);

if(isset($_POST['newpro'])){
    $allowtype = array('jpg','jpeg','png');
    foreach($_FILES['pic']['name'] as $key=>$val){
        $inpicnames= basename($_FILES['pic']['name'][$key]);
        $targetinpic = $targetindir.$inpicnames;

        $inpictype = pathinfo($targetinpic,PATHINFO_EXTENSION);
        if(in_array($inpictype, $allowtype)){
            if(move_uploaded_file($_FILES['pic']['tmp_name'][$key], $targetinpic)){
                
                $insertpic .= ",'$targetinpic'";
            }
        }
    }

    $newid = $_POST['newproid'];
    $newname = $_POST['newproname'];
    $newdesc = $_POST['newprodesc'];
    $newprc = (float)$_POST['newproprice'];
    $newqty = (int)$_POST['newproqty'];
    $newcate = $_POST['newprocate'];

    $sqlvalue = "("."'$newid',"."'$newname',"."'$newdesc',"."'$newcate',"."'$newqty',"."'$newprc'".$insertpic.")";
    $insertsql = "INSERT INTO product (proid,name,desc,brand,quantity,price,pic1,pic2,pic3,pic4) VALUES $sqlvalue";
    $db->exec($insertsql);        
    header('location:adminpage.php');
    }

?>