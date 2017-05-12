<!--Middle Content Start -->
<div class="vd_content-wrapper">
  <div class="vd_container">
    <div class="vd_content clearfix">
      <div class="vd_head-section clearfix">
        <div class="vd_panel-header">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Dashboard</a></li>
            <li class="active">Banners</li>
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
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Banners Information </h3>
                </div>
                <div class="panel-body table-responsive">
                  <div class="row">
                    <div class="col-md-offset-8 col-md-4">
                    <!-- data-toggle="modal" data-target="#myModal" -->
                      <a href="javascript:void(0);" class="btn vd_btn vd_round-btn btn-xs vd_bg-green mgr-10 pull-right" onclick="add_banner_pop_up();" ><i class="fa fa-plus fa-fw"></i></a>
                    </div>
                  </div>
                  <form action="<?php echo base_url();?>admin/banners/multiselect_action" method="post" name="myform" id="myform">
                    <table class="table table-striped" id="data-tables">
                      <thead>
                        <tr>
                          <tr>
                              <th><input type="checkbox" id="check"></th>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Banner</th>
                              <th>Created</th>
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
          <h4 class="modal-title" id="myModalLabel">Banner Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="#" role="form" id="add-new-banner" enctype="multipart/form-data">
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
                <label class="control-label col-sm-4">Name<span class="vd_red">*</span>:</label>
                <div id="first-name-input-wrapper"  class="controls col-sm-6">
                  <input type="text" placeholder="Name" class="required" name="name" id="name" required >
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-sm-4 control-label">Banner<span class="vd_red">*</span>:</label>
                <div class="col-sm-6 controls">
                  <input type="file" name="banner" id="banner">
                </div>
              </div>
            </div>
            <input type="hidden" name="bannerId" id="bannerId">
            
            <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-md-6 mgbt-xs-10 mgtp-20">
                <div class="mgtp-10 pull-right">
                  <button class="btn vd_bg-green vd_white" type="submit" id="submit-banner" name="submit-banner" value="Register">Submit</button>
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