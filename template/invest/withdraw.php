<?php include_once "header.php"; ?>
                <div class="container-fluid">
                    <div class="row justify-content-center mt--85">
                        <div class="col-sm-6 col-lg-6">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="cont">
                                        <span class="title">Tài khoản: <?php echo $cus->cus_username;?></span>
                                        <h5 class="amount"><?php echo $cus->cus_phone;?></h5>
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
                                        <span class="title">Số dư ví điện tử</span>
                                        <h5 class="amount"><?php echo number_format($cus->cus_balance,0);?> VNĐ</h5>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php echo $template_path; ?>/assets/images/dashboard/dashboard1.png" alt="dasboard">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="deposit">
						<?php if(!$bankupdate)
						{
						?>
                        <div class="deposit-system">
						<?php
							$banks = $this->config->banks();
							?>
                           <span style="font-style: italic;font-size: medium;font-weight: bold;color: red;">Để thực hiện rút tiền, bạn cần liên kết tài khoản ngân hàng. Xin lưu ý, để đảm bảo thông tin đăng ký rút tiền, CMND, tên tài khoản ngân hàng phải giống nhau</span>
							<form id="bank_linked_form" enctype="multipart/form-data" class="create_ticket_form row mb-30-none">
								<div class="create_form_group col-sm-12">
									<label for="perfect_money">Ngân hàng:</label>
									<div class="select-item mb-3">
										<select class="select-bar" style="width: 100%" name="frm_link_bank_id" id="frm_link_bank_id">
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
									<input type="text" id="frm_link_bank_account" name="frm_link_bank_account" value="">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="bank_branch">Chi nhánh:</label>
									<input type="text" id="frm_link_bank_branch" name="frm_link_bank_branch" value="">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="litecoin_account">CMND/CCCD Mặt trước:</label>
									<input type="file"  id="frm_link_bank_cmnd_front" readonly value="">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="litecoin_account">CMND/CCCD Mặt sau:</label>
									<input type="file"  id="frm_link_bank_cmnd_back" readonly value="">
								</div>
								<div class="form-group">
                                    <button type="button" id="frm_link_bank_submit" class="custom-button border-0">Liên kết ngay</button>
                                </div>
                            </form>
                        </div>
                        <?php 
						}
						else
						{
							?>
							<form class="create_ticket_form row mb-30-none">
								<div class="create_form_group col-sm-12">
									<label for="frm_withdraw_account">Ngân hàng</label>
									<input type="text" id="frm_withdraw_account" readonly name="frm_withdraw_account" value="<?php echo $banklist->bank_name;?>">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="frm_withdraw_branch">Chi nhánh</label>
									<input type="text" id="frm_withdraw_branch" readonly name="frm_withdraw_branch" value="<?php echo $banklist->bank_branch;?>">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="frm_withdraw_account">Số tài khoản</label>
									<input type="text" id="frm_withdraw_account" readonly name="frm_withdraw_account" value="<?php echo $banklist->bank_account;?>">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="frm_withdraw_balance">Ví điện tử</label>
									<input type="text" id="frm_withdraw_balance" readonly name="frm_withdraw_balance" value="<?php echo number_format($cus->cus_balance,0);?>">
								</div>
								<div class="create_form_group col-sm-12">
									<label for="bank_branch">Số tiền:</label>
									<input type="number" step="100000" min="<?php echo $this->config->_config("minimun_withdraw");?>" id="frm_withdraw_amount" name="frm_withdraw_amount" value="">
								</div>
								<input type="hidden" name="hash" id="hash" value="<?php echo bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));?>">
								<div class="form-group">
                                    <button type="button" id="frm_withdraw_submit" class="custom-button border-0">Gửi yêu cầu</button>
                                </div>
                            </form>
							<?php
						}
						?>
                    </div>
                </div>
				<script>
