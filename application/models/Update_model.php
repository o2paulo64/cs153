<?php
Class update_model extends CI_Model
{
	function returnall($userid)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('userId!=',$userid);
		$query = $this -> db -> get();
		
		return $query;
	}

	function returnedit($userid)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('userId',$userid);
		$query = $this -> db -> get();
		
		return $query;
	}


	
	function returnnoobs($userid)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('authority',0);
		
		$query = $this -> db -> get();
		
		return $query;
	}

	function returncool($userid)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('userId!=',$userid);
		$this -> db -> where('authority',1);
		$query = $this -> db -> get();
		
		return $query;
	}
	
	function deleteentry($data)
	{
		$this -> db -> where('userId',$data['userId']);
		$this -> db ->delete('users');
		
	}
	
	function upgradeentry($data)
	{
		$this -> db -> where('userId',$data['userId']);
		$this -> db ->update('users',$data);
		
	}

	function deletelogin($userid)
	{
		$this -> db -> where('userId',$userid);
		$this -> db ->delete('login');
		
	}
	
	function viewonline($userid)
	{
		$this -> db -> select('*');
		$this -> db -> from('login');
		$this -> db -> where('userId!=',$userid);
		$query = $this -> db -> get();
		
		return $query;
	}
}
?>