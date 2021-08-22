
<?php include 'include/header.php'; ?>
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<?php
$anasayfa = $conn->prepare("SELECT *FROM anasayfa WHERE id=:id");
$anasayfa->execute(["id"=>1]);
$row=$anasayfa->fetch(PDO::FETCH_OBJ);

?>
<!-- Main content -->
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
                         <input type="text" name="baslik" placeholder="Başlığı giriniz" class="form-control">
                     </div>
                     <div class="form-group">
                         <label for="">Resim</label>
                         <input type="file" name="resim" >
                     </div>
                     <div class="form-group">
                         <label for="">Açıklma</label>
                         <input type="text" name="aciklama" placeholder="Açıklamayı giriniz" class="form-control">
                     </div>
                     <div class="form-group">
                       <button type="submit" class="btn btn-primary">Ekle</button>
                     </div>
                 </form>
             </div>
         </div>
        </div>
    </div>

</section>

<section class="content">
    <div class="col-md-12">
        <div class="row">
         <div class="box">
             <div class="box-header">
              Çalışmalarım
             </div>
             <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th>
                </thead>
                <tbody>
                    <?php
                        $calismalar=$conn->query("SELECT * FROM calismalar")->fetchAll(PDO::FETCH_OBJ);
                        foreach($calismalar as $row){
                    ?>
                    <tr>
                        <td><?= $row->id?></td>
                        <td><?= $row->baslik?></td>
                        <td><?= $row->aciklama?></td>
                        <td>
                            <a href="guncelle.php?id=<?= $row->id?>" ><i class="fa fa-edit text-primary"></i></a>
                            <a href="?sil=<?= $row->id?>" ><i class="fa fa-trash text-danger"></i></a>
                            
                        </td>
                    </tr>
                        
                   <?php
                        }
                    ?>
                </tbody>
            </table>
             </div>
         </div>
        </div>
    </div>

</section>
<?php


if(@$_GET["sil"]){
    $sil=$conn->prepare("DELETE FROM calismalar WHERE id=:silinecekid");
    $sil->execute([
        "silinecekid"=>$_GET["sil"]
    ]);

    if($sil){
        header("location:calismalar.php");
    }
}

if($_POST){
    $resimAdi=$_FILES["resim"]["name"];
    $resimYolu="C:/xampp/htdocs/portfolio/admin/assets/uploads/".$resimAdi;



    if(move_uploaded_file($_FILES["resim"]["tmp_name"],$resimYolu)){
        $ekle=$conn->prepare("INSERT INTO calismalar SET
           baslik =:baslik,
           resim =:resim,
           aciklama =:aciklama");

           $ekle->execute([
               "baslik"=>$_POST["baslik"],
               "resim"=>$resimAdi,
               "aciklama"=>$_POST["aciklama"]
           ]);


           if($ekle){
               echo "Ekleme Başarılı";
           }else{
               echo "Bir Hata Oluştu";
           }
    }
}


?>

<?php include 'include/footer.php'; ?>