function copyToClipboard(element) {
 var $temp = $("<input>");
 $("body").append($temp);
 //alert($(element).html());
 $temp.val($(element).html()).select();
 document.execCommand("copy");
 $temp.remove();
}
		$(document).ready(function() {
			$("#bank_linked_form").validate({
				rules: {
					"frm_link_bank_id": {
						required: true,
					},
					"frm_link_bank_branch": {
						required: true,
						minlength: 5
					},
					"frm_link_bank_account": {
						required: true,
						minlength: 6
					},
					frm_link_bank_cmnd_front: {
						required: true
					},
					"frm_link_bank_cmnd_back": {
						required: true
					}
				},
				messages: {
					"frm_link_bank_id": {
						required: "Vui lòng chọn ngân hàng",
					},
					"frm_link_bank_branch": {
						required: "Vui lòng nhập chi nhánh",
						minlength: "Chi nhánh không hợp lệ!"
					},
					"frm_link_bank_account": {
						required: "Vui lòng nhập số tài khoản",
						minlength: "Số tài khoản không hợp lệ!"
					},
					"frm_link_bank_cmnd_front": {
						required: "Vui lòng tải lên CMND mặt trước"
					},
					"frm_link_bank_cmnd_back": {
						required: "Vui lòng tải lên CMND mặt sau"
					}
				}
			});
			$("#frm_link_bank_submit").on("click", function (e) {
				if($("#bank_linked_form").valid())
				{
					var formData = new FormData();
					var bank = $("#frm_link_bank_id option:selected").val();
					var account = $("#frm_link_bank_account").val();
					var branch = $("#frm_link_bank_branch").val();
					formData.append('cmndfront', $("#frm_link_bank_cmnd_front")[0].files[0]);
					formData.append('cmndback', $("#frm_link_bank_cmnd_back")[0].files[0]);
					formData.append('bank',bank);
					formData.append('account',account);
					formData.append('branch',branch);
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/banklinked",
						data: formData,
						dataType: "json",
						cache: false,
						processData: false,  // tell jQuery not to process the data
						contentType: false, 
						enctype: 'multipart/form-data',
						success: function(data)
						{
							if(data.status == 200)
							{
								Swal.fire({
								  icon: 'success',
								  title: 'Chúc mừng!',
								  text: 'Chúc mừng bạn đã liên kết thành công tài khoản ngân hàng, bạn có thể yêu cầu rút tiền ngay bây giờ!',
								  footer: '<a href="<?php echo XC_URL;?>/rut-tien.html">Rút tiền ngay</a>',
								   timer: 1700
								})
								setTimeout(function(){ location.reload();     }, 2000);
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
				
				return false;
			});
			$('[data-toggle="popover"]').popover({trigger: 'focus'});
			var maxbalance = 0;
			
			$("#trans_from").on("change",function()
			{
				var walletid = $(this).val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/CheckWalletBalance",
					data: {walletid: walletid},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							$("#balance_data_trans").html(data.balance);
							maxbalance = data.balance_number;
						}
						else
						{
							$("#walletid").val("");
							Swal.fire(
							  'Lỗi',
							  data.message,
							  'error'
							)
							
						}
					}
				});
				
				return false;
			});
			$("#btn-trans").on("click",function()
			{
				var from = $("#trans_from").val();
				var to = $("#trans_to").val();
				if(from == to)
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Không thể chuyển tiền vào cùng loại tài khoản',
					  footer: '<a href="<?php echo XC_URL;?>">Xem thêm về lỗi này</a>'
					})
				}
				else if(amount <= 0)
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Vui lòng nhập số tiền hợp lệ',
					  footer: '<a href="<?php echo XC_URL;?>">Xem thêm về lỗi này</a>'
					})
				}
				else
				{
					var hash = $("#trans_hash").val();
					var amount  = $("#trans_amount").val();
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/transfer",
						data: {amount: amount, from: from, to:to, hash:hash},
						dataType: "json",
						cache: false,
						success: function(data)
						{
							console.log(data);
							if(data.status == "200")
							{
								
								Swal.fire({
								  icon: 'success',
								  title: 'Thành công',
								  text: 'Xin cảm ơn, giao dịch của Quý Khách đã được thực hiện!',
								  timer: 1700
								})
								
								setTimeout(function(){ location.reload();     }, 2000);
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
				}
				return false;
			});	
			function addCommas(nStr)
			{
				nStr += '';
				x = nStr.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';
				var rgx = /(\d+)(\d{3})/;
				while (rgx.test(x1)) {
					x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}
				return x1 + x2;
			}
			$("#withdrawel_amount").on("change",function()
			{
				var amount = $(this).val();
				var fee = <?php echo $this->config->_config("withdraw_fee");?>/100;
				
				var fee = amount*fee;
				$("#display_amount").val(number_format(amount - fee,0,',','.'));
				$("#withdrawel_fee").html(addCommas(fee) + " VNĐ");
				
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
							Swal.fire(
							  'Lỗi',
							  data.message,
							  'error'
							) 
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
							Swal.fire(
							  'Lỗi',
							  data.message,
							  'error'
							) 
						}
					}
				});
				
				return false;
			});
			$("#btn-withdraw").on("click",function()
			{
				//var otp = $("#otp-value").val();
				var countbank = $("#countbank").val();
				var amount = $("#withdrawel_amount").val();
				var bankid = $("#method").val();
				var cmnd_front = $("#cmnd_front").val();
				var cmnd_back = $("#cmnd_back").val();
				if(bankid == "" )
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Vui lòng chọn ngân hàng',
					  footer: '<a href="<?php echo XC_URL;?>/ngan-hang.html">Thêm tài khoản ngân hàng</a>'
					})
				}
				else if(cmnd_front == "" || cmnd_back == "")
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Vui lòng tải lên giấy tờ tuỳ thân',
					  footer: '<a href="<?php echo XC_URL;?>">Xem thêm về lỗi này</a>'
					})
				}
				else if(amount <= 0)
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Vui lòng nhập số tiền hợp lệ',
					  footer: '<a href="<?php echo XC_URL;?>">Xem thêm về lỗi này</a>'
					})
				}
				else
				{
					
					//var bankid = $("#data_bank").val();
					var hash = $("#withdrawel_hash").val();
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/withdraw",
						data: {amount: amount, bankid: bankid, hash:hash},
						dataType: "json",
						cache: false,
						success: function(data)
						{
							console.log(data);
							if(data.status == "200")
							{
								Swal.fire({
								  icon: 'success',
								  title: 'Chúc mừng!',
								  text: data.message,
								  footer: '<a href="<?php echo XC_URL;?>/lich-su-giao-dich.html">Xem lịch sử giao dịch</a>'
								})
								//$("#verify-success-message").html(data.message);
								//$("#verify-success").fadeIn(100);
								//$("#verify-progress").fadeOut(100);
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
				
				return false;
			});
			$("#frm_withdraw_submit").on("click",function()
			{
				var amount = $("#frm_withdraw_amount").val();
				var hash = $("#hash").val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/requestwithdraw",
					data: {amount: amount,hash:hash},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							Swal.fire({
							  icon: 'success',
							  title: 'Chúc mừng!',
							  text: data.message,
							  footer: '<a href="<?php echo XC_URL;?>/lich-su-giao-dich.html">Xem lịch sử giao dịch</a>',
							   timer: 1700
							})
							setTimeout(function(){ location.reload();     }, 2000);
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
			$("#btn-withdraws").on("click",function()
			{
				var bank = $("#withdrawel_bank").val();
				var amount = $("#withdrawel_amount").val();
				if(bank == "")
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Vui lòng chọn ngân hàng',
					  footer: '<a href="<?php echo XC_URL;?>/ngan-hang.html">Thêm tài khoản ngân hàng</a>'
					})
				}
				else if(amount <= 0)
				{
					Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Vui lòng nhập số tiền hợp lệ',
					  footer: '<a href="<?php echo XC_URL;?>">Xem thêm về lỗi này</a>'
					})
				}
				else
				{
					var hash = $("#withdrawel_hash").val();
					$.ajax({
						type: "POST",
						url: "<?php echo XC_URL;?>/api/checkwithdraw",
						data: {amount: amount},
						dataType: "json",
						cache: false,
						success: function(data)
						{
							console.log(data);
							if(data.status == "200")
							{
								$("#data_amount").val(amount);
								$("#data_bank").val(bank);
								$("#phonedata").html(data.phone);
								$("#data_hash").val(hash);
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
				}
				return false;
			});			
		});
		</script>
		<script>
				$(document).ready(function(){
					$("#deposit_amount").on("change",function(){
						var amount = $("#deposit_amount").val();
						$("#display_amount").val(number_format(amount,0,',','.'));
					});
					$("#btn-deposite").click(function()
					{
						var hash = $("#hash").val();
						var method = $("#method").val();
						var trans_amount = $("#deposit_amount").val();
						$.ajax({
							type: "POST",
							url: "<?php echo XC_URL;?>/api/deposite",
							data: {hash: hash,  amount: trans_amount,method: method},
							dataType: "json",
							cache: false,
							success: function(data)
							{
								console.log(data);
								if(data.status == 200)
								{
									Swal.fire({
									  icon: 'success',
									  title: 'Thành công',
									  text: 'Chúng tôi đã khởi tạo yêu cầu thanh toán, xin vui lòng thực hiện theo hướng dẫn sau!',
									  timer: 1700
									})
									$("#res-deposite-code").html(data.code);
									$("#deposite_note").html(data.depositecode);
									$("#deposite_display_bankname").html(data.bankname);
									$("#deposite_display_bank_account").html(data.bank_account);
									$("#deposite_display_bank_holder").html(data.bank_holder);
									$("#deposite_display_bank_amount").html(data.amount);
									$("#deposite-success").fadeIn(100);
									$(".deposit-system").fadeOut(100);
									
									/*
									Swal.fire({
									  icon: 'success',
									  title: 'Thành công',
									  text: 'Xin cảm ơn, giao dịch của Quý Khách sẽ được kiểm tra trong ít phút!',
									  timer: 1700
									})
									*/
									//setTimeout(function(){ location.reload();     }, 2000);
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
				});
			</script>
                <?php include_once "footer.php"; ?>