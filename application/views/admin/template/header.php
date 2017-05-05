<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html><!--<![endif]-->

<!-- Specific Page Data -->

<!-- End of Data -->

<head>
    <meta charset="utf-8" />
    <title><?php echo $page_title;?></title>
    <meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template, " />
    <meta name="description" content="Responsive Admin Template for multipurpose use">
    <meta name="author" content="Venmond">

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

    <!-- Plugin CSS -->
    <link href="<?php echo base_url();?>assets/backend/plugins/jquery-ui/jquery-ui.custom.min.css" rel="stylesheet" type="text/css">
    <!--<link href="<?php echo base_url();?>assets/backend/plugins/prettyPhoto-plugin/css/prettyPhoto.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/isotope/css/isotope.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/pnotify/css/jquery.pnotify.css" media="screen" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/backend/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"> -->


    <link href="<?php echo base_url();?>assets/backend/plugins/mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/tagsInput/jquery.tagsinput.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/bootstrap-switch/bootstrap-switch.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css">

	<!-- Specific CSS -->
	<!-- <link href="<?php echo base_url();?>assets/backend/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css"><link href="<?php echo base_url();?>assets/backend/plugins/introjs/css/introjs.min.css" rel="stylesheet" type="text/css"> -->

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
    <link href="<?php echo base_url();?>assets/backend/plugins/dataTables/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/backend/plugins/dataTables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <?php 
    if($this->uri->segment(2) == 'members'){
    ?>
    <!-- Page Javascript -->
    <!-- Specific Page Scripts Put Here -->
    <link href="<?php echo base_url();?>assets/backend/page-css/members.css" rel="stylesheet" type="text/css">
    <!-- Page Javascript -->
    <?php
    } ?>


</head>

<body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed responsive clearfix" data-active="dashboard "  data-smooth-scrolling="1">
<input type="hidden" id="base_url" name="base_url" value="<?php echo base_url();?>">
<div class="vd_body">