<div class="post" style="margin: 0px;box-shadow: 0px; border: 0px ;">
	<div class="post_title">
		<span class="blue userName"><?php echo $postData->post_title; ?></span>	
	</div>	
	<hr>
	<img src="<?php echo $postData->img; ?>">

	<hr>
	<p class="blog_des"> <?php echo $postData->main_des; ?>  </p>
		<br>
	   <p style="margin-left: 5%">  <strong>  Set Price: &nbsp; </strong> <select name="price" id="price<?php echo $postData->post_id; ?>" style="border: 1px solid #ccc; width: 50%;">                         <option value="1">1</option>                           <option value="2">2</option>                         <option value="3">3</option>                         <option value="4">4</option>                         <option value="5">5</option>                         <option value="6">6</option>                         <option value="7">7</option>                         <option value="8">8</option>                         <option value="9">9</option>                         <option value="9">9</option>                         <option value="10">10</option>                    </select>                              <a  class="mbtn-right btn-blue" style="height: 28px;line-height: 28px;font-weight: 700;color: #555;width: 30%;" onclick="promoteNow(<?php echo $postData->post_id; ?>, <?php echo $postData->user_id; ?>);" > Promote </a> 

</div>