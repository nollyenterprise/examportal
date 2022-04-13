 <div class="container">
<?php 
$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];	 
			
			?>
   
 <h3><?php echo $title;?></h3>










  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		 
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('full_name');?></th>
 <th><?php echo $this->lang->line('certificate_license_no');?></th>
 <th><?php echo $this->lang->line('certificate_course');?></th>
 <th><?php echo $this->lang->line('certificate_status');?></th>
 <th><?php echo $this->lang->line('certificate_session');?></th>
<th><?php echo $this->lang->line('certificate_title');?> </th>
<?php
	$logged_in=$this->session->userdata('logged_in');
	$setting_p=explode(',',$logged_in['certificate_gen']);
	if(in_array('Remove',$setting_p)){
?>
<th> </th>
<?php
}
?>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="8"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}
// print_r($result);
foreach($result as $key => $val){
?>
<tr>
 <td>000<?php echo $val['cid'];?></td>
 <td><?php echo $val['wine'];?></td>
 <td><?php echo $val['licence_number'];?></td>
<td><?php echo $val['course'];?></td>
<td><?php echo $val['status'];?></td>
<td><?php echo $val['session'];?></td>
<td>
<a download target="_blank" href="../upload/<?php echo $val['file']; ?>" class="btn btn-success">Download</a>
</td> 
<?php 
	$logged_in=$this->session->userdata('logged_in');
	$setting_p=explode(',',$logged_in['certificate_gen']);
	if(in_array('Remove',$setting_p)){
?>
<td>
<a href="javascript:remove_entry('certificate/remove_certificate/<?php echo $val['cid'];?>');"><img src="<?php echo base_url();?>images/cross.png"></a>
</td>
<?php 
 }
 ?> 
</tr>
<?php 
}
?>
</table>

   

</div>

</div>
<br><br>

<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('certificate/index/'.$back.'/'.$list_view);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('certificate/index/'.$next.'/'.$list_view);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>





</div>