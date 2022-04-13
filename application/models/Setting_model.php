<?php
Class Setting_model extends CI_Model
{
	
	
 function basicSetting()
 {
 // fetch basic loaders
 $query=$this->db->query(" select * from savsoftquiz_setting where setting_name != 'Sharethis_property_id' and setting_name != 'Advertisement_display_after_seconds' and setting_name != 'Advertisement_display_for_seconds' and setting_name != 'Android_API_key' and setting_name != 'Master_password' and setting_name != 'Enable_web_cam' and setting_name != 'Enable_sharethis' and setting_name != 'Language_direction' and setting_name != 'Enable_google_chart' and setting_name != 'Enable_user_registration' and setting_name != 'Enable_open_quiz' order by order_by asc");
 $set=$query->result_array();
 
 $setting=array();
	 foreach($set as $k => $val){
		$setting[$val['setting_group_name']][$val['setting_name']]=array($val['setting_value'],$val['setting_description']); 
		
		
	 }
	  
 return $setting;
	 
 }
  
 function settingTabs(){
	 
		$query=$this->db->query(" select count(setting_id) as setting_id, setting_group_name from savsoftquiz_setting  where setting_group_name != 'Payment_Gateway' group by setting_group_name");
		$set=$query->result_array();
		$setting=array();
		foreach($set as $k => $val){
		$setting[]=$val['setting_group_name']; 
		
		
		}
	  
 return $setting;
 }
 
 
 function updateSetting(){
	 $error=0;
	 	foreach($_POST as $k => $val){
			$this->db->where('setting_name',$k);
			if(!$this->db->update('savsoftquiz_setting',array('setting_value'=>$val))){
				$error+=1;
			}
		}
		if($error == 0 ){
			return true;
		}else{ return false; }
	 
 }
 
 
 
 

}












?>
