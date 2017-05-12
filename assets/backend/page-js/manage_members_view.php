<!--Middle Content Start -->
<div class="vd_content-wrapper">
  <div class="vd_container">
    <div class="vd_content clearfix">
      <div class="vd_head-section clearfix">
        <div class="vd_panel-header">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Dashboard</a></li>
            <li class="active">Members</li>
          </ul>
          <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
            <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
            <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
            <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
          </div>
        </div>
      </div>
     <!--  <div class="vd_title-section clearfix">
        <div class="vd_panel-header">
          <h1>Flats</h1>
          <small class="subtitle">Look <a href="javascript:void(0);">datatables.net</a> for more information</small> 
        </div>
        </div> -->
        <div class="vd_content-section clearfix">
          <div class="row">
            <div class="col-md-12">
              <div class="panel widget">
                <div class="panel-heading vd_bg-grey">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Members Information </h3>
                </div>
                <div class="panel-body table-responsive">
                  <div class="row">
                    <div class="col-md-offset-8 col-md-4">
                    <!-- data-toggle="modal" data-target="#myModal" -->
                      <a href="javascript:void(0);" class="btn vd_btn vd_round-btn btn-xs vd_bg-green mgr-10 pull-right" onclick="add_member_pop_up();" ><i class="fa fa-plus fa-fw"></i></a>
                    </div>
                  </div>
                  <form action="<?php echo base_url();?>admin/members/multiselect_action" method="post" name="myform" id="myform">
                    <table class="table table-striped" id="data-tables">
                      <thead>
                        <tr>
                          <tr>
                              <th><input type="checkbox" id="check"></th>
                              <th>ID</th>
                              <th>Flat No</th>
                              <th>Name</th>
                              <th>Contact No.</th>
                              <th>Email ID</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </tr>
                      </thead>
                    </table>
                      <div class="row">
                        <div class="col-md-12">

                              <div class="col-md-3">
                                    <select name="listaction" id="listaction" class="allselect form-control input-sm" style="float: left;" >
                                    <option value=""> Select Action</option>
                                    <option value="1"> Activate</option>
                                    <option value="2"> Deactivate</option>
                                    <option value="3"> Delete</option>
                                    </select>
                              </div>
                        <div class="col-md-2">
                              <input type="submit" name="submit" value="Go" onclick="return validateForm();" class="btn btn-info-night" style="float: left;" >
                        </div>
                        <div class="col-md-6">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Panel Widget -->
            </div>
            <!-- col-md-12 -->
          </div>
          <!-- row -->
        </div>
        <!-- .vd_content-section -->
      </div>
      <!-- .vd_content -->
    </div>
    <!-- .vd_container -->
  </div>
  <!-- .vd_content-wrapper -->
<!-- Middle Content End -->


<!-- START: Add New Flat  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header vd_bg-blue vd_white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
          <h4 class="modal-title" id="myModalLabel">Member Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="#" role="form" id="add-new-flat-member" enctype="multipart/form-data">
            <div class="alert alert-danger vd_hidden">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
              <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Change a few things up and try submitting again. 
            </div>
            <div class="alert alert-success vd_hidden">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
              <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>. 
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4" >Select Flat Number<span class="vd_red">*</span>:</label>
                <div id="email-input-wrapper"  class="controls col-sm-6">
                  <select class="required" required  name="flatNo" id="flatNo">
                    <option value="">Select Flat Number</option>
                    <?php 
                    if(!empty($flats)){
                      foreach ($flats as $val) {
                        ?>
                        <option value="<?php echo $val['flatNo'];?>"><?php echo $val['flatNo'];?></option>
                        <?php
                      }
                    }else{
                      ?>
                      <option value="">Flat Not Available</option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4" >Select Member Type<span class="vd_red">*</span>:</label>
                <div id="email-input-wrapper"  class="controls col-sm-6">
                  <select class="required memberType1" required  name="memberType" id="memberType" >
                    <option value="">Select Member Type</option>
                    <option value="1" id="Owner">Owner</option>
                    <option value="2" id="Family">Family</option>
                    <option value="3" id="Rental">Rental</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4">First Name<span class="vd_red">*</span>:</label>
                <div id="first-name-input-wrapper"  class="controls col-sm-6">
                  <input type="text" placeholder="First Name" class="required" name="firstName" id="firstName" required >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label  col-sm-4">Middle Name <span class="vd_red">*</span>:</label>
                <div id="company-input-wrapper" class="controls col-sm-6">
                  <input type="text" placeholder="Middle Name" class="required" required  name="middleName" id="middleName">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4">Last Name<span class="vd_red">*</span>:</label>
                <div id="website-input-wrapper"  class="controls col-sm-6">
                  <input type="text" placeholder="Last Name" class="required" required name="lastName" id="lastName" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4">Contact No.<span class="vd_red">*</span>:</label>
                <div id="website-input-wrapper"  class="controls col-sm-6">
                  <input type="text" placeholder="Contact Number" class="required" required name="contactNo" id="contactNo" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4">Alternate Contact No.:</label>
                <div id="website-input-wrapper"  class="controls col-sm-6">
                  <input type="text" placeholder="Alternate Contact Number" name="alternateNo" id="alternateNo" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label col-sm-4">Email ID<span class="vd_red">*</span>:</label>
                <div id="website-input-wrapper"  class="controls col-sm-6">
                  <input type="email" placeholder="example@gmail.com" class="required" required name="emailId" id="emailId" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-sm-4 control-label">Photo<span class="vd_red">*</span>:</label>
                <div class="col-sm-6 controls">
                  <input type="file" name="photo" id="photo">
                </div>
              </div>
            </div>
            <!-- <input type="hidden" class="memberType2" name="memberType" id="memberType" value="1"> -->
            <input type="hidden" name="parentFlatID" id="parentFlatID" value="">
            <input type="hidden" name="memberId" id="memberId">
            <!-- <div style="display:none;">
              <div class="row">
                <div class="col-md-6">
                  <h3>Members</h3>
                </div>
                <div class="col-md-6">
                  <a href="javascript:void(0);" class="btn vd_btn vd_bg-green pull-right" id="addMember">Add Member</a>
                </div>
              </div>
              <div class="table-responsive" id="add-new-member">
                <input type="hidden" value="1" name="rowCnt" id="rowCnt">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th> First Name </th>
                      <th> Last Name </th>
                      <th> Contact No. </th>
                      <th> Email ID </th>
                      <th> Photo </th>
                      <th> Member Type </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody id="add-new-member-row">
                  </tbody>
                </table>
              </div>
            </div> -->
            <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-md-6 mgbt-xs-10 mgtp-20">
                <div class="mgtp-10 pull-right">
                  <button class="btn vd_bg-green vd_white" type="submit" id="submit-register-flat-member" name="submit-register-flat-member" value="Register">Submit</button>
                  <button class="btn vd_btn" id="reset" type="reset" name="reset">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- <div class="modal-footer background-login">
          <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Yes</button>
          <button type="button" class="btn vd_btn vd_bg-green"  data-dismiss="modal">No</button>
        </div> -->
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<!-- END: Add New Flat -->