<style type="text/css">


#pdf {
    width: 845px;
    height: 600px;
    margin: 2em auto;
   
}



#pdf object {
   display: block;
   border: solid 1px #666;
}


</style>



<script type="text/javascript">

window.onload = function (){

    var success = new PDFObject({ url: "<?php echo ASSET_PATH?>/home" }).embed("pdf");
    
};

</script>
<!-- Page Content -->
<?php define('ACCESS_ALLOWED', 1); ?>

<style>
     #con
    {
        background-image:url('<?php echo ASSET_PATH;?>/images/slider.jpg'); 
        background-size: cover;

        height:100%;
        width:100%;
    }
</style>

<div id="con">
<div class="container">

    <!-- Page Heading/Breadcrumbs -->


                    <div class="col-lg-12" style="text-align: center;">
                    <h1 class="page-header"><?php echo $data['item'][0]['name'];?>
                <small>by <?php echo $data['item'][0]['author'];?></small>
                    </h1>
                    </div>
    <!-- /.row -->

    <!-- Content Row -->

  <div class="row">


     
        <div class="col-md-3">
            <br><br>
            <ul><h4>Description</h4><br>
                <li>ISBN :</b><?php echo " ".$data['item'][0]['ISBN']?></li>
                <li>Uploaded date :</b><?php echo " ".$data['item'][0]['upload_date']?></li>
                    <li></b><?php echo " ".$data['item'][0]['description']?></li>
            </ul>
            <br>
            <ul><h4>Uploader Details</h4><br>
                    <li><b>Name :</b><?php echo " ".$data['user']['full_name']?></li>
                    <li><b>Registration number :</b><?php echo " ".$data['user']['reg_number']?></li>
            </ul>
            <?php if($_SESSION['user_id']==$data['item'][0]['uploader_id']){ ?>
            <p><a class="btn btn-primary" href="<?php echo ASSET_PATH;?>/mytable/review/<?php echo $data['item'][0]['material_id']?>">Update Material Details</a></p>
            <p><a class="btn btn-danger" href="<?php echo ASSET_PATH;?>/mytable/delete_material/<?php echo $data['item'][0]['material_id']?>">Delete Material</a></p>
               <?php } 
               elseif( $_SESSION['user_type']=='librarian'){
               ?>
               <p><a class="btn btn-primary" href="<?php echo ASSET_PATH;?>/lpanel/review/<?php echo $data['item'][0]['material_id']?>">Update Material Details</a></p>
               <?php }?>
        </div>

                
                 <div class="col-md-9">
                <div id="pdf">
                        <object data="" type="application/pdf" width="100%" height="600%"></object>
                </div>
                </div>
            

    </div>
    <!-- /.row -->





        </div>

   


    </div>
    <!-- /.row -->



