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
                        <div id="deposite-success" style="display: none;">
											<div class="alert alert-success" role="alert">
												*Lưu ý: Nếu số tiền và mã Nội dung không trùng khớp, hệ thống sẽ gặp vấn đề trong việc xử lý nạp tiền của bạn.
												<br>
												1.Thông tin tài khoản ngân hàng do chúng tôi cung cấp, Quý khách chỉ được sử dụng 1 (một) lần. Chúng tôi sẽ không chịu trách nhiệm về các mất mát nếu Quý Khách chuyển tiền vào tài khoản ngân hàng cũ.
												<br>

												2.Khi nạp tiền, Quý khách vui lòng chọn hình thức phí chuyển 'Người/Đơn vị chuyển trả phí' để nhận được chính xác số tiền khi nạp tiền.
												<br>

												3.Vui lòng liên hệ với bộ phận chăm sóc khách hàng nếu có bất kỳ thắc mắc nào khác.
											</div>
											
											<div class="table-responsive">
												<table class="table table-deposit-info">
													<tbody>
														<tr>
															<td><span class="text-primary">Mã yêu cầu</span></td>
															<td><span class="text-primary" id="res-deposite-code"></span></td>
														</tr>
														<tr>
															<td>Ngân hàng</td>
															<td id="deposite_display_bankname"></td>
														</tr>
														<tr>
															<td>Số tài khoản</td>
															<td><span id="deposite_display_bank_account"></span> <div class="edit-option" style="float: right;"><button data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép." onclick="copyToClipboard('#deposite_display_bank_account')" class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></td>
														</tr>
														<tr>
															<td>Tên người nhận</td>
															<td><span id="deposite_display_bank_holder"></span> <div class="edit-option" style="float: right;"><button data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép." onclick="copyToClipboard('#deposite_display_bank_holder')"  class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></td>
														</tr>
														<tr>
															<td>Số tiền</td>
															<td>
																<div class="text-success" ><span id="deposite_display_bank_amount"></span> <div class="edit-option" style="float: right;"><button onclick="copyToClipboard('#res-deposite-amount')"  data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép." class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></div>
															</td>
														</tr>
														<tr>
															<td>Nội dung</td>
															<td><span id="deposite_note"></span><div class="edit-option" style="float: right;"><button onclick="copyToClipboard('#deposite_note')"  data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép."  class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></td>
														</tr>
														<tr>
															<td colspan=2 class="text-primary" style="text-align: center;"><i class="fa fa-spinner fa-spin mz-search-round-loading-icon"></i> Đang đợi giao dịch</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
                        <div class="deposit-system">
                            <h4 class="main-subtitle">01. Chọn phương thức thanh toán</h4>
                            <div class="text-center deposit-method-slider owl-theme owl-carousel">
								<?php
								foreach($deposit_banks as $b)
								{
								?>
                                <a href="#" data-id="<?php echo $b->dbid;?>" class="deposit-method-item">
                                    <div class="thumb">
                                        <div class="check">
                                            <img src="<?php echo $template_path; ?>/assets/images/dashboard/payment/check.png" alt="payment">
                                        </div>
                                        <img src="<?php echo $upload_path; ?>/banks/<?php echo $b->bank_logo;?>" class="deposit-img" alt="payment">
                                    </div>
                                </a>
								<?php
								}
								?>
                                <input type="hidden" id="method" value="">
                            </div>
                        </div>
                        <div class="deposit-system">
                            <h4 class="main-subtitle">02. Nhập số tiền muốn nạp:</h4>
                            <form class="make-deposit">
                                <div class="form-group">
                                    <input type="number" step="100000" min="<?php echo $this->config->_config("minimun_deposite");?>" placeholder="Vui lòng nạp tối thiểu <?php echo number_format($this->config->_config("minimun_deposite"),0);?> VNĐ" id="deposit_amount" class="make-amount">
                                </div>
                                <div class="form-group">
                                    <label for="total-profit">Số tiền nạp</label>
                                    <input type="text" readonly id="display_amount" value="0 VNĐ" class="readonly">
                                </div>
								<input type="hidden" name="hash" id="hash" value="<?php echo bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));?>">
                                <div class="form-group">
                                    <button type="button" id="btn-deposite" class="custom-button border-0">Tạo yêu cầu</button>
                                </div>
                            </form>
                        </div>
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
			$("#otp-verify").on("click",function()
			{
				var otp = $("#otp-value").val();
				var amount = $("#data_amount").val();
				var bankid = $("#data_bank").val();
				var hash = $("#data_hash").val();
				$.ajax({
					type: "POST",
					url: "<?php echo XC_URL;?>/api/withdraw",
					data: {amount: amount,otp:otp, bankid: bankid, hash:hash},
					dataType: "json",
					cache: false,
					success: function(data)
					{
						console.log(data);
						if(data.status == "200")
						{
							$("#verify-success-message").html(data.message);
							$("#verify-success").fadeIn(100);
							$("#verify-progress").fadeOut(100);
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
						$("#btn-deposite").html("Đang xử lý...");
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
								$("#btn-deposite").html("Tạo yêu cầu");
							}
						});
						return false;
					});
				});
			</script>
                <?php include_once "footer.php"; ?>