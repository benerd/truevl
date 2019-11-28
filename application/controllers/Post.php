<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use google\appengine\api\cloud_storage\CloudStorageTools;
class cURL
{

	var $headers;

	var $user_agent;

	var $compression; 

	var $cookie_file;

	var $proxy;

	function cURL($cookies = TRUE, $cookie = '/tmp/cookies.txt', $compression = 'gzip', $proxy = '')
	{
		$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$this->headers[] = 'Connection: Keep-Alive';
		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
		$this->compression = $compression;
		$this->proxy = $proxy;
		$this->cookies = $cookies;
		
	}

	function get($url)
	{
		$url = str_replace("&amp;", '&', $url);

		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE)
			curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE)
			curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process, CURLOPT_ENCODING, $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_HTTPGET, true);
		
		
		if ($this->proxy)
			curl_setopt($process, CURLOPT_PROXY, $this->proxy);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}

	function post($url, $data)
	{
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 1);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE)
			curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE)
			curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process, CURLOPT_ENCODING, $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		if ($this->proxy)
			curl_setopt($process, CURLOPT_PROXY, $this->proxy);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	function error($error)
	{
		die;
	}
}

class Post extends CI_Controller { 
	
	public function __construct() 
	{ 
		parent::__construct();
		$bucket = CloudStorageTools::getDefaultGoogleStorageBucketName();
        $this->image_url = 'gs://' . $bucket . '/uploads/';
		$this->load->model('User_model');
		$this->load->model('Feed_model');
	}	
	public function index()
	{	
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$this->linkPost();
	}

	public function linkPost(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$pdata=$this->User_model->privacyData($userId);
		$not=$this->User_model->friendNoti($userId);
		if($not){
		foreach ($not as $key => $value) {
			$friendId=$value["uid_1"];

	 	   $FriendProflies["friends"][]=$this->User_model->FriendProflies($friendId);
	 	   	

		}
	    }

	    else{
	    	$FriendProflies["friends"][]=NULL;
	    }
	     
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$this->load->view('includes/header',array("userData"=> $x,'noti' => $not,'friends'=>$FriendProflies['friends'], 'userId'=>$userId));
		
		$this->load->view('submit_post',array("userData"=> $x,"pdata"=>$pdata));
	}

	function fetchPreview(){

		$url = $_POST["url"];

		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
		if(count($match) > 0 )
		 { $youtube_id = $match[1]; 

		$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?key=AIzaSyAFbYYoN7Ttk95MBAeWYSzjkh8wWhipT2Q&part=snippet&id=".$youtube_id);

		$json = json_decode($data);
                
		$ytdata=($json->items[0]->snippet->thumbnails->maxres->url);
         }
 
		$url = $this->checkValues($_POST["url"]);
		$return_array = array();
		$base_url = substr($url,0, strpos($url, "/",8));
		$relative_url = substr($url,0, strrpos($url, "/")+1);
		$cc = new cURL();
		$string = $cc->get($url);
		$string = str_replace(array("\n","\r","\t",'</span>','</div>'), '', $string);
		$string = preg_replace('/(<(div|span)\s[^>]+\s?>)/',  '', $string);
		if (mb_detect_encoding($string, "UTF-8") != "UTF-8") 
		$string = utf8_encode($string);
		$nodes = $this->extract_tags( $string, 'title' );
		$return_array['title'] = trim($nodes[0]['contents']);
		$return_array['description'] = '';
		$nodes = $this->extract_tags( $string, 'meta' );

		$base_override = "https://"; 
		
                
		foreach($nodes as $node)
			{
				if (isset($node['attributes']['name']) && strtolower($node['attributes']['name']) == 'description')
					$return_array['description'] = trim($node['attributes']['content']);
			}

			$images_array = $this->extract_tags( $string, 'img' ); 
			$sites_html = file_get_contents($url);
			$html = new DOMDocument();
			@$html->loadHTML($sites_html);
			$meta_og_img = null;
			//Get all meta tags and loop through them.
			foreach($html->getElementsByTagName('meta') as $meta) {
			    //If the property attribute of the meta tag is og:image
			    if($meta->getAttribute('property')=='og:image'){ 
			        //Assign the value from content attribute to $meta_og_img
			        $meta_og_img = $meta->getAttribute('content');
			    }
			}

			if($meta_og_img==""){
				$return_array['images'] = array_values(($images_array ));
			}
                        else if(isset($youtube_id)){
                           $return_array['images']= $json->items[0]->snippet->thumbnails->maxres->url;
                        }
       		else{
       			$return_array['images'] = $meta_og_img;
       		}
			
			//$return_array['total_images'] = count($return_array['images']); 

			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');

			echo json_encode($return_array);
			exit;
	}

