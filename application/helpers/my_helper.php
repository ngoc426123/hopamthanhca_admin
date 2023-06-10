<?php
if(!function_exists("check_login")){
	function check_login() {
		$CI =& get_instance();
		if (!$CI->session->has_userdata('username')) {
			redirect('login');
		}
	}
}

if(!function_exists("check_admin")){
	function check_admin() {
		$CI =& get_instance();
		return ($CI->session->permission == 1) ? true : false;
	}
}

if(!function_exists("check_admin_rdr")){
	function check_admin_rdr() {
		$CI =& get_instance();
		if ( $CI->session->permission == 0 ) {
			redirect('dashbroad');
		}
	}
}

if(!function_exists("pr")){
	function pr($arr) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}

if(!function_exists("cut_chor_text")){
	function cut_chor_text($note){
		$chor_compare="";
		$chor_show="";
		$text="";
		for($i=0;$i<strlen($note);$i++){
			$chor_compare=$chor_compare.$note[$i];
			if($note[$i]=="]"){
				break;
			}
		}
		$count=strlen($chor_compare);
		$chor_show=substr($chor_compare,1,$count-2);
		for($i=0;$i<strlen($note);$i++){
			if($i>=$count){
				$text=$text.$note[$i];
			}
		}
		$chor_show=ucfirst($chor_show);
		$result=array(
			'chor_compare'  => $chor_compare,
			'chor_show' => $chor_show,
			'text'  => $text,
		);
		return $result;
	}
}

if(!function_exists("convent_song")){
	function convent_song($song){
		$result="";
		$song=str_replace("["," [",$song);
		$song=explode(' ',$song);
		foreach ($song as $rs){
			if(substr($rs,0,1)=="["){
				$c=cut_chor_text($rs);
				$rs=str_replace($c["chor_compare"],"<span class='chordOC'><span class='chordPer'>[</span><span class='chord'>".$c["chor_show"]."</span><span class='chordPer'>]</span></span>", $rs);
				$result=$result.$rs." ";
			}
			else{
				$result=$result.$rs." ";
			}
		}
		return $result;
	}
}

if(!function_exists("get_date_now")){
	function get_date_now(){
		return date('d/m/Y h:m:s');
	}
}

if(!function_exists("alert")){
	function alert($type="success",$title="Thông báo",$content="Lorem ipsum"){
		switch ($type){
			case "success" : 
				$icon="fa-check";
				break;
			case "info" : 
				$icon="fa-info";
				break;
			case "warning" : 
				$icon="fa-warning";
				break;
			case "danger" : 
				$icon="fa-ban";
				break;
		}
		?>
			<div class="alert alert-<?php echo $type; ?> alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa <?php echo $icon; ?>"></i> <?php echo $title; ?></h4>
				<?php echo $content; ?>
			</div>
		<?php
	}
}

if (!function_exists("print_alert")) {
    function print_alert($alert) {
			echo "<div class='alert alert-{$alert[0]}'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<i class='material-icons'>close</i>
					</button>
					<span>{$alert[1]}</span>
			</div>";
    }
}

if (!function_exists("md_pass")) {
	function md_pass($pass) {
		$keySpice = "@hopam!thanhca@";
		$pass = md5($keySpice.$pass);
		return $pass;
	}
}

if (!function_exists("fmt_number")) {
	function fmt_number($number) {
		return number_format($number, 0, "", ".");
	}
}

if (!function_exists("get_color_phase")) {
	function get_color_phase($slug) {
		switch ($slug) {
			case 'nhap-le': return ['bg-start', 'text-start'];
			case 'dap-ca': return ['bg-success', 'text-success'];
			case 'dap-ca': return ['bg-info', 'text-info'];
			case 'hiep-le': return ['bg-warning', 'text-warning'];
			case 'ket-le': return ['bg-primary', 'text-primary'];
			case 'xuc-tro': return ['bg-primary', 'text-primary'];
			case 'ca-tiep-lien': return ['bg-danger', 'text-danger'];
			default: return ['bg-info', 'text-info'];
		}
	}
}