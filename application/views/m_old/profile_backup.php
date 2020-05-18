<?php include "header.php"; ?>

	<div class="wrap">
		<!--Profile-->
      <div class="profile">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle"> My Account </h3>
               
                <?php include "profile_menu.php"; ?>
                     
                    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">Personal Information</a></li>
    <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">Add a New Address</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab1">
       <div class="login-frm">
                  <input type="text" id="fname" Placeholder="Enter Your First Name" value="<?=$persional_info[0]->fname; ?>">
                  <input type="text" id="lname" Placeholder="Enter Your Last Name" value="<?=$persional_info[0]->lname; ?>">
                  <input type="text" id="mobile" Placeholder="Enter Your Mobile Number" maxlength="10" value="<?=$persional_info[0]->mob; ?>">
                  <div class="single-bottom"><label for="male"><input type="radio" value="male" name="sex" id="male" <?php if($persional_info[0]->gendr == 'Male'){ echo 'checked';} ?> checked> <span> Male </span> </label> </div>
  		          <div class="single-bottom"><label for="female"><input type="radio" value="female" name="sex" id="female" <?php if($persional_info[0]->gendr == 'Female'){ echo 'checked';} ?>> <span> Female </span> </label> </div>
                  
                  <input type="hidden" id="hidden_mail" class="hidden_mail" value="<?=$persional_info[0]->email?>">
                  <input  type="submit" class="send" value="Save Changes">
       </div>	
    </div>
    <div role="tabpanel" class="tab-pane" id="tab2">
    
     <div class="login-frm">
                  <input type="text" id="fname" Placeholder="Enter Your Name">
                  <select> 
                  <option> Your Country </option>
                  <option> India </option>
                  <option> Other </option>
                  </select>
                   <select> 
                  <option> Your State </option>
                  <option> Odisha </option>
                  <option> Other </option>
                  </select>
                  
                  <input type="text" id="lname" Placeholder="Enter City">
                  <textarea cols="30" rows="5" Placeholder="Street Address">Street Address </textarea>
                  <input type="text" id="mobile" Placeholder="Enter Pin">
                  <input type="text" id="mobile" Placeholder="Enter Mobile Number">
                 
                  <input  type="submit" class="send" value="Save Changes">
                  
                  
                  <div class="multi_address">
                       <p> <strong>Bhagyashree Pattanaik</strong> <br>
                        Plot No-32,Unit-4, bhubaneswar  <br>
                        bbsr-751022, India  <br>
                        Ph : 1236547890  </p>
                <div class="single-bottom"><label for="dadrs"><input type="radio" value="dadrs" name="radio" id="dadrs" checked> <span> Default Address </span> </label> </div>
                 <span class="gray-sml-btn"> <i class="fa fa-trash-o"></i>Delete address </span>
                </div>
                 <div class="multi_address">
                       <p> <strong>Bhagyashree Pattanaik</strong>   <br>
                        Plot No-32,Unit-4, bhubaneswar  <br>
                        bbsr-751022, India  <br>
                        Ph : 1236547890  </p>
                 <div class="single-bottom"><label for="adrs"><input type="radio" value="adrs" name="radio" id="adrs"> <span> </span> </label> </div>
                 <span class="gray-sml-btn"> <i class="fa fa-trash-o"></i>Delete address </span>
                </div>
                <div class="clearfix"></div>
       </div>
    </div>
  </div>

     
     
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>


<?php include "footer.php"; ?>