	public function checkValues($value)
	{
		$value = trim($value);
		if (get_magic_quotes_gpc())
		{
			$value = stripslashes($value);
		}
		$value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		return $value;
	}


	public function extract_tags( $html, $tag, $selfclosing = null, $return_the_entire_tag = false, $charset = 'ISO-8859-1' ){
 
	if ( is_array($tag) ){
		$tag = implode('|', $tag);
	}
 
	//If the user didn't specify if $tag is a self-closing tag we try to auto-detect it
	//by checking against a list of known self-closing tags.
	$selfclosing_tags = array( 'area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta', 'col', 'param' );
	if ( is_null($selfclosing) ){
		$selfclosing = in_array( $tag, $selfclosing_tags );
	}
 
	//The regexp is different for normal and self-closing tags because I can't figure out 
	//how to make a sufficiently robust unified one.
	if ( $selfclosing ){
		$tag_pattern = 
			'@<(?P<tag>'.$tag.')			# <tag
			(?P<attributes>\s[^>]+)?		# attributes, if any
			\s*/?>					# /> or just >, being lenient here 
			@xsi';
	} else {
		$tag_pattern = 
			'@<(?P<tag>'.$tag.')			# <tag
			(?P<attributes>\s[^>]+)?		# attributes, if any
			\s*>					# >
			(?P<contents>.*?)			# tag contents
			</(?P=tag)>				# the closing </tag>
			@xsi';
	}
 
	$attribute_pattern = 
		'@
		(?P<name>\w+)							# attribute name
		\s*=\s*
		(
			(?P<quote>[\"\'])(?P<value_quoted>.*?)(?P=quote)	# a quoted value
			|							# or
			(?P<value_unquoted>[^\s"\']+?)(?:\s+|$)			# an unquoted value (terminated by whitespace or EOF) 
		)
		@xsi';
 
	//Find all tags 
	if ( !preg_match_all($tag_pattern, $html, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE ) ){
		//Return an empty array if we didn't find anything
		return array();
	}
 
	$tags = array();
	foreach ($matches as $match){
 
		//Parse tag attributes, if any
		$attributes = array();
		if ( !empty($match['attributes'][0]) ){ 
 
			if ( preg_match_all( $attribute_pattern, $match['attributes'][0], $attribute_data, PREG_SET_ORDER ) ){
				//Turn the attribute data into a name->value array
				foreach($attribute_data as $attr){
					if( !empty($attr['value_quoted']) ){
						$value = $attr['value_quoted'];
					} else if( !empty($attr['value_unquoted']) ){
						$value = $attr['value_unquoted'];
					} else {
						$value = '';
					}
 
					//Passing the value through html_entity_decode is handy when you want
					//to extract link URLs or something like that. You might want to remove
					//or modify this call if it doesn't fit your situation.
					$value = html_entity_decode( $value, ENT_QUOTES, $charset );
 
					$attributes[$attr['name']] = $value;
				}
			}
 
		}
 
		$tag = array(
			'tag_name' => $match['tag'][0],
			'offset' => $match[0][1], 
			'contents' => !empty($match['contents'])?$match['contents'][0]:'', //empty for self-closing tags
			'attributes' => $attributes, 
		);
		if ( $return_the_entire_tag ){
			$tag['full_tag'] = $match[0][0]; 			
		}
 
		$tags[] = $tag;
	}
 
	return $tags;
}
	
		public function submit_my_post($flag){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}

		$bucket = CloudStorageTools::getDefaultGoogleStorageBucketName();
		$target_dir ='gs://' . $bucket . '/uploads/';
		$data=array();
		if($flag==1 || $flag==3){
			$_FILES["vid"]["name"]=NULL;
			$_FILES["vid"]["tmp_name"]=NULL;
			$_FILES["vid"]["size"]=NULL;
			$thumbn=NULL;
		}

		if($flag==2){
			$_FILES["vid"]["name"]=NULL;
			$_FILES["vid"]["tmp_name"]=NULL;
			$_FILES["vid"]["size"]=NULL;
			$thumbn=NULL;
			$_POST["Keywords"]=NULL;
			if (!preg_match("~^(?:f|ht)tps?://~i", $_POST['short_des'])) {
		        $sourceUrl = "http://" . $_POST['short_des'];
     		}
     		else{
     			$sourceUrl=$_POST['short_des'];
     		}
      		$_POST["short_des"]=$sourceUrl;
      		$_FILES["img"]["name"]=$_POST["img"];
      		
		}

		if($flag==3){
			$x=$this->User_model->getUserData($this->session->userdata('email'));
			$img=$x[0]->profile_pic;
			$_FILES["vid"]["name"]=NULL;
			$thumbn=NULL;
			if(!$_FILES["img"]["name"]){
				$is=0;
				$_FILES["img"]["name"]=$img;
			}
			else{
				$is=1;
			}
			$_POST["post_title"]=NULL;
			$_POST["Keywords"]=NULL;
			$_POST["main_des"]=NULL;
			$_POST["cat"]=NULL;
			$data["post_images"]=NULL;
			

		}
		
		
		$x=$this->User_model->getID($this->session->userdata('email'));
		
		$uid=$x->id;
			$format=('Y-m-d H:i:s');

		$d= date($format, strtotime("3 hours +30 minutes"));
		
		$sql="select * from friends where uid_1=$uid or uid_2=$uid and status=1";
		$qry=$this->db->query($sql);
		if($qry){
			$arr=$this->db->query($sql)->result_array();
		}
		  $frndarr=array();
		 if($arr){
		foreach ($arr as $key => $frnds) {
			if($uid==$frnds["uid_1"])
			array_push($frndarr, $frnds["uid_2"]);
			else
			array_push($frndarr, $frnds["uid_1"]);
		}
	}
		$data=array('user_id'=> (int)$uid,
					'post_title'=>$_POST["post_title"] ,
					'cat'=>$_POST["cat"] ,
					'short_des'=>$_POST["short_des"] ,
					'main_des'=>$_POST["main_des"] ,
					'Keywords'=>$_POST["Keywords"] ,
					'img'=>$_FILES["img"]["name"] ,
					'Vfile'=>$_FILES["vid"]["name"],
					'thumb'=>$thumbn,
					'posted_on'=>$d,
					'update_time'=>$d,
					'post_status'=>1,
					'shared_by'=>NULL,
					'hidden_by'=>NULL		
			);


   			if($flag==3){
   				if($is==1){
   					$data["is_status"]=4;
   				}
   				else{
   					$data["is_status"]=1;
   				}
   			}

   			if($flag==4){
			$_FILES["img"]["name"]=NULL;
			$_FILES["img"]["tmp_name"]=NULL;
			$_FILES["img"]["size"]=NULL;
			$_POST["Keywords"]=NULL;
			$_POST["main_des"]=NULL;
			$_POST["cat"]=NULL;
			$data["post_images"]=NULL;
			$x=$this->thumb($_FILES["vid"]["tmp_name"]);

		    if($x){
		    	$thumbn=$x;
		    	// echo $x;
		    }
		    else{
		    	$thumbn=NULL;
		    }
		}
       
		if($flag==1 || $flag==3){
			$img=array('name'=>$_FILES["img"]["name"],
					'tmp'=>$_FILES["img"]["tmp_name"],
					'size'=>$_FILES["img"]["size"]
					);
			$img["name"]=md5(rand()).$img["name"];
			$f1=$this->uploadImgs($img,1);

			$f2=false;

		}
		if($flag==2)
		{
			$data["is_status"]=2;
			$f2=true;
			$f1=false;
		}
		
		if($flag==3){
			// $f1=$f2=NULL;
		}

		if($f1 || $f2 || $flag==3 ){

			 
			if($f1) 
			{
				$options = ['crop' => false];
				$image_file = $target_dir.$img["name"];;
				$image_url = CloudStorageTools::getImageServingUrl($image_file, $options);
				$data["img"]=$image_url ;
				
			}			
			if($f2){
				$data["img"]=$_POST["img"];
			}
			$y=$this->Feed_model->insertPost($data);
			if($y){
				
				$q="insert into likes set post_id= $y, likes=0, liked_by=NULL";
					$qry=$this->db->query($q);
					if($qry){
						echo 1;					
					}
					else{
						echo 0;
					}
			}
			else{
					echo 0;
				}
			}	
	}


	 public function uploadImgs($file,$c){
	 	if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$bucket = CloudStorageTools::getDefaultGoogleStorageBucketName();
		if($file){

			if($c==1)
			{
				$target_dir ='gs://' . $bucket . '/uploads/';

			}
			if($c==2){
				$target_dir ='gs://' . $bucket . '/uploads/';
			}
			$target_file = $target_dir . basename($file["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


if (file_exists($target_file)) {
   $this->session->set_flashdata('err', 'Sorry, file already exists');
    $uploadOk = 0;
    	echo 12;

}






if ($file["size"] > 2000000) {
   $this->session->set_flashdata('err', 'Sorry, file is too large');
    $uploadOk = 0;
    	echo 22;
}

	
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
     $this->session->set_flashdata('err', 'Sorry only images are allowed');
    $uploadOk = 0;
    	echo 32;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

  $this->session->set_flashdata('ex', 'Sorry, your file was not uploaded.');
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($file["tmp"], $target_file)) {

       return 1;
    } else {
       return 0;
    }
}
		}
	}


	public function write_article(){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$this->load->view("includes/header",array("userData"=> $x, 'userId'=>$userId));
		$this->load->view("submit_post");
	}


	public function submit_video(){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$this->load->view("includes/header",array("userData"=> $x, 'userId'=>$userId));
		$this->load->view("submit_video");
	}
	
		public function editpost($pid){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$z=$this->User_model->EditPostData($pid);
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		
		$not=$this->User_model->friendNoti($userId);
		if($not){
		foreach ($not as $key => $value) {
			$friendId=$value["uid_1"];

	 	   $FriendProflies["friends"][]=$this->User_model->FriendProflies($friendId);
	 	   	

		}
	    }

	    else{
	    	$FriendProflies["friends"][]=NULL;
	    }
	     
	
		$this->load->view('includes/header',array('userData'=> $x,  'userId'=>$userId));
		$this->load->view('editpost',array('postData'=>$z));
	}
	
	public function update_my_post($post_id){
		 header( 'Content-Type: text/html; charset=utf-8' ); 
		 $x=$this->User_model->getID($this->session->userdata('email'));
		 $uid=$x->id;
		 $data=array();

		 $data=array('user_id'=> (int)$uid,
					'post_title'=>$_POST["post_title"] ,
					'cat'=>$_POST["cat"] ,
					'short_des'=>$_POST["short_des"] ,
					'main_des'=>$_POST["main_des"] ,
					'image'=>NULL,
					'Keywords'=>$_POST["Keywords"] ,
					'img'=> NULL ,
					'Vfile'=>NULL,
					'thumb'=>NULL,
					'posted_on'=>date('Y-m-d')
			);

		
		 if($_FILES["img"]["name"]!=""){
			$img=array('name'=>$_FILES["img"]["name"],
					'tmp'=>$_FILES["img"]["tmp_name"],
					'size'=>$_FILES["img"]["size"]
					);
			$img["name"]=md5(rand()).$img["name"];


			$f1=$this->uploadImgs($img,1);
		
			
			
		if($f1){

			$data["img"]="../uploads/img/".$img["name"];
		}
		}
		else{
			$data["img"]=$_POST["imgu"];
		}

		// echo $data["img"];
			
			$y=$this->User_model->UpdatePost($post_id,$data);
			 

			if($y)
			{	echo $y;

			}
		

		
	}

}