<!-- start: JavaScript-->
<!-- Javascript =============================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/jquery.js"></script>
<!--[if lt IE 9]>
  <script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/excanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src='plugins/jquery-ui/jquery-ui.custom.min.js'></script> -->

<!--<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/caroufredsel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/plugins.js"></script>-->

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/breakpoints/breakpoints.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/dataTables/dataTables.bootstrap.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/tagsInput/jquery.tagsinput.min.js"></script>-->

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/blockUI/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/plugins/pnotify/js/jquery.pnotify.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/theme.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/custom/custom.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/plugins.js"></script>


<?php if($this->uri->segment(2) == 'dashboard'){ ?>
<script type="text/javascript">
$(window).load(function ()
	{
		$.fn.UseTooltip = function () {
			var previousPoint = null;

			$(this).bind("plothover", function (event, pos, item) {
					if (item) {
						if (previousPoint != item.dataIndex) {

							previousPoint = item.dataIndex;

							$("#tooltip").remove();
							var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);

							showTooltip(item.pageX, item.pageY,
								"<p class='vd_bg-green'><strong class='mgr-10 mgl-10'>" + Math.round(x)  + " NOV 2013 </strong></p>" +
								"<div style='padding: 0 10px 10px;'>" +
								"<div>" + item.series.label +": <strong>"+ Math.round(y)  +"</strong></div>" +
								"<div> Profit: <strong>$"+ Math.round(y)*7  +"</strong></div>" +
								"</div>"
							);
						}
					} else {
						$("#tooltip").remove();
						previousPoint = null;
					}
			});
		};

		function showTooltip(x, y, contents) {
			$('<div id="tooltip">' + contents + '</div>').css({
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 20,
				size: '10',
//				'border-top' : '3px solid #1FAE66',
				'background-color': '#111111',
				color: "#FFFFFF",
				opacity: 0.85
			}).appendTo("body").fadeIn(200);
		}

/* News Widget */
	   $(".vd_news-widget .vd_carousel").carouFredSel({
			prev:{
				button : function()
				{
					return $(this).parent().parent().children('.vd_carousel-control').children('a:first-child')
				}
			},
			next:{
				button : function()
				{
					return $(this).parent().parent().children('.vd_carousel-control').children('a:last-child')
				}
			},
			scroll: {
				fx: "crossfade",
				onBefore: function(){
						var target = "#front-1-clients";
						$(target).css("transition","all .5s ease-in-out 0s");
					if ($(target).hasClass("vd_bg-soft-yellow")){
						$(target).removeClass("vd_bg-soft-yellow");
						$(target).addClass("vd_bg-soft-red");
					} else
					if ($(target).hasClass("vd_bg-soft-red")){
						$(target).removeClass("vd_bg-soft-red");
						$(target).addClass("vd_bg-soft-blue");
					} else
					if ($(target).hasClass("vd_bg-soft-blue")){
						$(target).removeClass("vd_bg-soft-blue");
						$(target).addClass("vd_bg-soft-green");
					} else
					if ($(target).hasClass("vd_bg-soft-green")){
						$(target).removeClass("vd_bg-soft-green");
						$(target).addClass("vd_bg-soft-yellow");
					}
				}
			},
			width: "auto",
			height: "responsive",
			responsive: true,
			auto:3000

		});
	// Notification
	  setTimeout(function() { notification("topright","notify","fa fa-exclamation-triangle vd_yellow","Welcome to Vendroid","Click on <i class='fa fa-question-circle vd_red'></i> Question Mark beside filter to take a view layout tour guide"); },1500)	 ;
});
</script>
<!-- Specific Page Scripts END -->
<!-- end: JavaScript-->
<?php 
} 
if($this->uri->segment(2) == 'members'){
?>
<!-- Page Javascript -->
<!-- Specific Page Scripts Put Here -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/page-js/members.js"></script>
<!-- Page Javascript -->
<?php
}
if($this->uri->segment(2) == 'flats'){
?>
<!-- Page Javascript -->
<!-- Specific Page Scripts Put Here -->
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/page-js/flats.js"></script>
<!-- Page Javascript -->
<?php
}
?>	
</body>
</html>
