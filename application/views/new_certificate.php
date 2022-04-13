<div class="container">

   
<h3>Upload <?php echo $title;?></h3>
  


 <div class="row">
    <!-- <form enctype="multipart/form-data" method="post" action="<?php echo site_url('certificate/insert_certificate/');?>"> -->
    <?php echo form_open_multipart('certificate/insert_certificate/');?>
   
<div class="col-md-8">
<br> 
<div class="login-panel panel panel-default">
    <div class="panel-body"> 

        <?php 
            if($this->session->flashdata('message')){
                echo $this->session->flashdata('message');	
            }
        ?>	

        <div class="form-group">	 
            <label   >Select User</label> 
            <select class="form-control" name="user">
                <option value="">- select -</option>
                <?php foreach($user_list as $k => $uval){ ?>
                    <option value="<?php echo $uval['uid'];?>"><?php echo $uval['first_name'].' '.$uval['last_name'].' ('.$uval['email'].')';?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group" id="nop" >	 
                <label for="inputEmail"  >Course</label> 
                <input type="text"   name="course"  class="form-control"   >
        </div>
        <div class="form-group" id="nop" >	 
                <label for="inputEmail"  >License Number</label> 
                <input type="text"   name="lno"  class="form-control" >
        </div>
        <div class="form-group" id="nop" >	 
                <label for="inputEmail"  >Session</label> 
                <input type="text"   name="session"  class="form-control">
        </div>
        <div class="form-group" id="nop" >	 
                <label for="inputEmail"  >Status</label> 
                <input type="text"   name="status"  class="form-control" >
        </div>
        <div class="form-group" id="nop" >	 
                <label for="inputEmail"  >Document ~ gif|jpg|png|pdf</label> 
                <input type="file"   name="file"  class="form-control" >
        </div>

        <button class="btn btn-default">Upload</button>

    </div>
</div>




</div>
     </form>
</div>





</div>
