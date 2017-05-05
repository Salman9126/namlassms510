<!DOCTYPE html>
<!--[if IE 8]>      <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>      <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html><!--<![endif]-->

<!-- Specific Page Data -->

<!-- End of Data -->

<head>
    <meta charset="utf-8" />
    <title><?php //echo $pageTitle; ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="<?php //echo $pageTitle; ?>">
    <meta name="author" content="Salman">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/backend/img/ico/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/backend/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/backend/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/backend/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/backend/img/ico/favicon.png">


    <!-- CSS -->

    <!-- Bootstrap & FontAwesome & Entypo CSS -->
    <link href="<?php echo base_url();?>assets/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if IE 7]><link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/font-awesome-ie7.min.css"><![endif]-->
    <link href="<?php echo base_url();?>assets/backend/css/font-entypo.css" rel="stylesheet" type="text/css">

    <!-- Fonts CSS -->
    <link href="<?php echo base_url();?>assets/backend/css/fonts.css"  rel="stylesheet" type="text/css">
    
    <!-- Specific CSS -->

    <!-- Theme CSS -->
    <link href="<?php echo base_url();?>assets/backend/css/theme.min.css" rel="stylesheet" type="text/css">
    <!--[if IE]> <link href="<?php echo base_url();?>assets/backend/css/ie.css" rel="stylesheet" > <![endif]-->
    <link href="<?php echo base_url();?>assets/backend/css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->

    <!-- Responsive CSS -->
      <link href="<?php echo base_url();?>assets/backend/css/theme-responsive.min.css" rel="stylesheet" type="text/css">
    
    <!-- for specific page in style css -->

    <!-- for specific page responsive in style css -->

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/backend/custom/custom.css" rel="stylesheet" type="text/css">

    <!-- Head SCRIPTS -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/mobile-detect.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/mobile-detect-modernizr.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/html5shiv.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/respond.min.js"></script>
    <![endif]-->

</head>

<body id="pages" class="full-layout no-nav-left no-nav-right  nav-top-fixed background-login     responsive remove-navbar login-layout   clearfix" data-active="pages "  data-smooth-scrolling="1">
<div class="vd_body">
<!-- Header Start -->

<!-- Header Ends -->
<div class="content">
  <div class="container">

    <!-- Middle Content Start -->

    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <?php if($this->session->flashdata('success'))
            {
            ?>
          <div class="vd_panel-header">
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
              <i class="fa fa-exclamation-circle append-icon"></i><strong>Well done!</strong> <a class="alert-link" href="<?php echo base_url();?>assets/backend/#"><?php echo $this->session->flashdata('success');?> </a>
            </div>
          </div>
          <?php
            }
            elseif($this->session->flashdata('error'))
            {
            ?>
          <div class="vd_panel-header">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
              <i class="fa fa-exclamation-circle append-icon"></i><strong>Oh snap!</strong> <a class="alert-link" href="<?php echo base_url();?>assets/backend/#"><?php echo $this->session->flashdata('error');?></a>
            </div>
          </div>
          <?php } ?>
          <div class="vd_content-section clearfix">
            <div class="vd_login-page">
              <div class="heading clearfix">
                <div class="logo">
                  <h2 class="mgbt-xs-5"><img src="<?php echo base_url();?>assets/backend/img/logo.png" alt="logo"></h2>
                </div>
                <h4 class="text-center font-semibold vd_grey">LOGIN TO YOUR ACCOUNT</h4>
              </div>
              <div class="panel widget">
                <div class="panel-body">
                  <div class="login-icon entypo-icon"> <i class="icon-key"></i> </div>
                  <form class="form-horizontal" id="login-form" action="#" method="post" role="form">
                  <div class="alert alert-danger vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Please correct following errors and try submiting it again. </div>
                  <div class="alert alert-success vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>. </div>
                    <div class="form-group  mgbt-xs-20">
                      <div class="col-md-12">
                        <div class="label-wrapper sr-only">
                          <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="vd_input-wrapper" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>
                          <input type="email" placeholder="Email" id="email" name="email" class="required">
                        </div>
                        <div class="label-wrapper">
                          <label class="control-label sr-only" for="password">Password</label>
                        </div>
                        <div class="vd_input-wrapper" id="password-input-wrapper" > <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                          <input type="password" placeholder="Password" id="password" name="password" class="required">
                        </div>
                      </div>
                    </div>
                    <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center mgbt-xs-5">
                        <button class="btn vd_bg-green vd_white width-100" type="submit" id="login-submit">Login</button>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-xs-12 text-right">
                            <div class=""> <a href="<?php echo base_url();?>assets/backend/<?php echo base_url();?>login/forgot_password">Forgot Password ?</a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Panel Widget -->
              <div class="register-panel text-center font-semibold"> <a href="<?php echo base_url();?>assets/backend/pages-register.html">CREATE AN ACCOUNT<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div>
            </div>
            <!-- vd_login-page -->

          </div>
          <!-- .vd_content-section -->

        </div>
        <!-- .vd_content -->
      </div>
      <!-- .vd_container -->
    </div>
    <!-- .vd_content-wrapper -->

    <!-- Middle Content End -->

  </div>
  <!-- .container -->
</div>
<!-- .content -->

