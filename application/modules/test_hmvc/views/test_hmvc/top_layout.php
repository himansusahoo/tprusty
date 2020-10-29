<?php ?>

<div class="row">
    <div class="col">
        <form class="form-horizontal">
            <div class="card card-warning card-outline">
                <div class="card-header text-left text-bold hand_cursor" data-card-widget="collapse">
                    Personal Information
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>           
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group row">
                                        <label for="firstName" class="col-sm-5 col-form-label ele_required_aftr">First Name</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="22" tabindex="1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dob" class="col-sm-5 col-form-label ele_required_aftr">DOB</label>
                                        <div class="col-sm-7">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="motherTongue" class="col-sm-5 col-form-label">Mother Tongue</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="28" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="birthPlace" class="col-sm-5 col-form-label">Birth Place</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="30" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cast" class="col-sm-5 col-form-label ele_required_aftr">Cast</label>
                                        <div class="col-sm-7">
                                            <select class="form-control cast-select" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="male">cast-1</option>
                                                <option value="female">cast-1</option>
                                                <option value="trans">cast-1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phyChallenged" class="col-sm-5 col-form-label ele_required_aftr">Physically Challenged</label>
                                        <div class="col-sm-7">
                                            <select class="form-control physical-challenged" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    

                                </div>
                                <div class="col-4">
                                    <div class="form-group row">
                                        <label for="lastName" class="col-sm-5 col-form-label">Last Name</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="23" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-5 col-form-label ele_required_aftr">Mobile</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="26" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bloodGroup" class="col-sm-5 col-form-label ele_required_aftr">Blood Group</label>
                                        <div class="col-sm-7">
                                            <select class="form-control blood-group-select" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="male">O +ve</option>
                                                <option value="female">O -ve</option>
                                                <option value="trans">A +ve</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nationality" class="col-sm-5 col-form-label ele_required_aftr">Nationality</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="31" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="emergencyPerson" class="col-sm-5 col-form-label">Emergency Person</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="34" class="form-control">
                                        </div>
                                    </div>                            
                                    <div class="form-group row">
                                        <label for="pan" class="col-sm-5 col-form-label">PAN No</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="38" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">                                    
                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-5 col-form-label ele_required_aftr">Gender</label>
                                        <div class="col-sm-7">
                                            <select class="form-control select2bs4" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="trans">Transgender</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-5 col-form-label ele_required_aftr">E-mail</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>                            
                                    <div class="form-group row">
                                        <label for="section" class="col-sm-5 col-form-label ele_required_aftr">Religion</label>
                                        <div class="col-sm-7">
                                            <select class="form-control religion" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="yes">R-1</option>
                                                <option value="No">R-2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="usn" class="col-sm-5 col-form-label">Emergency Phone</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="35" class="form-control">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="adharNo" class="col-sm-5 col-form-label">Aadhar No.</label>
                                        <div class="col-sm-7">
                                            <input type="email" tabindex="37" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card border-warning mb-3 border-warning">
                                <div class="card-body text-secondary">
                                    <div class="row">
                                        <span style="margin: auto;font-size: 30px;"><i class="fas fa-user round_icon"></i></span>
                                    </div>
                                    <div class="row">
                                        <div class="row text-center" style="margin: auto; padding-top: 10px;">
                                            <button class="btn btn-sm btn-warning">Upload Photo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary float-right">Save</button>        
                </div>
            </div>
        </form>
    </div>    
</div>

