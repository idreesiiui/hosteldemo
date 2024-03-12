<div class="container register">
    <div class="row">
         <div class="col-md-4 register-left">
                <img class="rounded-circle" width=100 height=100 src="<?php echo base_url();?>/assets/frontend/img/usis/iiui-logo.png">
                <h3>Welcome</h3>
                <h6>Online Application for Hostel Registration</h6>
                <div class="bg-light text-danger border shadow rounded p-1 mt-5 mb-5 instruction">
                    <h4 class="font-weight-dark text-center">Instructions</h4>
                    <ul class="text-left">
                        <li>Please review your information before submission.</li>
                        <li>Don't use someone else Email, CNIC / Passport or Contact No.</li>
                        <li>Any misleading information would lead to cancelation of registeration. </li>
                    </ul>
                </div>
        </div>
        <div class="col-md-8 register-right">
     
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row register-heading">
                            <h5 class="ml-3 mr-5  mt-5">Hostel Registeration for Semseter SPR-2019 </h5>
                            <img src="<?php echo base_url();?>/assets/frontend/img/usis/img_avatar_male.png" alt="Avatar" class="mt-1 ml-5 avatar">
                         </div>
                  <div class="row register-form ">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Reg. No.</label>
                                <input type="text" class="form-control required" name="regno"  readonly required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Father Name</label>
                                <input type="text" class="form-control required" name="name"  readonly required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Nationality</label>
                                <select class="form-control" name="nationality"  required autofocus>
                                    <option class="hidden"  selected disabled>Select Nationality</option>
                                    <option value="Pakistani">Pakistani</option>
                                    <option value="Overseas Pakistani">Overseas Pakistani</option>
                                    <option value="Foreigner">Foreigner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Contact No</label>
                                <input type="number" class="form-control required" maxlength="11" name="snumber"  required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">CNIC/ Passport <small style="font-size:10px; color:red;" > CNIC without dashes</small></label>
                                <input type="text" class="form-control required" name="cnic"  maxlength="13" required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">City</label>
                                <input type="text" class="form-control required" name="city"  required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Province</label>
                                <select class="form-control" name="province"  required autofocus>
                                    <option class="hidden"  selected disabled>Select Province</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="Federally Administered Tribal Areas">Federally Administered Tribal Areas</option>
                                    <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                    <option value="Azad Jammu & Kashmir" >Azad Jammu & Kashmir</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Password</label>
                                <input type="password" class="form-control required" name="password"  required autofocus />
                            </div>
                     </div>
                     <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Full Name</label>
                                <input type="text" class="form-control required" name="fname"  readonly required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">CGPA</label>
                                <input type="number" class="form-control required"  name="cgpa"  readonly required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Country</label>
                                <input type="text" class="form-control required" name="country"  required autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">DOB</label>
                                <input type="date" class="form-control required" name="dob"  required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Permanent Address</label>
                                <textarea class="form-control required" id="addressTextarea" rows="1" name="address"  required autofocus></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">District</label>
                                <input type="text" class="form-control required"  name="district"  required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Email address</label>
                                <input type="email" class="form-control required"  name="email"  required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Confirm Password</label>
                                <input type="password" class="form-control required" name="cpassword"  required autofocus />
                            </div>
                      </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btnRegister text-white" value="submit">Submit</button> 
                                    <button type="reset" class="ml-1 btn btn-white border" value="reset">Reset</button>	
                                </div>
                            </div>
                                        
                 	 </div>
                   </div>
                 </div>
            </div>
    
          </div>
       </div>