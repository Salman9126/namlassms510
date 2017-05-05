<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/template/header');
$this->load->view('admin/template/inner-header');
?>
<div class="content">
  	<div class="container">
  		<?php $this->load->view('admin/template/left-nav');?>
		<?php $this->load->view('admin/'.$view); ?>
	</div>
</div>
<?php
$this->load->view('admin/template/inner-footer');
$this->load->view('admin/template/footer');	
?>