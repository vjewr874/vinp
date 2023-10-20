<?php
include_once "header.php";
?>
<script>
		$(document).ready(function() {
			$("#addbankbtn").on("click",function()
			{
				$("#AddBankModal").modal("show");
				return false;
			});
			$("#btn-delete-bank").on("click",function()
			{
				var bankid = $(this).attr("data-cbid");
				deletecard(bankid);
				return false;
			});
			$(".deletebank").on("click",function()
			{
				var bankid = $(this).attr("bank-id");
				deletecard(bankid);
				return false;
			});
			$(".viewbankdata").on("click",function()
			{
				var bankid = $(this).attr("bank-id");
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/viewbank",
					data: {bankid: bankid},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						if(data.status == "200")
						{
							$(".scard__logo").attr("src",data.bank_logo);
							$(".scard_numer").html(data.bank_account);
							$("#scard_info").html(data.bank_holder);
							$("#scard_branch").html(data.bank_branch);
							$("#btn-delete-bank").attr("data-cbid",bankid);
							$("#ViewBankModal").modal("show");
						}
						else
						{
							alert(data.message); 
						}
					}
				});
				
				return false;
			});
			//deletecard(8);
			function deletecard(bankid)
			{
				Swal.fire({
				  title: 'Bạn có chắc chắn?',
				  text: "Thao tác này không thể khôi phục!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes'
				}).then((result) => {
				  if (result.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/deletebank",
						data: {bankid: bankid},
						dataType: "json",
						cache: false,
						success: function(data)
						{
							if(data.status == "200")
							{
								Swal.fire(
								  'Hoàn tất!',
								  'Tài khoản đã được xóa thành công.',
								  'success'
								)
								location.reload();
							}
							else
							{
								Swal.fire(
								  'Lỗi',
								  data.message,
								  'error'
								)
							}
						}
					});
					
				  }
				})
			}
			$("#btn-add-bank").on("click",function()
			{
				if(!$("#bank").val())
				{
					alert("Vui lòng điền đẩy đủ thông tin");
				}
				else				
				{
					var bank = $("#bank").val();
					var bank_branch = $("#bank_branch").val();
					var bank_account = $("#bank_account").val();
					var bank_holder = $("#bank_holder").val();
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/addbank",
						data: {bank: bank, branch: bank_branch,account: bank_account,holder: bank_holder},
						dataType: "json",
						cache: false,
						success: function(data)
						{
							if(data.status == "200")
							{
								alert("Đã thêm tài khoản, đợi xác thực");
								location.reload();
							}
							else
							{
								alert(data.message); 
							}
						}
					});
				}
				return false;
			});
			$("#btn-add-phone").on("click",function()
			{
				var newphone = $("#new-phone").val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/addnewphone",
					data: {newphone: newphone},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							$("#dataid").val(newphone);
							$("#phonedata").html(newphone);
							$("#OTPVerify").modal("show");
						}
						else
						{
							Swal.fire(
							  'Lỗi',
							  data.message,
							  'error'
							)
							//location.reload();
						}
					}
				});
				
				return false;
			});
			$("#otp-resend").on("click",function()
			{
				
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/resendotp",
					data: {},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							
						}
						else
						{
							alert(data.message); 
						}
					}
				});
				
				return false;
			});
			$("#otp-verify").on("click",function()
			{
				var otp = $("#otp-value").val();
				var dataid = $("#dataid").val();
				var verifytype = $("#verifytype").val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/verifyotpapp",
					data: {dataid: dataid,otp:otp,verifytype: verifytype},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							$("#verify-success").fadeIn(100);
							$("#verify-progress").fadeOut(100);
						}
						else
						{
							alert(data.message); 
						}
					}
				});
				return false;
			});
					
		});
		</script>
