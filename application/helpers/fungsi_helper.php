<?php  
	function session_ready(){
		$ci =& get_instance();
		$user_session = $ci->session->userdata('nama');
		$level_session = $ci->session->userdata('level');

		if ($user_session != '' and $level_session != ''){
			redirect('home');
			
		}

	}

	function session_not_ready(){
		$ci=& get_instance();
		$user_session = $ci->session->userdata('nama');
		$level_session = $ci->session->userdata('level');

		if (!$user_session && !$level_session) {
			redirect('login');
			
		}

	}
?>