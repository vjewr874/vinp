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
                    <div class="partners">
                        <h3 class="main-title">Hồ sơ</h3>
                        <div class="row mb-30-none">
                            <div class="col-lg-6 mb-30">
                                <div class="create_wrapper mw-100">
                                    <h5 class="subtitle">Thông tin cá nhân</h5>
                                    <div class="d-flex align-items-center mb-30">
                                        <div class="update_user">
										
                                            <img src="<?php echo ($cus->cus_avatar)? $upload_path.'/users/'.$cus->cus_avatar : $template_path.'/assets/images/dashboard/user.png'; ?>" alt="dashboard">
                                        </div>
                                        <div class="pl-3">
                                            <span class="sub_subtitle cl-title fz-sm d-block">Ảnh đại diện</span>
                                            <label for="update_profile" class="custom-button m-0 mt-2 lh-40 h-40">Chọn ảnh</label>
                                            <input type="file" id="update_profile" class="profile_update_input">
                                        </div>
                                    </div>
                                    <form class="create_ticket_form row mb-30-none">
                                        <div class="create_form_group col-sm-12">
                                            <label for="account_name">Số tài khoản:</label>
                                            <input type="text" id="account_name" readonly value="<?php echo $cus->cus_code;?>" placeholder="Số tài khoản">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="full_name">Họ và tên:</label>
                                            <input type="text" id="full_name" value="<?php echo $cus->cus_fullname;?>" placeholder="Full Name">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="account_mobile">Số điện thoại:</label>
                                            <input type="text" id="account_mobile" readonly value="<?php echo $cus->cus_phone;?>">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="account_address">Địa chỉ:</label>
                                            <input type="text" id="account_address" value="<?php echo $cus->cus_address;?>" placeholder="Địa chỉ">
                                        </div>
                                        <div class="create_form_group col-sm-6 align-self-end">
                                            <button type="button" id="btn-save-profile" class="custom-button border-0">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
							<?php
							$banks = $this->config->banks();
							?>
                            <div class="col-lg-6 mb-30">
                                <div class="create_wrapper mw-100">
                                    <h5 class="subtitle">Thông tin thanh toán</h5>
                                    <form class="create_ticket_form row mb-30-none">
										
                                        <div class="create_form_group col-sm-12">
                                            <label for="perfect_money">Ngân hàng:</label>
											<div class="select-item mb-3">
                                                <select class="select-bar" style="width: 100%" name="bank" id="bank">
                                                    <option value="" disabled>Chọn</option>
													<?php foreach($banks as $bank)
													{
													?>
														<option <?php echo ($banklist->bank_id == $bank->id)? "selected" : "";?> value="<?php echo $bank->id;?>"><?php echo $bank->bank_name." (".$bank->bank_code.")";?></option>
													<?php
													}
													?>
													</select>
                                            </div>
											
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="bank_account">Số tài khoản</label>
                                            <input type="text" id="bank_account" value="<?php echo $banklist->bank_account; ?>">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="bank_holder">Chủ tài khoản:</label>
                                            <input type="text" id="bank_holder" value="<?php echo $banklist->bank_holder; ?>">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="bank_branch">Chi nhánh:</label>
                                            <input type="text" id="bank_branch" value="<?php echo $banklist->bank_branch; ?>">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="litecoin_account">Loại tiền:</label>
                                            <input type="text" id="bank_currency" readonly value="Việt Nam Đồng">
                                        </div>
                                        
                                        <div class="create_form_group col-sm-6 align-self-end">
                                            <button type="button" id="btn-save-bank" class="custom-button border-0">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-30">
                                <div class="create_wrapper mw-100">
                                    <h5 class="subtitle">Thiết lập</h5>
                                    <form class="create_ticket_form mb-30-none">
                                        <div class="create_form_group">
                                            <label for="old_pass">Múi giờ báo cáo:</label>
                                            <div class="select-item mb-3">
                                                <select class="select-bar">
                                                    <option value="time_zone_1">GMT +7</option>
                                                </select>
                                            </div>
                                            <div class="check_box_group">
                                                <input type="checkbox" name="time-zone" class="fz-sm" id="time_zone" checked>
                                                <label for="time_zone">Không nhận báo cáo hàng ngày về email</label>
                                            </div>
                                        </div>
                                        <div class="create_form_group">
                                            <label for="old_pass">Bảo mật đăng nhập trên nhiều thiết bị:</label>
                                            <div class="select-item mb-3">
                                                <select class="select-bar">
                                                    <option value="ip_control_1">1 IP</option>
                                                    <option value="ip_control_2">2 IP</option>
                                                    <option value="ip_control_3">3 IP</option>
                                                    <option value="ip_control_4" selected>Không giới hạn</option>
                                                </select>
                                            </div>
                                            <div class="check_box_group">
                                                <input type="checkbox" name="time-zone" class="fz-sm" id="ip_control_3">
                                                <label for="ip_control_3">Tin cậy tất cả các phiên đăng nhập</label>
                                            </div>
                                            <div class="check_box_group">
                                                <input type="checkbox" name="time-zone" class="fz-sm" id="ip_control_2">
                                                <label for="ip_control_2">Hỏi lại mật khẩu sau 03 giờ.</label>
                                            </div>
                                        </div>
                                        <div class="create_form_group align-self-end">
                                            <button type="submit" class="custom-button border-0">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-30">
                                <div class="create_wrapper mw-100">
                                    <h5 class="subtitle">Đổi mật khẩu</h5>
                                    <form class="create_ticket_form row mb-30-none">
                                        <div class="create_form_group col-sm-12">
                                            <label for="old-password">Mật khẩu cũ:</label>
                                            <input type="password" id="old-password" placeholder="Mật khẩu cũ">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="new-password">Mật khẩu mới:</label>
                                            <input type="password" id="new-password" placeholder="Mật khẩu mới">
                                        </div>
                                        <div class="create_form_group col-sm-12">
                                            <label for="repeat_pass">Xác nhận mật khẩu mới:</label>
                                            <input type="password" id="repeat_pass" placeholder="Xác nhận mật khẩu mới">
                                        </div>
                                        <div class="create_form_group col-sm-6 align-self-end">
                                            <button id="btn-change-pass" type="button" class="custom-button border-0">Đổi mật khẩu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<script>
				$(document).ready(function() {
					$("#btn-save-bank").on("click", function(){
						var bank = $("#bank").val();
						var bank_branch = $("#bank_branch").val();
						var bank_account = $("#bank_account").val();
						var bank_holder = $("#bank_holder").val();
						$.ajax({
							type: "POST",
							url: "<?php echo XC_URL;?>/api/updatebank",
							data: {bank: bank, bank_branch: bank_branch,bank_account : bank_account,bank_holder:bank_holder },
							dataType: "json",
							cache: false,
							success: function(data)
							{
								if(data.status == "200")
								{
									Swal.fire({
									  icon: 'success',
									  title: 'Thành công',
									  text: 'Đã cập nhật thông tin tài khoản ngân hàng',
									  timer: 1700
									})
									setTimeout(function(){ location.reload();     }, 2000);     
								}
								else
								{
									Swal.fire({
									  icon: 'error',
									  title: 'Oops...',
									  text: data.message,
									  footer: '<a href>Xem thêm về lỗi này?</a>'
									})
								}
							}
						});
						return false;
					});
					$("#btn-save-profile").on("click", function(){
						var fullname = $("#full_name").val();
						var address = $("#account_address").val();
						$.ajax({
							type: "POST",
							url: "<?php echo XC_URL;?>/api/updateprofile",
							data: {fullname: fullname, address: address},
							dataType: "json",
							cache: false,
							success: function(data)
							{
								if(data.status == "200")
								{
									Swal.fire({
									  icon: 'success',
									  title: 'Thành công',
									  text: 'Đã cập nhật thông tin tài khoản',
									  timer: 1700
									})
									setTimeout(function(){ location.reload();     }, 2000);     
								}
								else
								{
									Swal.fire({
									  icon: 'error',
									  title: 'Oops...',
									  text: data.message,
									  footer: '<a href>Xem thêm về lỗi này?</a>'
									})
								}
							}
						});
						return false;
					});
					$("#btn-change-pass").on("click",function()
						{
							if($("#old-password").val().length <=3 || $("#new-password").val().length <= 3)
							{
								Swal.fire({
								  icon: 'error',
								  title: 'Oops...',
								  text: 'Mật khẩu không hợp lệ, vui lòng nhập lại',
								  footer: '<a href>Xem thêm về lỗi này?</a>'
								})
								$("#old-password").focus();
							}
							else if($("#new-password").val() != $("#repeat_pass").val())
							{
								Swal.fire({
								  icon: 'error',
								  title: 'Oops...',
								  text: 'Xác nhận mật khẩu không trùng khớp',
								  footer: '<a href>Xem thêm về lỗi này?</a>'
								})
								$("#new-password").focus();
							}
							else				
							{
								var oldpass = $("#old-password").val();
								var newpass = $("#new-password").val();
								$.ajax({
									type: "POST",
									url: "<?php echo XC_URL;?>/api/changepassword",
									data: {password: oldpass, newpassword: newpass},
									dataType: "json",
									cache: false,
									success: function(data)
									{
										if(data.status == "200")
										{
											Swal.fire({
											  icon: 'success',
											  title: 'Thành công',
											  text: 'Đã đổi thành công mật khẩu. Vui lòng đăng nhập lại!',
											  timer: 1700
											})
											setTimeout(function(){ window.location= ("<?php echo XC_URL; ?>/logout");     }, 2000);     
										}
										else
										{
											Swal.fire({
											  icon: 'error',
											  title: 'Oops...',
											  text: data.message,
											  footer: '<a href>Xem thêm về lỗi này?</a>'
											})
										}
									}
								});
							}
							return false;
						});
							
				});
				</script>
                 <?php include_once "footer.php"; ?>