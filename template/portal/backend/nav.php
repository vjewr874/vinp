<nav id="sidebar" aria-label="Main Navigation">
            <div class="bg-header-dark">
               <div class="content-header bg-white-10">
                  <a class="font-w600 text-white tracking-wide" href="index.html">
                  <span class="smini-visible">
                  Hi<span class="opacity-75">RE</span>
                  </span>
                  <span class="smini-hidden">
                  Hi<span class="opacity-75">RealEaste</span>
                  </span>
                  </a>
                  <div>
                     <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');" href="javascript:void(0)">
                     <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                     </a>
                     <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                     <i class="fa fa-times-circle"></i>
                     </a>
                  </div>
               </div>
            </div>
            <div class="js-sidebar-scroll">
               <div class="content-side">
                  <ul class="nav-main">
                     <li class="nav-main-item">
                        <a class="nav-main-link active" href="<?php echo XC_URL;?>/admin/">
                        <i class="nav-main-link-icon fa fa-location-arrow"></i>
                        <span class="nav-main-link-name">Tổng quan</span>
                        </a>
                     </li>
                     <li class="nav-main-heading">Tài khoản</li>
                     <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">Danh sách</span>
                        </a>
                        <ul class="nav-main-submenu">
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/customers">
                              <span class="nav-main-link-name">Khách hàng</span>
                              </a>
                           </li>
						   <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/users">
                              <span class="nav-main-link-name">Nhân viên</span>
                              </a>
                           </li>
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/users/history">
                              <span class="nav-main-link-name">Lịch sử giao dịch</span>
                              </a>
                           </li>
                           
                        </ul>
                     </li>
                     <li class="nav-main-item" style="display: none">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-boxes"></i>
                        <span class="nav-main-link-name">Phân quyền</span>
                        </a>
                        <ul class="nav-main-submenu">
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/users">
                              <span class="nav-main-link-name">Loại tài khoản</span>
                              </a>
                           </li>
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/users">
                              <span class="nav-main-link-name">Phần quyền nhân viên</span>
                              </a>
                           </li>
                           
                        </ul>
                     </li>
                     
                     <li class="nav-main-heading">Nội dung</li>
                     <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-flask"></i>
                        <span class="nav-main-link-name">Tin đăng</span>
                        </a>
                        <ul class="nav-main-submenu">
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/posts">
                              <span class="nav-main-link-name">Tất cả tin</span>
                              <span class="nav-main-link-badge badge badge-pill badge-success">New</span>
                              </a>
                           </li>
                           
                        </ul>
                     </li>
					 <li class="nav-main-item">
                        <a class="nav-main-link " href="<?php echo XC_URL;?>/admin/places">
                        <i class="nav-main-link-icon fa fa-grip-horizontal"></i>
                        <span class="nav-main-link-name">Địa điểm</span>
                        </a>
                     </li>
                     
                     
					 <li class="nav-main-item">
                        <a class="nav-main-link " href="<?php echo XC_URL;?>/admin/projects">
                        <i class="nav-main-link-icon fa fa-grip-horizontal"></i>
                        <span class="nav-main-link-name">Dự án</span>
                        </a>
                     </li>
					 <li class="nav-main-item">
                        <a class="nav-main-link " href="<?php echo XC_URL;?>/admin/news">
                        <i class="nav-main-link-icon fa fa-grip-horizontal"></i>
                        <span class="nav-main-link-name">Tin tức</span>
                        </a>
                     </li>
					 <li class="nav-main-item">
                        <a class="nav-main-link " href="<?php echo XC_URL;?>/admin/pages">
                        <i class="nav-main-link-icon fa fa-grip-horizontal"></i>
                        <span class="nav-main-link-name">Trang tĩnh</span>
                        </a>
                     </li>
					 <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-boxes"></i>
                        <span class="nav-main-link-name">Dữ liệu</span>
                        </a>
                        <ul class="nav-main-submenu">
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/provinces">
                              <span class="nav-main-link-name">Tỉnh thành</span>
                              </a>
                           </li>
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/districts">
                              <span class="nav-main-link-name">Quận huyện</span>
                              </a>
                           </li>
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/wards">
                              <span class="nav-main-link-name">Xã phường</span>
                              </a>
                           </li>
                           <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/categories">
                              <span class="nav-main-link-name">Danh mục BĐS</span>
                              </a>
                           </li>
						   <li class="nav-main-item">
                              <a class="nav-main-link" href="<?php echo XC_URL;?>/admin/menu">
                              <span class="nav-main-link-name">Menu</span>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-main-heading">Hệ thống</li>
					 <li class="nav-main-item">
                        <a class="nav-main-link " href="<?php echo XC_URL;?>/admin/config">
                        <i class="nav-main-link-icon fa fa-wrench"></i>
                        <span class="nav-main-link-name">Cấu hình hệ thống</span>
                        </a>
                     </li>
					 
					 <li class="nav-main-item">
                        <a class="nav-main-link " href="<?php echo XC_URL;?>/admin/config/system">
                        <i class="nav-main-link-icon fa fa-wrench"></i>
                        <span class="nav-main-link-name">Thiết lập frontend</span>
                        </a>
                     </li>
                     
                  </ul>
               </div>
            </div>
         </nav>