<?php include_once "header.php"; ?>
                <div class="container-fluid">
                    <div class="row justify-content-center mt--85">
                        <div class="col-sm-6 col-lg-3">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="cont">
                                        <span class="title">Số dư</span>
                                        <h5 class="amount"><?php echo number_format($cus->cus_balance,0);?> VNĐ</h5>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/dashboard1.png" alt="dasboard">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
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
                        <div class="col-sm-6 col-lg-3">
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
                        <div class="col-sm-6 col-lg-3">
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
                    <div class="operations">
                        <form class="operation-filter">
                            <div class="filter-item">
                                <label for="date">Từ ngày:</label>
                                <input type="date" placeholder="Date from">
                            </div>
                            <div class="filter-item">
                                <label for="date">Đến ngày:</label>
                                <input type="date" placeholder="Date from">
                            </div>
                            <div class="filter-item">
                                <label>Loại giao dịch:</label>
                                <div class="select-item">
                                    <select class="select-bar">
                                        <option value="o1">Nạp tiền</option>
                                        <option value="o2">Rút tiền</option>
                                        <option value="o4">Giao dịch</option>
                                        <option value="o3">Lợi nhuận</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-item">
                                <label>Trạng thái:</label>
                                <div class="select-item">
                                    <select class="select-bar">
                                        <option value="p1">Chờ xử lý</option>
                                        <option value="p2">Đã xử lý</option>
                                        <option value="p3">Đã huỷ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-item">
                                <button type="submit" class="custom-button">Lọc</button>
                            </div>
                        </form>
                        <div class="table-wrapper">
                            <table class="transaction-table">
                                <thead>
                                    <tr>
                                        <th>Mã Giao dịch</th>
                                        <th>Thời gian</th>
                                        <th>Loại giao dịch</th>
                                        <th>Số tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									foreach($transactions as $trans)
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
                                        <td>
                                            <?php echo $trans->trans_code;?>
                                        </td>
                                        <td>
                                            <?php echo date("H:i:s d-m-Y",strtotime($trans->trans_time));?>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?php echo $bagged;?>"><?php echo $title;?></span>
                                        </td>
                                        <td>
                                            <?php echo number_format($trans->trans_amount,0);?> VNĐ
                                        </td>
                                        <td>
                                            <?php 
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
											?>
                                        </td>
                                    </tr>
									<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php include_once "footer.php"; ?>