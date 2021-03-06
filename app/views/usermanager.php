<script type="text/javascript">


$( document ).ready(function() {
    


	$("#search_bar").keyup(function(){
		var q = $("#search_bar").val();
		var base_url = window.location.origin + window.location.pathname;
        var data = {
            "action": 'recent'
        };
        data = $(this).serialize() + "&" + $.param(data);
        $.ajax({

            type: "POST",
            dataType: "json",
            url: 'usermanager/search_user/'+q,//Relative or absolute path to response.php file
            data: data,
            success: function (data) {
            	
                if (data['json'][0]) {
                    $('#tab-window2').html("");
                    $('#tab-window3').html("");
                    for (var j = 0; j < data['json'].length; j++) {
                        $('#tab-window2').append(
                        	'<tr>\
                                <td>' + data['json'][j]['reg_number'] + '</td>\
                                <td>' + data['json'][j]['full_name'] + '</td>\
                                <td><a href="'+ base_url + '/ban_user/' + data['json'][j]['user_id'] + '">ban</a></td>\
                            </tr>');	
                    }                   
                }
                else{
                	$('#tab-window3').html("NO RESULTS");
                	$('#tab-window2').html("");
                }              
            }
        });
        return false;
    });
});

    

</script>

<style type="text/css">
	.panel-default{
		border: 0px;
		border-radius: 0px;
		-webkit-box-shadow: 0 0px 0px rgba(0,0,0,0);
		box-shadow: 0 0px 0px rgba(0,0,0,0);
	}

	.panel-heading {
		color: #FFF;
		background-color: #FFFFFF !important;
		border-color: none;
		border-bottom: none !important;}
</style>

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

<div class="container" style="height:100%;">



                <?php  if(isset($_SESSION['user_name']) and $_SESSION['user_type']=='user') {?>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav" >
                        <li>
                            <a href="<?php echo ASSET_PATH;?>/mytable"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo ASSET_PATH;?>/collections"><i class="fa fa-fw fa-table"></i> My Collections</a>
                        </li>
                        <li>
                            <a href="<?php echo ASSET_PATH;?>/main/browse"><i class="fa fa-fw fa-file"></i> Browse</a>
                        </li>
                        <li>
                            <a href="<?php echo ASSET_PATH;?>/search"><i class="fa fa-fw fa-search"></i> Advanced Search</a>
                        </li>
                        <li>
                            <a href="<?php echo ASSET_PATH;?>/uploads"><i class="fa fa-fw fa-upload"></i> Upload</a>
                        </li>                    
                        <li >
                            <a href="<?php echo ASSET_PATH;?>/settings"><i class="fa fa-fw fa-edit"></i> Settings</a>
                        </li>


                    </ul>
                </div>
                <?php } elseif(isset($_SESSION['user_name']) and $_SESSION['user_type']=='librarian'){?>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav side-nav">
                            <li>
                                <a href="<?php echo ASSET_PATH;?>/lpanel"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo ASSET_PATH;?>/usermanager"><i class="fa fa-fw fa-table"></i> User Manager</a>
                            </li>
                            <li>
                                <a href="<?php echo ASSET_PATH;?>/main/browse"><i class="fa fa-fw fa-file"></i> Browse</a>
                            </li>
                            <li>
                                <a href="<?php echo ASSET_PATH;?>/search"><i class="fa fa-fw fa-search"></i> Advanced Search</a>
                            </li>
                            <li>
                                <a href="<?php echo ASSET_PATH;?>/uploads"><i class="fa fa-fw fa-upload"></i> Upload</a>
                            </li>                    
                            <li >
                                <a href="<?php echo ASSET_PATH;?>/settings"><i class="fa fa-fw fa-edit"></i> Settings</a>
                            </li>
                        </ul>
                    </div> 
                <?php }?>



                    <div class="col-lg-12" style="text-align: center;">
                    <h1 class="page-header">User Manager
                        <small><?php echo $_SESSION['full_name'];?></small>
                    </h1>
                    </div>

<div class="row">

            <div class="col-md-4">
                
            </div>

            <div class="col-md-4">
                <input class="form-control" type="text" id="search_bar" placeholder="Search users"> 
            </div>

            <div class="col-md-4">   
            </div>


           </br></br></br>
</div>

<div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <h4>Current Users</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Reg Number</th>
                                <th>Full Name</th>
                                
                                    
                            </tr>
                        </thead>
                        <tbody id="tab-window2">
                                
                        <tbody>
                    </table>
                    <div id="tab-window3"></div>
                </div>
            </div>
        </div>
		
        <div class="col-md-6">
			<div class="panel panel-default">
                <div class="panel-heading">
                     <div class="form-group">
                        <h4>Banned Users</h4>
                    </div>
                    
                </div>
                
                <div class="panel-body">
                    
                    	<table class="table table-hover table-bordered">
                    		<thead>
                    			<tr>
                                    <th>Reg Number</th>
                                    <th>Full Name</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                        if(empty($data['banned_list'])){ echo "";}else{?>
                            <?php foreach($data['banned_list'] as $banned){ ?>      
                                
                                    <tr>
                                        <td><?php echo $banned['reg_number'];?></td>
                                        <td><?php echo $banned['full_name'];?></td>
                                        
                                        <td><a href="<?php echo ASSET_PATH;?>/usermanager/unban_user/<?php echo $banned['user_id']; ?>">Authorize</a></td>
                                    </tr>
                                <?php }}?>
                        	</tbody>
                        </table>
                </div>
            </div>
		</div>
        </div>



	</div>