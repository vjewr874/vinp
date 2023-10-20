<?php include_once "header.php"; ?>
                <div class="container-fluid">
                    <div class="row justify-content-center mt--85">
                        <div class="col-sm-6 col-lg-6">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="cont">
                                        <span class="title">Số dư ví điện tử</span>
                                        <h5 class="amount"><?php echo number_format($cus->cus_balance,0);?> VNĐ</h5>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/dashboard1.png" alt="dasboard">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3" style="display: none;">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="cont">
                                        <span class="title">Lợi nhuận</span>
                                        <h5 class="amount">0 VNĐ</h5>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/dashboard1.png" alt="dasboard">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3" style="display: none;">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="cont">
                                        <span class="title">Rút tháng này</span>
                                        <h5 class="amount">0 VNĐ</h5>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/dashboard1.png" alt="dasboard">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="cont">
                                        <span class="title">Đợi duyệt</span>
                                        <h5 class="amount"><?php echo number_format(game::getInstance()->get_pending_transaction($cus->cid),0);?> VNĐ</h5>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/dashboard1.png" alt="dasboard">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-30">
                        <div class="col-lg-6">
                            <div class="total-earning-item">
                                <div class="total-earning-heading">
                                    <h5 class="title">Tổng lợi nhuận </h5>
                                    <h4 class="amount cl-1">0 VNĐ</h4>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="item">
                                        <div class="cont">
                                            <h4 class="cl-theme">+0%</h4>
                                            <span class="month">So với tháng trước</span>
                                        </div>
                                        <div class="thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/dashboard/graph1.png" alt="dashboard">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="cont">
                                            <h4 class="cl-1">+0%</h4>
                                            <span class="month">So với năm trước</span>
                                        </div>
                                        <div class="thumb">
                                            <img src="<?php echo $template_path; ?>/assets/images/dashboard/graph2.png" alt="dashboard">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="#0" class="normal-button">Xem Báo cáo <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-6">
                            <div class="earn-item mb-30">
                                <div class="earn-thumb">
                                    <img src="<?php echo $template_path; ?>/assets/images/dashboard/earn/02.png" alt="dashboard-earn">
                                </div>
                                <div class="earn-content partner-content d-flex flex-wrap align-items-start justify-content-between">
                                    <h6 class="title w-100">Chương trình đối tác</h6>
                                    <ul class="mb--5">
                                        <li>
                                            <div class="icon">
                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/earn/active.png" alt="dashboard-earn">
                                            </div>
                                            <div class="cont">
                                                <span class="cl-4">Đăng ký:</span>
                                                <span class="cl-1">0</span>
                                            </div>
                                        </li>
										<li>
                                            <div class="icon">
                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/earn/active.png" alt="dashboard-earn">
                                            </div>
                                            <div class="cont">
                                                <span class="cl-4">Hoạt động:</span>
                                                <span class="cl-1">0</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/earn/inactive.png" alt="dashboard-earn">
                                            </div>
                                            <div class="cont">
                                                <span class="cl-4">Không hoạt động :</span>
                                                <span class="cl-1">0</span>
                                            </div>
                                        </li>
										<li>
                                            <div class="icon">
                                                <img src="<?php echo $template_path; ?>/assets/images/dashboard/earn/active.png" alt="dashboard-earn">
                                            </div>
                                            <div class="cont">
                                                <span class="cl-1 amount">Giới thiệu mới:</span>
                                                <span class="cl-1 amount"></span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="total-partner">
                                        <span class="total-title">0</span>
                                        <span>Tổng</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="earn-item">
								<h6 class="title w-100">Giao dịch mới nhất</h6>
								<div class="card-body">
									<div class="table-wrapper">
										<table class="transaction-table">
											<thead>
												<tr>
													<th>Thời gian</th>
													<th>Loại giao dịch</th>
													<th>Số tiền</th>
													<th>Nội dung</th>
													<th>Trạng thái</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($transactions as $trans)
													{
														if($trans->trans_type == 1 || $trans->trans_type == 2 || $trans->trans_type == 3)
														{
														$tag = '';
														$title = '';
														$bagged = '';
														if($trans->trans_type == 1)
														{
															$tag = '<span class="buy-thumb"><i class="la la-arrow-up"></i></span>';
															$title = 'Nạp tiền';
															$bagged = 'success';
														}
														elseif($trans->trans_type == 2)
														{
															$tag = '<span class="sold-thumb"><i class="la la-arrow-down"></i></span>';
															$title = 'Rút tiền';
															$bagged = 'danger';
														}
														elseif($trans->trans_type == 3)
														{
															$tag = '<span class="trans-thumb"><i class="la la-arrow-right"></i></span>';
															$title = 'Chuyển tiền';
															$bagged = 'primary';
														}
													?>
													<tr>
														<td><?php echo date("H:i:s d-m-Y",strtotime($trans->trans_time));?></td>
														<td> <span class="badge badge-<?php echo $bagged;?>"><?php echo $title;?></span></td>
														<td class="text-<?php echo $bagged;?>"><?php echo number_format($trans->trans_amount,0);?> VNĐ</td>
														<td>
															<?php echo $trans->trans_note;?>
														</td>
														
														
														<td><?php echo ($trans->trans_status == 1)? '<span class="badge badge-warning text-white">Chờ xử lý</span>' : '<span class="badge badge-success">Đã xử lý</span>';?></td>
													</tr>
													<?php
														}
													}
													?>
												
											</tbody>
										</table>
									</div>
									
								</div>
							</div>
                        </div>
                        
                    </div>
					
                </div>
				<script>
        $('.progress1.circle').circleProgress({
            value: .75,
            fill: {
                gradient: ['#00cca2', '#00cca2']
            },
            }).on('circle-animation-progress', function(event, progress) {
            $(this).find('strong').html(Math.round(75 * progress) + '<i>%</i>');
        });
        $('.progress2.circle').circleProgress({
            value: .90,
            fill: {
                gradient: ['#8d16e8', '#8d16e8']
            },
            }).on('circle-animation-progress', function(event, progress) {
            $(this).find('strong').html(Math.round(90 * progress) + '<i>%</i>');
        });
        $('.progress3.circle').circleProgress({
            value: .85,
            fill: {
                gradient: ['#ef764c', '#ef764c']
            },
            }).on('circle-animation-progress', function(event, progress) {
            $(this).find('strong').html(Math.round(85 * progress) + '<i>%</i>');
        });
    </script>
<?php include_once "footer.php"; ?>