<div class="settings mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="card-title">Hồ Sơ</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li class="nav-item">
                                        <a href="<?php echo XC_URL;?>/ho-so.html" class="nav-link active">
                                            <i class="la la-user"></i>
                                            <span>Hồ sơ cá nhân</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo XC_URL;?>/cai-dat.html" class="nav-link">
                                            <i class="la la-cog"></i>
                                            <span>Cài đặt</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo XC_URL;?>/bao-mat.html" class="nav-link">
                                            <i class="la la-lock"></i>
                                            <span>Bảo mật</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo XC_URL;?>/ngan-hang.html" class="nav-link">
                                            <i class="la la-bank"></i>
                                            <span>Tài khoản ngân hàng</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Xác minh</h4>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-4">
                                        <div class="id_card">
                                            <img src="<?php echo $template_path;?>/images/id.png" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="id_info">
                                            <h3><?php echo $cus->cus_fullname;?></h3>
                                            <p class="mb-1 mt-3">ID: <?php echo $cus->cus_national_id;?> </p>
                                            <p class="mb-1">Trạng thái: <span class="font-weight-bold">Đã xác minh</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: none;">
                                    <div class="col-xl-12">
                                        <div class="phone_verify">
                                            <h4 class="card-title mb-3">Địa chỉ Email</h4>
                                            <form action="#">
                                                <div class="form-row align-items-center">
                                                    <div class="form-group col-xl-6">
                                                        <input type="text" class="form-control" placeholder="Địa chỉ email">
                                                        <button class="btn btn-success mt-4">Thêm</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="phone_verified">
                                            <h5> <span><i class="fa fa-envelope"></i></span> <?php echo $cus->cus_email;?></h5>
                                            <div class="verify">
                                                <div class="verified">
                                                    <span><i class="la la-check"></i></span>
                                                    <a href="#">Đã xác minh</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="phone_verify">
                                            <h4 class="card-title mb-3">Thông tin liên lạc</h4>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="phone_verified">
                                            <h5> <span><i class="fa fa-phone"></i></span> <?php echo $cus->cus_phone;?></h5>
                                            <div class="verify">
                                                <div class="verified">
                                                    <span><i class="la la-check"></i></span>
                                                    <a href="#">Đã xác minh</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php 
									$phones = $this->config->contacts($_SESSION['user']['id'],1);
									foreach($phones as $phone)
									{
										?>
										<div class="col-xl-12 mt-3">
                                        <div class="phone_verified">
                                            <h5> <span><i class="fa fa-phone"></i></span> <?php echo $phone->contact_value;?></h5>
                                            <div class="verify">
                                                <?php if($phone->contact_status == 0)
													{	
													?>
													<div class="not-verify">
														<span><i class="la la-close"></i></span>
														<a data-id="<?php echo $phone->id;?>" class="btn-verify-phone" href="#">Chưa xác minh</a>
													</div>
													<?php
													}
													else
													{
														?>
													<div class="verified">
														<span><i class="la la-check"></i></span>
														Đã xác minh
													</div>
														<?php
													}
													?>
                                            </div>
                                        </div>
                                    </div>
										<?php
									}
									?>
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
<div class="modal fade" id="OTPVerify" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Xác minh tài khoản</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-12 col-md-12">
                        <div class="auth-form card">
                            <div class="card-body">
                                <form action="" id="verify-progress">
									<h3 class="text-center">Xác minh tài khoản</h3>
									<p class="text-center mb-5">Mã xác thực vừa được gửi đến số điện thoại: <span id="phonedata"></span> </p>
                                    <div class="form-group">
                                        <label>Mã OTP</label>
                                        <input type="text" id="otp-value" class="form-control text-center font-weight-bold" value="">
										<input type="hidden" id="dataid" value="">
										<input type="hidden" id="verifytype" value="phone">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" id="otp-verify" class="btn btn-success btn-block">Xác minh</button>
                                        <button type="button" id="otp-resend" class="btn btn-danger btn-block">Gửi lại</button>
                                    </div>
                                </form>
								<form id="verify-success" style="display: none;" class="identity-upload">
                                    <div class="identity-content">
                                        <span class="icon"><i class="fa fa-check"></i></span>
                                        <h4>Xin chúc mừng!</h4>
                                        <p>Số điện thoại của Quý Khách đã được xác minh, xin lưu ý, số điện thoại có thể được sử dụng để xác minh tài khoản khi cần thiết. Hãy luôn giữ liên lạc.</p>
                                    </div>

                                    <div class="text-center">
                                        <a href="<?php echo XC_URL;?>/bao-mat.html" class="btn btn-success pl-5 pr-5 waves-effect">Tiếp theo</a>
                                    </div>
                                </form>
                                <div class="info mt-3">
                                    <p class="text-muted">Nhân viên của Lightning999 không bao giờ hỏi mật khẩu hay mã OTP của Khách hàng!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      </div>
    </div>
  </div>
</div>