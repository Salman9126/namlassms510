<!-- start: Main Menu -->
<div class="vd_navbar vd_nav-width vd_navbar-tabs-menu vd_navbar-left  ">
    
    <div class="navbar-menu clearfix">
        <div class="vd_panel-menu hidden-xs">
            <span data-original-title="Expand All" data-toggle="tooltip" data-placement="bottom" data-action="expand-all" class="menu" data-intro="<strong>Expand Button</strong><br/>To expand all menu on left navigation menu." data-step=4 >
                <i class="fa fa-sort-amount-asc"></i>
            </span>
        </div>
        <h3 class="menu-title hide-nav-medium hide-nav-small">Menu</h3>
        <div class="vd_menu">
            <ul>
                <li>
                    <a href="<?php echo base_url('admin/dashboard');?>">
                        <span class="menu-icon"><i class="fa fa-dashboard"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-action="click-trigger">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Member's</span>
                        <!-- <span class="menu-badge"><span class="badge vd_bg-red">78</span></span> -->
                        <span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <div class="child-menu"  data-action="click-target">
                        <ul>
                            <li>
                                <a href="<?php echo base_url('admin/members/committeeMembers');?>">
                                    <span class="menu-text">Committee Members</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/members/normalMembers');?>">
                                    <span class="menu-text">Normal Members</span>
                                    <span class="menu-badge"><span class="badge vd_bg-red">Hot</span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/banners');?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Banner's</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/flats');?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Flat's</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Maintenance</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Events</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>">
                        <span class="menu-icon"><i class="icon-tools"></i></span>
                        <span class="menu-text">Manage Assets</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Enquiry & Querries</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Gym</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>">
                        <span class="menu-icon"><i class="fa fa-envelope"></i></span>
                        <span class="menu-text">Manage Garden</span>
                        <span class="menu-badge"><span class="badge vd_bg-red">78</span></span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url();?>assets/backend/javascript:void(0);" data-action="click-trigger">
                        <span class="menu-icon"><i class="icon-palette"> </i></span>
                        <span class="menu-text">Skin Playground</span>
                        <span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <div class="child-menu"  data-action="click-target">
                        <ul>
                            <li>
                                <a href="<?php echo base_url();?>assets/backend/skin-clean-minimalist.html">
                                    <span class="menu-text">Clean Minimalist Nav</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>assets/backend/skin-nav-medium-profile-dark.html">
                                    <span class="menu-text">Dark Medium Navbar</span>
                                    <span class="menu-badge"><span class="badge vd_bg-red">Hot</span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
            </ul>
            <!-- Head menu search form ends -->         </div>
        </div>
        <div class="navbar-spacing clearfix">
        </div>
        <div class="vd_menu vd_navbar-bottom-widget">
            <ul>
                <li>
                    <a href="<?php echo base_url('admin/dashboard/logout');?>">
                        <span class="menu-icon"><i class="fa fa-sign-out"></i></span>
                        <span class="menu-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Right Side Bar Always Hide -->
    <div class="vd_navbar vd_nav-width vd_navbar-chat vd_bg-black-80 vd_navbar-right" style="display:none;">
        <div class="navbar-tabs-menu clearfix">
            <span class="expand-menu" data-action="expand-navbar-tabs-menu">
                <span class="menu-icon menu-icon-left">
                    <i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>
                </span>
                <span class="menu-icon menu-icon-right">
                    <i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>
                </span>
            </span>
            <div class="menu-container">
                <div class="navbar-search-wrapper">
                    <div class="navbar-search vd_bg-black-30">
                        <span class="append-icon"><i class="fa fa-search"></i></span>
                        <input type="text" placeholder="Search" class="vd_menu-search-text no-bg no-bd vd_white width-70" name="search">
                        <div class="pull-right search-config">
                            <a  data-toggle="dropdown" href="<?php echo base_url();?>assets/backend/javascript:void(0);" class="dropdown-toggle" ><span class="prepend-icon vd_grey"><i class="fa fa-cog"></i></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0);">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-menu clearfix">
            <div class="content-list content-image content-chat">
                <ul class="list-wrapper no-bd-btm pd-lr-10">
                    <li class="group-heading vd_bg-black-20">FAVORITE</li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar.jpg" alt="example image"></div>
                            <div class="menu-text">Jessylin
                                <div class="menu-info">
                                    <span class="menu-date">Administrator </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-2.jpg" alt="example image"></div>
                            <div class="menu-text">Rodney Mc.Cardo
                                <div class="menu-info">
                                    <span class="menu-date">Designer </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="badge status vd_bg-grey">&nbsp;</span></div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-3.jpg" alt="example image"></div>
                            <div class="menu-text">Theresia Minoque
                                <div class="menu-info">
                                    <span class="menu-date">Engineering </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
                        </a>
                    </li>
                    <li class="group-heading vd_bg-black-20">FRIENDS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-4.jpg" alt="example image"></div>
                            <div class="menu-text">Greg Grog
                                <div class="menu-info">
                                    <span class="menu-date">Developer </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="badge status vd_bg-grey">&nbsp;</span></div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-5.jpg" alt="example image"></div>
                            <div class="menu-text">Stefanie Imburgh
                                <div class="menu-info">
                                    <span class="menu-date">Dancer</span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="vd_grey font-sm"><i class="fa fa-mobile"></i></span></div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-6.jpg" alt="example image"></div>
                            <div class="menu-text">Matt Demon
                                <div class="menu-info">
                                    <span class="menu-date">Musician </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="vd_grey font-sm"><i class="fa fa-mobile"></i></span></div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-7.jpg" alt="example image"></div>
                            <div class="menu-text">Jeniffer Anastasia
                                <div class="menu-info">
                                    <span class="menu-date">Senior Developer </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="menu-icon"><img src="<?php echo base_url();?>assets/backend/img/avatar/avatar-8.jpg" alt="example image"></div>
                            <div class="menu-text">Daniel Dreamon
                                <div class="menu-info">
                                    <span class="menu-date">Sales Executive </span>
                                </div>
                            </div>
                            <div class="menu-badge"><span class="badge status vd_bg-green">&nbsp;</span></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-spacing clearfix">
        </div>
    </div>
    <!-- end: Main Menu -->