<?php include_once "header.php";?>

        <div class="homepage mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="card profile_chart">
                            <div class="card-header">
                                <div class="chart_current_data">
									<?php 
									$rand1 = rand(254722,289514);
									$rand2 = rand(120400,250400);
									?>
                                    <h3><?php echo number_format($rand1,0);?> <span>USD</span></h3>
                                    <p class="text-success"><?php echo number_format($rand2,0);?> <span>USD (20%)</span></p>
                                </div>
                                <div class="duration-option">
                                    <a id="all" class="active">Tất cả</a>
                                    <a id="one_month" class="">1 tháng</a>
                                    <a id="six_months">6 tháng</a>
                                    <a id="one_year" class="">1 năm</a>
                                    <a id="ytd" class="">Năm nay</a>
                                </div>
                            </div>
                            <div class="card-body pt-0">
								<?php 
								$rand3 = rand(5.34,261.96);
								$rand4 = rand(26500,115000);
								$rand5 = rand(120400,750400);
								$rand6 = rand(1120400,3750400);
								$rand7 = rand(1400,6500);
								?>
                                <div id="timeline-chart"></div>
                                <div class="chart-content text-center">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-6">
                                            <p class="mb-1">Biến động hôm nay</p>
                                            <h5><?php echo number_format($rand3,2);?>%</h5>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-6">
                                            <p class="mb-1">Phiên giao dịch</p>
                                            <h5><?php echo number_format($rand4,0);?>/116.500</h5>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-6">
                                            <p class="mb-1">Lãi/Lỗ</p>
                                            <h5><?php echo number_format($rand5,0);?>/<?php echo number_format($rand6,0);?></h5>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-6">
                                            <p class="mb-1">Tổng biến động</p>
                                            <h5><?php echo number_format($rand7,2);?>%</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="card balance-widget">
                            <div class="card-header pb-0 border-0">
                                <h4 class="card-title">Tài khoản của bạn </h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="balance-widget">
                                    <div class="total-balance">
                                        <h3><?php echo number_format($cus->cus_balance,0);?> VNĐ</h3>
                                        <h6>Số dư tài khoản chính</h6>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class="media">
                                            <?php $mxvwallet = crm::getInstance()->get_wallet_balance(1,$cus->cid);?>
                                            <div class="media-body wallet">
                                                <h5>Tài khoản Nhị phân</h5>
                                                <span style="font-weight: strong;"><?php echo $mxvwallet->acc_number;?></span>
                                            </div>
											
                                            <div class="text-right">
                                                <h5><?php echo number_format($mxvwallet->acc_balance,0);?> VNĐ</h5>
                                            </div>
                                        </li>
                                        <li class="media">
											<?php $pending = game::getInstance()->get_pending_transaction($cus->cid);?>
                                            <div class="media-body wallet">
                                                Đợi duyệt
                                            </div>
                                            <div class="text-right">
                                                <h5><?php echo number_format($pending,0);?> VNĐ</h5>
                                            </div>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9 col-lg-9">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Giao dịch mới nhất</h4>
                                <a href="#">Xem tất cả</a>
                            </div>
                            <div class="card-body">
                                <div class="transaction-table">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
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
                                                    <td> <?php echo $tag;?></td>

                                                    <td>
                                                        <span class="badge badge-<?php echo $bagged;?>"><?php echo $title;?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo $trans->trans_note;?>
                                                    </td>
                                                    <td class="text-<?php echo $bagged;?>"><?php echo number_format($trans->trans_amount,0);?> VNĐ</td>
                                                    <td><?php echo date("H:i:s d-m-Y",strtotime($trans->trans_time));?></td>
													<td><?php echo ($trans->trans_status == 1)? '<span class="badge badge-success text-white">Chờ xử lý</span>' : '<span class="badge badge-success">Đã xử lý</span>';?></td>
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
                    <div class="col-xl-3 col-lg-3">
                        <div class="card apps-download">
                            <div class="card-body">
                                <h4 class="card-title">Ứng dụng di động</h4>
                                <div class="apps-download-content">
                                    <h3>Quản lý tài khoản và giao dịch dễ dàng hơn trên di động:</h3>
                                    <div class="mt-4 text-center">
                                        <a href="#" class="btn btn-primary my-1"><img src="<?php echo $template_path;?>/images/android.svg"
                                                alt=""></a>
                                        <a href="#" class="btn btn-success my-1"><img src="<?php echo $template_path;?>/images/apple.svg"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include_once "footer.php";?>