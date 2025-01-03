<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);
        
    }

    function GetGenderById($userId)
    {
		return $this->otherdb->select('GENDER')
                    ->where('userId',$userId)
                    ->get('TBL_USERS')
                    ->result();
    } 
	
	function Getallotuserinfo($gender)
    {
		return $this->otherdb->select('REGNO')
                    ->where('GENDER', $gender)
                    ->get('TBL_ALLOTMENT')
                    ->result();
    }
	
	function Getreallotuserinfo($gender)
    {
		return $otherdb->select('REGNO')
                        ->where('GENDER', $gender)
                        ->get('TBL_REALLOTMENT')
                        ->result();
    }
	
	function Getallotreallotuserinfo($gender)
    {
		return $this->otherdb->select('REGNO')
                    ->where('GENDER', $gender)
                    ->get('tbl_allotreallot')
                    ->result();
    }
	
	function GetReallotVerify($gender)
    {
		return $this->otherdb->select('REGNO, SEMCODE')
                    ->where('GENDER', $gender)
                    ->where('ADMIN_VERIFY', 1)
                    ->get('tbl_reallotment')
                    ->result();
    }
	
	function Getbatch($regno)
    {
       return $this->db->select('BATCHNAME,PROGRAME')
                   ->where('REGNO', $regno)
                   ->get('TBL_HSTUDENTS')
                   ->result();
    }
	
	function UpdateAllots($userinfo, $regno)
    {
		$this->otherdb->where('REGNO', $regno)->update('tbl_allotment', $userinfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdateREAllots($userinfo, $regno)
    {
		$this->otherdb->where('REGNO', $regno)->update('tbl_reallotment', $userinfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function Updateallotreallot($userinfo, $regno)
    {
		$this->otherdb->where('REGNO', $regno)->update('tbl_allotreallot', $userinfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdateUserInfo($userInfo, $emailid)
    {
		$this->otherdb->where('userId', $emailid)->update('tbl_users', $userInfo);
        
        return $this->otherdb->affected_rows();
    }
    
   
    function GetSetting()
    {
		return $this->otherdb->get('TBL_SETTINGS')->result();
    }
	
	function UpdateExt($extInfo, $extid)
    {
		$this->otherdb->where('id', $extid)->update('tbl_ext', $extInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function GetdegreeByStdType($gender, $studenttype)
    {
		return $this->otherdb->where('gender', $gender)
                    ->where('studenttype', $studenttype)
                    ->get('tbl_degreelevel')
                    ->result();
    }
	
	function Getdegreeduration($gender, $programe, $studenttype)
    {
		return $this->otherdb->where('gender', $gender)
                    ->where('name', $programe)
                    ->where('studenttype', $studenttype)
                    ->get('tbl_degreelevel')
                    ->result();		
    }
	
	function GetExt($gender)
    {
		return $this->otherdb->select('id, studenttype, degreetittle, noofyear, gender, 1stext as firstext, 2ndext as secondext, updated_at')
                    ->where('gender', $gender)
                    ->get('tbl_ext')
                    ->result();		 
    }
	
	function GetExtbyId($gender, $id)
    {
		return $this->otherdb->select('id, studenttype, degreetittle, noofyear, gender, 1stext as firstext, 2ndext as secondext, updated_at')
                    ->where('gender', $gender)
                    ->where('id', $id)
                    ->get('tbl_ext')
                    ->result();		 
    }
	
	function Ext_exist($gender, $studenttype, $programe)
	{
		$query = $this->otherdb->where('gender',$gender)
                    ->where('studenttype',$studenttype)
                    ->where('degreetittle',$programe)
                    ->get('tbl_ext');

		return ($query->num_rows() > 0) ? true : false; 
	}
	
	function InsertExt($extInfo)
    {	
        $this->otherdb->insert('tbl_ext', $extInfo);
           
        return $this->otherdb->insert_id(); 
    }
	
	function InsertKey($userinfo)
    {	
        $this->otherdb->insert('tbl_key', $userinfo);
           
        return $this->otherdb->insert_id(); 
    }
    
	function distance_exists($distance)
	{
		$query = $this->otherdb->where('DISTANCE',$distance)->get('TBL_SETTINGS');

        return ($query->num_rows() > 0) ? true : false;		
	}
    
    
    function InsertSetting($userInfo)
    {
        $this->otherdb->insert('TBL_SETTINGS', $userInfo);
    
        return $this->otherdb->insert_id();       
       
    }
    
   
    function getSettingInfo($SETTINGID)
    {
		return $this->otherdb->where('SETTINGID', $SETTINGID)->get('TBL_SETTINGS')->result();
    }
    
    
   
    function editSET($userInfo, $SETTINGID)
    {
		$this->otherdb->where('SETTINGID', $SETTINGID)->update('TBL_SETTINGS', $userInfo);
        
        return $this->otherdb->affected_rows();
    }
    
    
    
    function deleteext($userId)
    {
        $this->otherdb->where('id', $userId)->delete('tbl_ext');
        
        return $this->otherdb->affected_rows();
    }


    function DeleteAllRecordAllot($gender)
    {
		$this->otherdb->where('GENDER', $gender)->delete('TBL_ALLOTMENT');

		return $this->otherdb->affected_rows();
    }
	
    function DeleteAllRecordReallot($gender)
    {
		$this->otherdb->where('GENDER', $gender)->delete('TBL_REALLOTMENT');

		return $this->otherdb->affected_rows();
    } 
	
	function GetSeminfo($gender)
    {
		return $this->otherdb->where('GENDER', $gender)
                    ->where('IS_ACTIVE', '1')
                    ->get('TBL_SEMESTER')
                    ->result();
    }
	
	function Getmigrate($gender, $semcode)
    {
		return $this->otherdb->where('GENDER', $gender)
                    ->where('SEMCODE', $semcode)
                    ->where('ALLOTTYPE', 'Allotment')
                    ->get('TBL_MIGRATION')
                    ->result();
    }
	
	function GetAllallotment($gender)
    {
		return $this->otherdb->where('GENDER', $gender)->get('TBL_ALLOTMENT')->result();
    }
		
	function InsertAllotReallot($userInfo)
    {
        $this->otherdb->insert('TBL_ALLOTREALLOT', $userInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function Insertmigrate($semInfo)
    {
        $this->otherdb->insert('TBL_MIGRATION', $semInfo);
    
        return $this->otherdb->insert_id();        
    }
	
	function GetReallotmigrate($gender, $semcode)
    {
		return $this->otherdb->where('GENDER', $gender)
                    ->where('SEMCODE', $semcode)
                    ->where('ALLOTTYPE', 'ReAllotment')
                    ->get('TBL_MIGRATION')
                    ->result();
    }
	
	function GetREAllallotment($gender)
    {
		return $this->otherdb->where('GENDER', $gender)
					->get('TBL_REALLOTMENT')
					->result();
    }	
	
	function InserReAllottmigrate($semInfo)
    {
        $this->otherdb->insert('TBL_MIGRATION', $semInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function Updatebatchname($batchInfo, $regno, $gender)
    {
        if($gender == 'Female')
		{ 
			$this->otherdb->where('REGNO', $regno)->update('TBL_REALLOTMENT', $batchInfo);
			
			return $this->otherdb->affected_rows();
		}
		 elseif($gender == 'Male')
		{ 
			$this->otherdb->where('REGNO', $regno)->update('TBL_REALLOTMENT', $batchInfo);
			
			return $this->otherdb->affected_rows();
		}
    }
	
	function Getreginfo($gender)
    {
        if($gender == 'Female')
		{ 
			return $this->otherdb->select('REGNO')
                        ->where('GENDER', $gender)
                        ->order_by('REALLOTMENT_ID', 'DESC')
                        ->get('TBL_REALLOTMENT')
                        ->result();
		  }
		  elseif($gender == 'Male')
		  { 
			return $this->otherdb->select('REGNO')
                        ->where('GENDER', $gender)
                        ->order_by('REALLOTMENT_ID', 'DESC')
                        ->get('TBL_REALLOTMENT')
                        ->result();
		  }
    }
	
	
	function getsemestercode($gender)
    {
		return $this->otherdb->select('SEMCODE, SEMESTEROPENREG')
            		->where('GENDER', $gender)
            		->where('IS_ACTIVE','1')
            		->get('TBL_SEMESTER')
            		->result();        
	}


    function IfExisted($gender, $semcode)
	{
		$query = $this->otherdb->where('SEMCODE',$semcode)
                        ->where('GENDER',$gender)
                        ->get('tbl_coursesetting');

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function GetCreditSettings($gender)
    {
		return $this->otherdb->where('GENDER', $gender)->get('tbl_coursesetting')->result();        
		
	}
		
	function GetCreditSettingsById($gender, $id)
    {
		return $this->otherdb->where('GENDER', $gender)
                    ->where('ID', $id)
                    ->get('tbl_coursesetting')
                    ->result();			
	}	
	
	function AddcreditInfo($creditInfo)
    {
		
        $this->otherdb->insert('tbl_coursesetting', $creditInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function EditcreditInfo($creditInfo, $id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ID', $id);
        $otherdb->update('tbl_coursesetting', $creditInfo);
        
        return $otherdb->affected_rows();
    }
	
	function getWebsiteContent($gender)
	{
		return $this->otherdb->where('gender', $gender)
                    ->order_by('id','DESC')
                    ->get('tbl_upload')
                    ->result(); 
	}
		
	function InsertWebContent($InsertWebContent)
    {
     	$this->otherdb->insert('tbl_upload', $InsertWebContent);
    	   
    	return $this->otherdb->insert_id();
    }
		
	function getWebsiteContentById($id)
    {
		return $this->otherdb->where('id', $id)
                    ->order_by('id','DESC')
                    ->get('tbl_upload')
                    ->result(); 
	}
		
	function UpdateWebContent($InsertWebContent, $id)
    {
		$this->otherdb->where('id', $id)->update('tbl_upload', $InsertWebContent);
        
        return $this->otherdb->affected_rows();
    }
	
	function deleteweb($webId)
    {
		$this->otherdb->where('id', $webId)->delete('tbl_upload');
        
        return $this->otherdb->affected_rows();
    }
}
 