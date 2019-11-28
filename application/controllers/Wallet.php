<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class  Wallet extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model'); 
		$this->load->model('Admin_model'); 
	}

	public function index()
	{
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$wa=$this->User_model->wallAmount($userId);
		$transaction=$this->User_model->walltransaction($userId);
		$walltransactionDb=$this->User_model->walltransactionDb($userId);
		$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
		$this->load->view('wallet', array("wa"=>$wa, "transaction"=>$transaction, "transactionDb"=>$walltransactionDb));

	}

	function proceedP(){

			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		 	$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
			            array("X-Api-Key:test_1f8be361fd01e489dffaf89764b",
			                  "X-Auth-Token:test_b5559e84be637dd33411c072c49"));
			$amount=$_POST["amount"];
			$payload = Array(
			'purpose' => 'Add money to truevl wallet',
    		'amount' => $amount,
    		'phone' => $x[0]->mobile,
    		'buyer_name' => $x[0]->name,
    		'send_email' => true,
    		'send_sms' => true,
    		'email' => $x[0]->email,
    		'allow_repeated_payments' => false,
	        "redirect_url" => "http://truevl.com/test/Wallet/thankyou",        
	        "webhook" => "http://truevl.com/test/Wallet/webhook"
			);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
			$response = curl_exec($ch);
			curl_close($ch); 
			

		 // $x=json_decode($response);
   //          $longurl=$x->payment_request->longurl;
    		
    
   //  Redirect($longurl,302); 

   
   //  exit();

			$data = json_decode($response, true);

			if($data['success'] == 1){
			    // for on page payment, use this.
			   $payment_id = $data['payment_request']['id'];
			 
			     
			       
			       header('Location:'.$data['payment_request']['longurl'].'');
			}else{
			    echo '<div class="w3-panel w3-red w3-content">
			  
			  <p>Error Try Again Later!</p>
			</div>';
			}

   
	}

	function thankyou(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		require_once APPPATH.'third_party/instamojo.php';
		$api = new Instamojo\Instamojo('test_1f8be361fd01e489dffaf89764b', 'test_b5559e84be637dd33411c072c49','https://test.instamojo.com/api/1.1/');
		$payid = $_GET["payment_request_id"];
		try {
   			 $response = $api->paymentRequestStatus($payid);

   		}
   		catch (Exception $e) {
    		$response=$e->getMessage();
		}
			// print_r($response);
		if($response["payments"][0]["status"]=="Credit"){
			$pid=$response["payments"][0]['payment_id'];
		    	$amount=$response["payments"][0]['amount']; 

		    	$sql="insert into wallet set user_id=$userId, incocming_balance=$amount,payment_id='$pid', source='MOJO'";
		    	$this->db->query($sql);
		    	$message= urlencode($response["payments"][0]['amount']." payment received");
		        $response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=7895561596&smsContentType=english");
				redirect('wallet/th/'.$pid);
		}
		else{
			redirect('wallet/failed');
		}
		}

		function th($pid){
			if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
			$this->load->view('includes/header',array("userData"=> $x,  'userId'=>$userId));
			$this->load->view('thankyou', array("pid"=>$pid));
		}


	

	function webhook(){
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('err', 'please login first');
			redirect("/");
		}
		
// 			$message="payment received";
// 		        $response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=7895561596&smsContentType=english");
		$x=$this->User_model->getUserData($this->session->userdata('email'));
		$y=$this->User_model->getUserID($this->session->userdata('email'));
		$userId=$y->id;
		$data = $_POST;
		$mac_provided = $data['mac'];  
		unset($data['mac']);  
		$ver = explode('.', phpversion());
		$major = (int) $ver[0];
		$minor = (int) $ver[1];

		if($major >= 5 and $minor >= 4){
		     ksort($data, SORT_STRING | SORT_FLAG_CASE);
		}
		else{
		     uksort($data, 'strcasecmp');
		}
		$mac_calculated = hash_hmac("sha1", implode("|", $data), "30f280eebc2e4688b22659e77a53aa59");

		if($mac_provided == $mac_calculated){
		    echo "MAC is fine";
		   
		    if($data['status'] == "Credit"){
		       
		    	$pid=$data['payment_id'];
		    	$amount=$data['amount']; 

		    	$sql="insert into tvwallet set uid=$userId, amount=$amount,payment_id=$pid";
		    	$this->db->query($sql);
		    	$message= urlencode($data['amount']." payment received");
		        $response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=7895561596&smsContentType=english");

		    }
		    else{
		       // Payment was unsuccessful, mark it as failed in your database
		    }
			}
			else{
			    echo "Invalid MAC passed";
			}
		}
		
		function msgtest(){
		    
		    	$message= urlencode("payment received");
		    	
		        $response=file_get_contents("http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=7f93ca72ffd04040e54c88f28f50cd4d&message=$message&senderId=truevl&routeId=1&mobileNos=7895561596&smsContentType=english");
		}
}