<div class="row">
    <div class="col-12">
        <div class="card text-center card-primary card-outline">    
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">                
                        <a class="nav-link active" id="admission-tab" data-toggle="tab" href="#admission" role="tab" aria-controls="admission" aria-selected="true">
                            Admission Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents" role="tab" aria-controls="profile" aria-selected="false">
                            Parents Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="contact" aria-selected="false">
                            Education Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="contact" aria-selected="false">
                            Address Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="certificate-tab" data-toggle="tab" href="#certificate" role="tab" aria-controls="contact" aria-selected="false">
                            Certificate Information
                        </a>
                    </li>
                </ul>        
            </div>
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="admission" role="tabpanel" aria-labelledby="admission-tab">
                        <div class="card card-warning">
                            <form class="form-horizontal">
                                <div class="card-header text-left text-bold">Admission Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <label for="examEvent" class="col-sm-5 col-form-label ele_required_aftr">Exam Event</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="academicBatch" class="col-sm-5 col-form-label ele_required_aftr">Academic Batch</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="4" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cetNo" class="col-sm-5 col-form-label">CET/COMED-K No</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="7" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="semister" class="col-sm-5 col-form-label ele_required_aftr">Semester</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="10" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ruralUrban" class="col-sm-5 col-form-label ele_required_aftr">Rural/Urban</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="13" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="rollNumber" class="col-sm-5 col-form-label">Roll number</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="16" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="hostel" class="col-sm-5 col-form-label">Hostel</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="19" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <label for="department" class="col-sm-5 col-form-label ele_required_aftr">Department</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="admissionType" class="col-sm-5 col-form-label ele_required_aftr">Admission Type</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="5" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cetRank" class="col-sm-5 col-form-label">CET/COMED-K Rank</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="8" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="branchCycle" class="col-sm-5 col-form-label ele_required_aftr">Branch/Cycle</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="11" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="applicationNo" class="col-sm-5 col-form-label">Application No</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="14" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="claimedCategory" class="col-sm-5 col-form-label ele_required_aftr">Claimed Category</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="17" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="transport" class="col-sm-5 col-form-label">Transport</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="20" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <label for="program" class="col-sm-5 col-form-label ele_required_aftr">Program</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="3" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="quota" class="col-sm-5 col-form-label ele_required_aftr">Quota</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="6" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="doj" class="col-sm-5 col-form-label ele_required_aftr">DOJ</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="9" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="section" class="col-sm-5 col-form-label ele_required_aftr">Section</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="12" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="usn" class="col-sm-5 col-form-label">USN</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="15" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="allocatedCat" class="col-sm-5 col-form-label ele_required_aftr">Allocated Category</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="18" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="referralUSN" class="col-sm-5 col-form-label">Referral USN</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="21" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="float-left">
                                        <i class="fas fa-exclamation-triangle text-danger"></i> <i>Fields marked with an <span class="text-red">*</span> are mandatory</i>                                            
                                    </span>
                                    <span><input type="submit" class="btn btn-sm btn-default float-right" id="" value="Next"></span>
                                    <span><input type="submit" class="btn btn-sm btn-primary float-right marginR5" id="" value="Save"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                        <div class="card card-warning">
                            <form class="form-horizontal">
                                <div class="card-header text-left text-bold">Parent Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="fatherName" class="col-sm-5 col-form-label ele_required_aftr">Father Name</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="1" tabindex="1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fatherPhone" class="col-sm-5 col-form-label ele_required_aftr">Father Phone</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="25" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="motherName" class="col-sm-5 col-form-label ele_required_aftr">Mother Name</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="28" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="motherPhone" class="col-sm-5 col-form-label">Mother Phone</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="30" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="GuardianName" class="col-sm-5 col-form-label">Guardian Name</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="33" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="guardianPhone" class="col-sm-5 col-form-label">Guardian Phone</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="36" class="form-control">
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="fatherOccupation" class="col-sm-5 col-form-label ele_required_aftr">Occupation</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="23" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fatherEmail" class="col-sm-5 col-form-label">Father E-mail</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="motherOccupation" class="col-sm-5 col-form-label">Occupation</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="29" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="motherEmail" class="col-sm-5 col-form-label">E-mail</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="guardianOccupation" class="col-sm-5 col-form-label">Occupation</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="34" class="form-control">
                                                </div>
                                            </div>                        
                                            <div class="form-group row">
                                                <label for="guardianEmail" class="col-sm-5 col-form-label ele_required_aftr">E-mail</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="fatherAnnualIncome" class="col-sm-5 col-form-label ele_required_aftr">Annual Income</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="24" class="form-control">
                                                </div>
                                            </div>                        
                                            <div class="form-group row">
                                                <label for="pan" class="col-sm-5 col-form-label"> </label>
                                                <div class="col-sm-7">
                                                    <div class="form-control fakeField"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="motherAnnualIncome" class="col-sm-5 col-form-label">Annual Income</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="27" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="pan" class="col-sm-5 col-form-label"> </label>
                                                <div class="col-sm-7">
                                                    <div class="form-control fakeField"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="guardianAnnualIncome" class="col-sm-5 col-form-label">Annual Income</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="35" class="form-control">
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="float-left">
                                        <i class="fas fa-exclamation-triangle text-danger"></i> <i>Fields marked with an <span class="text-red">*</span> are mandatory</i>                                            
                                    </span>
                                    <span><input type="submit" class="btn btn-sm btn-default float-right" id="" value="Next"></span>
                                    <span><input type="submit" class="btn btn-sm btn-primary float-right marginR5" id="" value="Save"></span>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">

                        <div class="card card-warning">
                            <form class="form-horizontal">
                                <div class="card-header text-left text-bold">Education Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="previousEducation" class="col-sm-5 col-form-label ele_required_aftr">Previous Education</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="1" tabindex="1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="board" class="col-sm-5 col-form-label ele_required_aftr">Board/University</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="25" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="totalmarks" class="col-sm-5 col-form-label ele_required_aftr">Total Marks </label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="28" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="class" class="col-sm-5 col-form-label">Class</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="30" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="state" class="col-sm-5 col-form-label ele_required_aftr">State</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="33" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="resultType" class="col-sm-5 col-form-label ele_required_aftr">Result Type</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="23" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="institution" class="col-sm-5 col-form-label ele_required_aftr">Institution</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="26" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="marksObtained" class="col-sm-5 col-form-label ele_required_aftr">Marks Obtained</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="29" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="passingYear" class="col-sm-5 col-form-label ele_required_aftr">Passing Year</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="31" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-5 col-form-label"></label>
                                                <div class="col-sm-7 text-left">
                                                    <button class="btn btn-sm btn-primary">SUBJECT-WISE PERCENTAGE</button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="pan" class="col-sm-5 col-form-label"> </label>
                                                <div class="col-sm-7">
                                                    <div class="form-control fakeField"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="registrationNo" class="col-sm-5 col-form-label ele_required_aftr">Registration No.</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="24" class="form-control">
                                                </div>
                                            </div>   
                                            <div class="form-group row">
                                                <label for="percentage" class="col-sm-5 col-form-label ele_required_aftr">Percentage(%)</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="27" class="form-control">
                                                </div>
                                            </div>                        
                                            <div class="form-group row">
                                                <label for="placeOfStudy" class="col-sm-5 col-form-label ele_required_aftr">Place Of Study</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="35" class="form-control">
                                                </div>
                                            </div> 
                                            <div class="form-group row">
                                                <label for="pan" class="col-sm-5 col-form-label"> </label>
                                                <div class="col-sm-7">
                                                    <div class="form-control fakeField"></div>
                                                </div>
                                            </div>                                                           
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="float-left">
                                        <i class="fas fa-exclamation-triangle text-danger"></i> <i>Fields marked with an <span class="text-red">*</span> are mandatory</i>                                            
                                    </span>
                                    <span><input type="submit" class="btn btn-sm btn-default float-right" id="" value="Next"></span>
                                    <span><input type="submit" class="btn btn-sm btn-warning float-right marginR5" id="" value="Reset"></span>
                                    <span><input type="submit" class="btn btn-sm btn-primary float-right marginR5" id="" value="Save"></span>
                                </div>
                            </form>
                        </div>

                        <div class="card card-warning card-outline col-12">
                            <div class="card-header">
                                <h3 class="card-title">Education Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>           
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Previous Education</th>
                                            <th>Board/University</th>
                                            <th>institution(s)</th>
                                            <th>State</th>
                                            <th>Total Marks</th>
                                            <th>Percentage</th>
                                            <th>Subject-wise Percentage</th>
                                            <th>Grade</th>
                                            <th>Passing Year</th>
                                            <th>Registration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BE</td>
                                            <td>BPUT</td>
                                            <td>BPUT</td>
                                            <td>Odisha</td>
                                            <td>1000</td>
                                            <td>90%</td>
                                            <td></td>
                                            <td>A</td>
                                            <td>2009</td>
                                            <td>ABC0012589</td>
                                            <td><a href="#"><span class="fas fa-edit"></span></a></td>
                                        </tr>                                                                     
                                    </tbody>                                
                                </table>
                            </div>                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab"> 
                        <div class="card card-warning">
                            <form class="form-horizontal">
                                <div class="card-header text-left text-bold">Address Details</div>
                                <div class="card-body">
                                    <div class="row">                                       
                                        <div class="col-sm-5">
                                            <div class="card border-secondary">
                                                <div class="card-header text-left text-bold">Correspondence Address Details</div>
                                                <div class="card-body text-secondary">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="addressType" class="col-sm-5 col-form-label ele_required_aftr">Address Type</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="address1" class="col-sm-5 col-form-label ele_required_aftr">Address 1</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="address2" class="col-sm-5 col-form-label ele_required_aftr">Address 2</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="street" class="col-sm-5 col-form-label">Street</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="landmark" class="col-sm-5 col-form-label">Landmark</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="country" class="col-sm-5 col-form-label">Country</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="state" class="col-sm-5 col-form-label">State</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="city" class="col-sm-5 col-form-label">City</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="pincode" class="col-sm-5 col-form-label">Pincode</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="mobile" class="col-sm-5 col-form-label">Mobile/Landline</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <a class="btn btn-lg btn-default">
                                                <span>DO </span>
                                                <span><i class="fas fa-angle-double-right"></i></span>
                                            </a>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="card border-secondary">
                                                <div class="card-header text-left text-bold">Permanent Address Details</div>
                                                <div class="card-body text-secondary">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="addressType" class="col-sm-5 col-form-label ele_required_aftr">Address Type</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="address1" class="col-sm-5 col-form-label ele_required_aftr">Address 1</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="address2" class="col-sm-5 col-form-label ele_required_aftr">Address 2</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="street" class="col-sm-5 col-form-label">Street</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="landmark" class="col-sm-5 col-form-label">Landmark</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="country" class="col-sm-5 col-form-label">Country</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="state" class="col-sm-5 col-form-label">State</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="city" class="col-sm-5 col-form-label">City</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="pincode" class="col-sm-5 col-form-label">Pincode</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="mobile" class="col-sm-5 col-form-label">Mobile/Landline</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" tabindex="23" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="float-left">
                                        <i class="fas fa-exclamation-triangle text-danger"></i> <i>Fields marked with an <span class="text-red">*</span> are mandatory</i>                                            
                                    </span>
                                    <span><input type="submit" class="btn btn-sm btn-default float-right" id="" value="Next"></span>
                                    <span><input type="submit" class="btn btn-sm btn-warning float-right marginR5" id="" value="Reset"></span>
                                    <span><input type="submit" class="btn btn-sm btn-primary float-right marginR5" id="" value="Save"></span>
                                </div>
                            </form>
                        </div>

                        <div class="card card-warning card-outline col-12">
                            <div class="card-header">
                                <h3 class="card-title">Address Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>           
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Address Type</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Phone</th>                                                
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Correspondence</td>
                                            <td>Hubli</td>
                                            <td>Hubli</td>
                                            <td>Karnataka</td>
                                            <td>India</td>
                                            <td>9885214587</td>                                               
                                            <td>
                                                <a href="#" class="text-primary"><span class="fas fa-edit"></span></a>
                                                <a href="#" class="text-danger"><span class="fas fa-trash-alt"></span></a>
                                            </td>
                                        </tr>                                                                     
                                    </tbody>                                
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                        <div class="card card-warning">
                            <form class="form-horizontal">
                                <div class="card-header text-left text-bold">Ceritficate Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="certificateType" class="col-sm-5 col-form-label ele_required_aftr">Certificate Type</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="1" tabindex="1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="board" class="col-sm-5 col-form-label ele_required_aftr">File</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input hand_cursor" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text btn-warning hand_cursor" id="">
                                                                <i class="fas fa-upload"></i>&nbsp;Upload
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="certificate" class="col-sm-5 col-form-label ele_required_aftr">Certificate</label>
                                                <div class="col-sm-7">
                                                    <input type="email" tabindex="31" class="form-control">
                                                </div>
                                            </div>                                            
                                        </div>                                        

                                    </div>

                                </div>
                                <div class="card-footer">
                                    <span class="float-left">
                                        <i class="fas fa-exclamation-triangle text-danger"></i> <i>Fields marked with an <span class="text-red">*</span> are mandatory</i>                                            
                                    </span>
                                    <span><input type="submit" class="btn btn-sm btn-default float-right" id="" value="Next"></span>
                                    <span><input type="submit" class="btn btn-sm btn-primary float-right marginR5" id="" value="Save"></span>
                                </div>
                            </form>
                        </div>

                        <div class="card card-warning card-outline col-12">
                            <div class="card-header">
                                <h3 class="card-title">Ceritficate Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>           
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Certificate Type</th>
                                            <th>Certificate</th>
                                            <th>Certificate File Name</th>                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Regular</td>
                                            <td>BTech.</td>
                                            <td>btech.png</td>                                            
                                            <td><a href="#"><span class="fas fa-edit"></span></a></td>
                                        </tr>                                                                     
                                    </tbody>                                
                                </table>
                            </div>                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
    $(function () {
        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        // $('.chosen-select').chosen({allow_single_deselect: true, disable_search: true,width:'100%'});
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            minimumResultsForSearch: 'Infinity',
            allowClear: true,
            placeholder: 'Select Gender'

        });
        $('.blood-group-select').select2({
            theme: 'bootstrap4',
            minimumResultsForSearch: 'Infinity',
            allowClear: true,
            placeholder: {
                id: "", // the value of the option
                text: 'Select Blood Group'
            }
        });
        $('.cast-select').select2({
            theme: 'bootstrap4',
            minimumResultsForSearch: 'Infinity',
            allowClear: true,
            placeholder: {
                id: "", // the value of the option
                text: 'Select Cast'
            }
        });
        $('.physical-challenged').select2({
            theme: 'bootstrap4',
            minimumResultsForSearch: 'Infinity',
            allowClear: true,
            placeholder: {
                id: "", // the value of the option
                text: 'Select One'
            }
        });
        $('.religion').select2({
            theme: 'bootstrap4',
            minimumResultsForSearch: 'Infinity',
            allowClear: true,
            placeholder: {
                id: "", // the value of the option
                text: 'Select Religion'
            }
        });
    });
</script>