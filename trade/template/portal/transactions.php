<?php
include_once "header.php";
?>
<div class="history mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
						
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Lịch sử giao dịch</h4>
                            </div>
                            <div class="card-body pt-0">
								<div class="buy-sell-widget">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
								  <li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nộp/rút tiền</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Chuyển tiền</a>
								  </li>
								</ul>
								<div class="tab-content" id="myTabContent">
								  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<div class="transaction-table isdesktop">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
                                            <tbody>
												<?php
												foreach($transactions as $trans)
												{
													if($trans->trans_type < 3)
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
															<td><?php echo date("H:i:s d-m-Y",strtotime($trans->trans_time));?></td>
															<td class="text-<?php echo $bagged;?>"><?php echo number_format($trans->trans_amount,0);?> VNĐ</td>
															<td>
																<?php echo $trans->trans_note;?>
															</td>
															<td><?php 
															if($trans->trans_status == 1)
															{
																echo '<span class="badge badge-warning text-white">Chờ xử lý</span>';
															}
															elseif($trans->trans_status == 2)
															{
																echo '<span class="badge badge-success">Đã xử lý</span>';
															}
															else
															{
																echo '<span class="badge badge-danger">Hủy bỏ</span>';
															}
															//echo ($trans->trans_status == 1)? '<span class="badge badge-success text-white">Chờ xử lý</span>' : '<span class="badge badge-success">Đã xử lý</span>';?></td>
														</tr>
														<?php
													}
												}
												?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
									<!-- Mobile -->
								<div class="form ismobile" >
                                    <ul class="linked_account">
                                        <?php
										foreach($transactions as $trans)
										{
											if($trans->trans_type < 3)
											{
											$tag = '';
											$title = '';
											$bagged = '';
											if($trans->trans_type == 1)
											{
												$tag = '<span class="buy-thumb"><i class="la la-arrow-up"></i></span>';
												$title = 'Nạp tiền';
												$bagged = 'success';
												$liclass = 'list-group-item list-group-item-success';
											}
											elseif($trans->trans_type == 2)
											{
												$tag = '<span class="sold-thumb"><i class="la la-arrow-down"></i></span>';
												$title = 'Rút tiền';
												$bagged = 'danger';
												$liclass = 'list-group-item list-group-item-danger';
											}
											elseif($trans->trans_type == 3)
											{
												$tag = '<span class="trans-thumb"><i class="la la-arrow-right"></i></span>';
												$title = 'Chuyển tiền';
												$bagged = 'primary';
												$liclass = 'list-group-item list-group-item-primary';
											}
										?>
										<li >
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="media my-2">
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1">Giao dịch số: <?php echo $trans->trans_code;?></h5>
															<p>Loại giao dịch: <span class="badge badge-<?php echo $bagged;?>"><?php echo $title;?></span></p>
                                                            <p>Số tiền: <?php echo number_format($trans->trans_amount,0);?> VNĐ</p>
															<?php if($trans->trans_type == 2)
															{
																?>
																<p>Tài khoản rút tiền: <?php echo $trans->bank_account;?></p>
																<?php
															}
															?>
															<p>Ngày giao dịch: <?php echo date("H:i:s d-m",strtotime($trans->trans_time));?></p>
															<p>Trạng thái: <?php 
															if($trans->trans_status == 1)
															{
																echo '<span class="badge badge-warning text-white">Chờ xử lý</span>';
															}
															elseif($trans->trans_status == 2)
															{
																echo '<span class="badge badge-success">Đã xử lý</span>';
															}
															else
															{
																echo '<span class="badge badge-danger">Hủy bỏ</span>';
															};?></p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
											}
										}
										?>
                                    </ul>

                                </div>
									<!-- Mobile -->
								  </div>
								  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="transaction-table isdesktop">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
                                            <tbody>
												<?php
												foreach($transactions as $trans)
												{
													if($trans->trans_type == 3)
													{
														$tag = '';
														$title = '';
														$bagged = '';
														$tag = '<span class="trans-thumb"><i class="la la-arrow-right"></i></span>';
															$title = 'Chuyển tiền';
															$bagged = 'primary';
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
								<div class="form ismobile" >
                                    <ul class="linked_account">
                                        <?php
										foreach($transactions as $trans)
										{
											if($trans->trans_type == 3)
											{
											$tag = '';
											$title = '';
											$bagged = '';
											if($trans->trans_type == 1)
											{
												$tag = '<span class="buy-thumb"><i class="la la-arrow-up"></i></span>';
												$title = 'Nạp tiền';
												$bagged = 'success';
												$liclass = 'list-group-item list-group-item-success';
											}
											elseif($trans->trans_type == 2)
											{
												$tag = '<span class="sold-thumb"><i class="la la-arrow-down"></i></span>';
												$title = 'Rút tiền';
												$bagged = 'danger';
												$liclass = 'list-group-item list-group-item-danger';
											}
											elseif($trans->trans_type == 3)
											{
												$tag = '<span class="trans-thumb"><i class="la la-arrow-right"></i></span>';
												$title = 'Chuyển tiền';
												$bagged = 'primary';
												$liclass = 'list-group-item list-group-item-primary';
											}
										?>
										<li >
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="media my-2">
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1">Giao dịch số: <?php echo $trans->trans_code;?></h5>
															<p>Loại giao dịch: <span class="badge badge-<?php echo $bagged;?>"><?php echo $title;?></span></p>
                                                            <p>Số tiền: <?php echo number_format($trans->trans_amount,0);?> VNĐ</p>
															<p>Ngày giao dịch: <?php echo date("H:i:s d-m",strtotime($trans->trans_time));?></p>
															<p>Trạng thái: <?php 
															if($trans->trans_status == 1)
															{
																echo '<span class="badge badge-warning text-white">Chờ xử lý</span>';
															}
															elseif($trans->trans_status == 2)
															{
																echo '<span class="badge badge-success">Đã xử lý</span>';
															}
															else
															{
																echo '<span class="badge badge-danger">Hủy bỏ</span>';
															};?></p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
											}
										}
										?>
                                    </ul>

                                </div>
								  </div>
								  
								</div>
								</div>
                                
                            </div>
							
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include_once "footer.php";
?>