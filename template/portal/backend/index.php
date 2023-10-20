<?php include_once "header.php";?>
         <main id="main-container">
            <div class="content">
               <div class="d-md-flex justify-content-md-between align-items-md-center py-3 pt-md-3 pb-md-0 text-center text-md-left">
                  <div>
                     <h1 class="h2 mb-1">
                        Tổng quan
                     </h1>
                     <p class="mb-0">
                        Xin chào, <?php echo $_SESSION['staff']['fullname'];?>! You have <a class="font-w500" href="javascript:void(0)">5 new notifications</a>.
                     </p>
                  </div>
                  <div class="mt-4 mt-md-0">
                     <a class="btn btn-sm btn-alt-primary" href="javascript:void(0)">
                     <i class="fa fa-cog"></i>
                     </a>
                     <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-primary px-3" id="dropdown-analytics-overview" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Last 30 days <i class="fa fa-fw fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-analytics-overview">
                           <a class="dropdown-item" href="javascript:void(0)">This Week</a>
                           <a class="dropdown-item" href="javascript:void(0)">Previous Week</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="javascript:void(0)">This Month</a>
                           <a class="dropdown-item" href="javascript:void(0)">Previous Month</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="content">
               <div class="row row-deck">
                  <div class="col-sm-6 col-xl-3">
                     <div class="block block-rounded text-center d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1">
                           <div class="item rounded-lg bg-body-dark mx-auto my-3">
                              <i class="fa fa-users text-muted"></i>
                           </div>
                           <div class="text-black font-size-h1 font-w700"><?php echo number_format($this->home->count_user(),0);?></div>
                           <div class="text-muted mb-3">Tài khoản</div>
                           <div class="d-inline-block px-3 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-lighter">
                              <?php echo number_format($this->home->count_user(true),0);?>
                           </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                           <a class="font-w500" href="<?php echo XC_URL;?>/admin/customers">
                           Xem tài khoản
                           <i class="fa fa-arrow-right ml-1 opacity-25"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                     <div class="block block-rounded text-center d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1">
                           <div class="item rounded-lg bg-body-dark mx-auto my-3">
                              <i class="fa fa-level-up-alt text-muted"></i>
                           </div>
                           <div class="text-black font-size-h1 font-w700"><?php echo number_format($this->home->count_post(true),0);?></div>
                           <div class="text-muted mb-3">Tin đăng</div>
                           <div class="d-inline-block px-3 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-lighter">
                              <?php echo number_format($this->home->count_post(false),0);?>
                           </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                           <a class="font-w500" href="<?php echo XC_URL;?>/admin/posts">
                           Xem tất cả tin
                           <i class="fa fa-arrow-right ml-1 opacity-25"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                     <div class="block block-rounded text-center d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1">
                           <div class="item rounded-lg bg-body-dark mx-auto my-3">
                              <i class="fa fa-chart-line text-muted"></i>
                           </div>
                           <div class="text-black font-size-h1 font-w700">0</div>
                           <div class="text-muted mb-3">Liên hệ</div>
                           <div class="d-inline-block px-3 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-lighter">
                              <i class="fa fa-caret-up mr-1"></i>
                              0%
                           </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                           <a class="font-w500" href="javascript:void(0)">
                           Xem danh sách bán
                           <i class="fa fa-arrow-right ml-1 opacity-25"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-xl-3">
                     <div class="block block-rounded text-center d-flex flex-column">
                        <div class="block-content block-content-full">
                           <div class="item rounded-lg bg-body-dark mx-auto my-3">
                              <i class="fa fa-wallet text-muted"></i>
                           </div>
                           <div class="text-black font-size-h1 font-w700">0 VNĐ</div>
                           <div class="text-muted mb-3">Thu nhập</div>
                           <div class="d-inline-block px-3 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-lighter">
                              <i class="fa fa-caret-down mr-1"></i>
                              0.0%
                           </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                           <a class="font-w500" href="javascript:void(0)">
                           Xem lịch sử giao dịch
                           <i class="fa fa-arrow-right ml-1 opacity-25"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="block block-rounded">
                  <div class="block-header block-header-default">
                     <h3 class="block-title">
                        Biểu đồ tin đăng
                     </h3>
                     <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                        <i class="si si-wrench"></i>
                        </button>
                     </div>
                  </div>
                  <div class="block-content block-content-full">
                     <div class="row">
                        <div class="col-md-5 col-xl-4 d-md-flex align-items-md-center">
                           <div class="p-md-2 p-lg-3">
                              <div class="py-3">
                                 <div class="text-black font-size-h1 font-w700"><?php echo number_format($this->home->count_user(true),0);?></div>
                                 <div class="font-w600">Khách hàng mới trong hôm nay</div>
                                 <div class="py-3 d-flex align-items-center">
                                    <div class="bg-success-lighter p-2 rounded mr-3">
                                       <i class="fa fa-fw fa-arrow-up text-success"></i>
                                    </div>
                                    <p class="mb-0">
                                      Tăng trưởng <span class="font-w600 text-success">0%</span> so với tháng trước!
                                    </p>
                                 </div>
                              </div>
                              <div class="py-3">
                                 <div class="text-black font-size-h1 font-w700"><?php echo number_format($this->home->count_post(false),0);?></div>
                                 <div class="font-w600">Tin đăng mới</div>
                                 <div class="py-3 d-flex align-items-center">
                                    <div class="bg-success-lighter p-2 rounded mr-3">
                                       <i class="fa fa-fw fa-arrow-up text-success"></i>
                                    </div>
                                    <p class="mb-0">
                                       Có <span class="font-w600 text-danger"><?php echo number_format($this->home->count_post(false),0);?></span> tin chưa duyệt, xem ngay!
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-7 col-xl-8 d-md-flex align-items-md-center">
                           <div class="p-md-2 p-lg-3 w-100">
                              <canvas class="js-chartjs-analytics-bars"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
         </main>
         <?php include_once "footer.php";?>