<!-- Footer Start -->
  <footer class="footer-2"  id="footer">
    <div class="vd_bottom ">
        <div class="container">
            <div class="row">
              <div class=" col-xs-12">
                <div class="copyright text-center">
                    Copyright &copy;2017 Sam Technology. All Rights Reserved
                </div>
              </div>
            </div><!-- row -->
        </div><!-- container -->
    </div>
  </footer>
<!-- Footer END -->

</div>

<!-- .vd_body END  -->
<a id="back-top" href="<?php echo base_url();?>assets/backend/#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<!--
<a class="back-top" href="<?php echo base_url();?>assets/backend/#" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->

<!-- Javascript =============================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/jquery.js"></script>
<!--[if lt IE 9]>
  <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/excanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/bootstrap.min.js"></script>
<script type="text/javascript" src='<?php echo base_url();?>assets/backend/plugins/jquery-ui/jquery-ui.custom.min.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/caroufredsel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/plugins.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/breakpoints/breakpoints.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/tagsInput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/blockUI/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/pnotify/js/jquery.pnotify.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/theme.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/custom/custom.js"></script>
<!-- Specific Page Scripts Put Here -->

<script type="text/javascript">
          $(document).ready(function() {

                  "use strict";
                  var form_register_2 = $('#login-form');
                  var error_register_2 = $('.alert-danger', form_register_2);
                  var success_register_2 = $('.alert-success', form_register_2);
                  form_register_2.validate({
                      errorElement: 'div', //default input error message container
                      errorClass: 'vd_red', // default input error message class
                      focusInvalid: false, // do not focus the last invalid input
                      ignore: "",
                      rules: {
                          email: {
                              required: true,
                              email: true
                          },
                          password: {
                              required: true,
                              minlength: 6
                          },
                      },
                      errorPlacement: function(error, element) {
                          if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){
                              element.parent().append(error);
                          } else if (element.parent().hasClass("vd_input-wrapper")){
                              error.insertAfter(element.parent());
                          }else {
                              error.insertAfter(element);
                          }
                      },
                      invalidHandler: function (event, validator) { //display error alert on form submit
                          success_register_2.hide();
                          error_register_2.show();
                      },
                      highlight: function (element) { // hightlight error inputs
                          $(element).addClass('vd_bd-red');
                          $(element).parent().siblings('.help-inline').removeClass('help-inline hidden');
                          if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {
                              $(element).siblings('.help-inline').removeClass('help-inline hidden');
                          }
                      },
                      unhighlight: function (element) { // revert the change dony by hightlight
                          $(element)
                              .closest('.control-group').removeClass('error'); // set error class to the control group
                      },
                      success: function (label, element) {
                                         label
                              .addClass('valid').addClass('help-inline hidden') // mark the current input as valid and display OK icon
                              .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                          $(element).removeClass('vd_bd-red');
                      },
                      submitHandler: function (form) {
                        $('.fa-spinner').remove();
                        $(form).find('#login-submit').prepend('<i class="fa fa-spinner fa-spin mgr-10"></i>');
                          submitForm();
                      }
                  });
          });
        </script>
<script>
          function submitForm(){
                          BASEURL='<?php echo base_url();?>';
                                      $('#login-submit').prop("disabled", true);
                                      var form_register_2 = $('#login-form');
                                      var error_register_2 = $('.alert-danger', form_register_2);
                                      var success_register_2 = $('.alert-success', form_register_2);
                                      var formData = $( "#login-form" ).serialize();

                                      $.ajax({
                                          url: BASEURL+"login",
                                          type: 'POST',
                                          data:  formData
                                      }).done(function(responce)
                                       {
                                       
                                                $('.fa-spinner').remove();
                                                  var data = jQuery.parseJSON(responce);
                                                  if(data.status=='error')
                                                  {
                                                      $.each(data.errorfields, function()
                                                      {
                                                          $.each(this, function(name, value)
                                                          {
                                                              $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');
                                                          });
                                                      });
                                                      $('#login-submit').prop("disabled", false);
                                                  }
                                                  else
                                                  {
                                                      if(data.status=='success')
                                                      {
                                                              $('.alert-success').show();
                                                              $('.alert-danger').hide();
                                                              $('.alert-success').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-check-circle append-icon"></i></span><strong>Well done! </strong>'+data.message+'. ');
                                                              document.getElementById("login-form").reset();
                                                              //alert("Hi");
                                                              window.location.href = BASEURL+'admin/dashboard';
                                                      }
                                                      else
                                                      {
                                                          if(data.status == 'fail')
                                                          {

                                                              $('.alert-danger').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap! </strong>'+data.message+'. ');
                                                              $('.fa-spinner').remove();
                                                              success_register_2.hide();
                                                              error_register_2.show();
                                                              $('#login-submit').prop("disabled", false);
                                                          }
                                                          else
                                                          {
                                                              $('.fa-spinner').remove();
                                                              success_register_2.hide();
                                                              error_register_2.show();
                                                              $('#login-submit').prop("disabled", false);
                                                          }
                                                        }
                                                  }
                                      }).fail(function( jqXHR, textStatus ) {
                                          alert( "Request failed: " + textStatus );
                                            $('#login-submit').prop("disabled", false);
                                      });
          }

        </script>
<!-- Specific Page Scripts END -->

</body>

</html>