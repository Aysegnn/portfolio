
<?php include 'include/header.php'; ?>
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<?php
$calismaDetay = $conn->prepare("SELECT *FROM calismalar WHERE id=:idd");
$calismaDetay->execute(["idd"=>$_GET["id"]]);
$row=$calismaDetay->fetch(PDO::FETCH_OBJ);
?>
<section class="content">
    <div class="col-md-12">
        <div class="row">
         <div class="box">
             <div class="box-header">
                 Çalışmalar Ekleme Sayfası
             </div>
             <div class="box-body">
                 <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                         <label for="">Başlık</label>
                         <input type="text" name="baslik" placeholder="Başlığı giriniz" class="form-control" value="<?= $row->baslik?>">
                     </div>
                     <div class="form-group">
                         <label for="">Resim</label>
                         <input type="file" name="resim" >
                     </div>
                     <div class="form-group">
                         <label for="">Açıklma</label>
                         <input type="text" name="aciklama" placeholder="Açıklamayı giriniz" class="form-control" value="<?= $row->aciklama?>">
                     </div>
                     <div class="form-group">
                       <button type="submit" class="btn btn-primary">Güncelle</button>
                     </div>
                 </form>
             </div>
         </div>
        </div>
    </div>

</section>

<?php


if($_POST){
    if($_FILES["resim"]["name"]){
        $resimAdi=$_FILES["resim"]["name"];
    $resimYolu="C:/xampp/htdocs/portfolio/admin/assets/uploads/".$resimAdi;



    if(move_uploaded_file($_FILES["resim"]["tmp_name"],$resimYolu)){
        $ekle=$conn->prepare("UPDATE calismalar SET
           baslik =:baslik,
           resim =:resim,
           aciklama =:aciklama,
          WHERE id=:id");

           $ekle->execute([
               "baslik"=>$_POST["baslik"],
               "resim"=>$resimAdi,
               "aciklama"=>$_POST["aciklama"],
               "id"=>$_GET["id"]
           ]);


           if($ekle){
               echo "Güncelleme Başarılı";
           }else{
               echo "Bir Hata Oluştu";
           }
    }
    }else{
        $ekle=$conn->prepare("UPDATE calismalar SET
        baslik =:baslik,
        aciklama =:aciklama,
        WHERE id=:id ");

        $ekle->execute([
            'baslik'=>$_POST['baslik'],
            'aciklama'=>$_POST['aciklama'],
            'id'=>$_GET['id']
        ]);


        if($ekle){
            echo "Güncelleme Başarılı";
        }else{
            echo "Bir Hata Oluştu";
        }
    }
}


?>

<?php include 'include/footer.php'; ?>
