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
					fd = new FormData();
					fd.append('bank_file', $("#bank_file").get(0).files[0]);
					fd.append('bank', bank);
					fd.append('bank_branch', bank_branch );
					fd.append('bank_account', bank_account);
					fd.append('bank_holder', bank_holder);
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/addbank",
						data: fd,
						dataType: "json",
						cache: false,
						processData: false,  // tell jQuery not to process the data
						contentType: false, 
						enctype: 'multipart/form-data',
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
			$(".btn-verify-bank").on("click",function()
			{
				
				var bankid = $(this).attr("data-cbid");
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/verifybank",
					data: {bankid: bankid},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							$("#bankid").val(bankid);
							$("#OTPVerify").modal("show");
						}
						else
						{
							alert(data.message); 
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
				var bankid = $("#bankid").val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/verifybankbyotp",
					data: {bankid: bankid,otp:otp},
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
                                <h4 class="card-title">Danh sách tài khoản</h4>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <ul class="linked_account">
                                        <?php
										foreach($banklist as $bl)
										{
										?>
										<li>
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="media my-2">
                                                        <span class="mr-3"><i class="fa fa-bank"></i></span>
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1"><?php echo $bl->bank_name;?> - <?php echo $bl->bank_code;?></h5>
                                                            <p>STK <?php echo substr_replace($bl->bank_account,"*************",0,9);?></p>
                                                        </div>
                                                        <div class="edit-option">
                                                            <a bank-id="<?php echo $bl->cbid;?>" class="viewbankdata" href=""><i class="fa fa-eye"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="verify">
														<?php if($bl->bank_status == 0)
														{	
														?>
                                                        <div class="not-verify">
                                                            <span><i class="la la-close"></i></span>
                                                            <a data-cbid="<?php echo $bl->cbid;?>" class="btn-verify-bank" href="#">Chưa xác minh</a>
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
                                        </li>
                                        <?php
										}
										?>
                                    </ul>

                                    <div class="mt-5">
                                        <a href="#" class="btn btn-primary px-4 mr-3" id="addbankbtn">Thêm tài khoản</a>
                                    </div >
									<div class="mt-5">
										1. Sau khi thành viên điền số tài khoản lần đầu tiên sẽ bị ràng buộc vĩnh viễn mà không có bất kỳ thay đổi nào.<br>
2. Để ngăn những người quan tâm sử dụng trang web này như một công cụ gian lận thì bạn vui lòng xác nhận thông tin tài khoản của bạn trước khi đăng ký.<br>
3. Nếu bạn cần thay đổi thông tin vì lý do cần thiết, vui lòng liên hệ với nhân viên chăm sóc khách hàng trực tuyến.<br>
4. Nếu bạn sử dụng nền tảng này để thực hiện bất kỳ hành vi gian lận rửa tiền nào , hệ thống có quyền xem xét tài khoản thành viên hoặc chấm dứt vĩnh viễn các dịch vụ của thành viên mà không cần thông báo trước.

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
<div class="modal fade" id="AddBankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm tài khoản</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
			<?php
			$banks = $this->config->banks();
			?>
                                        <div class="form-group col-xl-12">
                                            <label class="mr-sm-2">Ngân hàng </label>
											<select class="form-control" name="bank" id="bank">
												<option value="" disabled selected>Chọn</option>
												<?php foreach($banks as $bank)
												{
												?>
													<option value="<?php echo $bank->id;?>"><?php echo $bank->bank_name." (".$bank->bank_code.")";?></option>
												<?php
												}
												?>
											</select>
                                        </div>
										<div class="form-group col-xl-12">
                                            <label class="mr-sm-2">Chi nhánh </label>
                                            <input type="text" id="bank_branch" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-xl-12">
                                            <label class="mr-sm-2">Số tài khoản </label>
                                            <input type="text" id="bank_account" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-xl-12">
                                            <label class="mr-sm-2">Chủ tài khoản </label>
                                            <input type="text" id="bank_holder" class="form-control" placeholder="">
                                        </div>
										<div class="form-group col-xl-12">
                                            <label class="mr-sm-2">Hình ảnh </label>
											
                                            <div class="file-upload-wrapper" data-text="Tải ảnh mới">
												<input name="bank_file" id="bank_file" type="file" class="file-upload-field" value="">
											</div>
                                        </div>
                                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-add-bank" class="btn btn-primary">Lưu</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ViewBankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Xem tài khoản</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="scard" style="margin-left: auto;margin-right: auto;">
		  <div class="scard__front scard__part">
			<img class="scard__front-square scard__square" src="<?php echo $template_path;?>/images/little_square.png">
			<img class="scard__front-logo scard__logo" src="">
			<p class="scard_numer"></p>
			<div class="scard__space-75">
			  <span class="scard__label">CHỦ TÀI KHOẢN</span>
			  <p class="scard__info" id="scard_info"></p>
			</div>
			<div class="scard__space-25">
			  <span class="scard__label">CHI NHÁNH</span>
					<p class="scard__info" id="scard_branch"></p>
			</div>
		  </div>
		  
		  <div class="scard__back scard__part">
			<div class="scard__black-line"></div>
			<div class="scard__back-content">
			  <div class="scard__secret">
				<p class="scard__secret--last">000</p>
			  </div>
			  <img class="scard__back-square scard__square" src="<?php echo $template_path;?>/images/little_square.png">
			  <img class="scard__back-logo scard__logo"src="">
			  
			</div>
		  </div>
		  
		</div>
      </div>
      <div class="modal-footer">
        <button style="display: none" type="button" id="btn-delete-bank" data-cbid="" class="btn btn-danger">Xóa thẻ</button>
		<button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
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
									<p class="text-center mb-5">Mã xác thực vừa được gửi đến số điện thoại: <?php echo substr_replace($cus->cus_phone,"******",0,7);?> </p>
                                    <div class="form-group">
                                        <label>Mã OTP</label>
                                        <input type="text" id="otp-value" class="form-control text-center font-weight-bold" value="">
										<input type="hidden" id="bankid" value="">
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
                                        <p>tài khoản của Quý Khách đã được xác minh, giờ đây, Quý Khách có thể sử dụng tài khoản này để rút tiền và thực hiện các giao dịch khác.</p>
                                    </div>

                                    <div class="text-center">
                                        <a href="<?php echo XC_URL;?>/ngan-hang.html" class="btn btn-success pl-5 pr-5 waves-effect">Tiếp theo</a>
                                    </div>
                                </form>
                                <div class="info mt-3">
                                    <p class="text-muted">Nhân viên của LightNing999 không bao giờ hỏi mật khẩu hay mã OTP của Khách hàng!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      </div>
    </div>
  </div>
</div>