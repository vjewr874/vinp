<?php
include_once "header.php";
//CheckWalletBalance
?>

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
					$("#btn-deposite").click(function(){
					var hash = $("#hash").val();
					var method = $("#method").val();
					//var note = $("#recharge_note").val();
					//var transdata = "LND<?php echo $cus->id;?>";
					var trans_amount = $("#recharge_amount").val();
					//var dataString = 'hash=' +  hash + '&transdata=' +  transdata + '&amount=' +  trans_amount	+ '&note=' +  note;
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
								$("#res-deposite-amount").html(data.amount);
								$("#deposite-success").fadeIn(100);
								$("#deposite-form").fadeOut(100);
								
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
			
<div class="buy_sell mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="buyer-seller">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="buyer-info">
                                            <div class="media">
                                                <img class="mr-3" src="<?php echo $upload_path;?>/users/<?php echo $cus->cus_avatar;?>" alt="" width="50">
                                                <div class="media-body">
                                                    <h4><?php echo $cus->cus_fullname;?></h4>
                                                    <h5><?php echo $cus->cus_code;?></h5>
                                                    <a href="#"><?php echo $cus->cus_email;?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="seller-info text-right">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4><?php echo ($cus->cus_class == 1)? "Thành viên vàng" : "Thành viên bạch kim";?></h4>
                                                    <h5><?php echo number_format($cus->cus_point,0);?> Điểm</h5>
													<h5>Nhân viên hỗ trợ: <a href="https://zalo.me/0586491120" target="_blank">Lightning999</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><span class="text-primary">Số dư tài khoản</span></td>
                                                    <td><span class="text-primary"><?php echo number_format($cus->cus_balance,0);?> VNĐ</span></td>
                                                </tr>
												<tr>
                                                    <td>Tài khoản</td>
                                                    <td>
                                                        <div class="text-success"><?php echo $cus->cus_username;?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày mở tài khoản</td>
                                                    <td><?php echo date("d/m/Y",strtotime($cus->cus_registed_date));?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="card">
							<div class="card-body">
                                <div class="buy-sell-widget">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item" style="width: 33.33%"><a class="nav-link active" data-toggle="tab"
                                                href="#buy">Nộp tiền</a>
                                        </li>
                                        <li class="nav-item" style="width: 33.33%"><a class="nav-link" data-toggle="tab" href="#sell">Rút tiền</a>
                                        </li>
										<li class="nav-item" style="width: 33.33%"><a class="nav-link" data-toggle="tab" href="#trans">Chuyển tiền</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-content-default">
                                        <div class="tab-pane fade show active" id="buy" role="tabpanel">
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
												<table class="table">
													<tbody>
														<tr>
															<td><span class="text-primary">Mã yêu cầu</span></td>
															<td><span class="text-primary" id="res-deposite-code"></span></td>
														</tr>
														<tr>
															<td>Ngân hàng</td>
															<td><?php echo $this->config->_config("bank_name");?></td>
														</tr>
														<tr>
															<td>Số tài khoản</td>
															<td><span id="account_number"><?php echo $this->config->_config("bank_account");?></span> <div class="edit-option" style="float: right;"><button data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép." onclick="copyToClipboard('#account_number')" class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></td>
														</tr>
														<tr>
															<td>Tên người nhận</td>
															<td><span id="account_name"><?php echo $this->config->_config("bank_holder");?></span> <div class="edit-option" style="float: right;"><button data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép." onclick="copyToClipboard('#account_name')"  class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></td>
														</tr>
														<tr>
															<td>Số tiền</td>
															<td>
																<div class="text-success" ><span id="res-deposite-amount">2.000.000</span> <div class="edit-option" style="float: right;"><button onclick="copyToClipboard('#res-deposite-amount')"  data-container="body" data-toggle="popover" data-placement="top" data-content="Đã sao chép." class="btn btn-sm btn-primary  waves-effect"><i class="fa fa-copy"></i></button></div></div>
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
                                            <form method="post" name="deposite-form" id="deposite-form" class="currency_validate">
                                                <div class="form-group">
                                                    <label class="mr-sm-2">Tài khoản</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-user"></i></label>
                                                        </div>
                                                        <input type="text" readonly  name="account_username" class="form-control"
                                                            placeholder="" value="<?php echo $cus->cus_code;?>">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-sm-2">Phương thức nộp</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-bank"></i></label>
                                                        </div>
                                                        <select id="method" class="form-control" name="method">
                                                            <option value="1">ATM</option>
                                                            <option value="2">MoMo</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-sm-2">Số tiền nộp (VNĐ) <br>
													<small class="text-muted">(Lưu ý: Số tiền giá trị tối thiểu của một lần giao dịch thấp nhất là 350.000 VND.)</small>
													</label>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-money"></i></label>
                                                        </div>
                                                        <input type="number" id="recharge_amount"  name="recharge_amount" class="form-control"
                                                             min="350000" value="0">
                                                    </div>
                                                </div>
												<input type="hidden" name="hash" id="hash" value="<?php echo bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));?>">
                                                <button type="button" name="submit"
                                                    class="btn btn-success btn-block" id="btn-deposite">Tạo yêu cầu</button>

                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="sell">
                                            <form method="post" name="myform" class="currency2_validate">
                                                <div class="form-group">
                                                    <label class="mr-sm-2">Tài khoản</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-user"></i></label>
                                                        </div>
                                                        <input type="text" readonly  name="account_username" class="form-control"
                                                            placeholder="" value="<?php echo $cus->cus_code;?>">
                                                    </div>
													<div class="d-flex justify-content-between mt-3">
                                                        <p class="mb-0">Số dư:</p>
                                                        <h6 class="mb-0" id="balance_data"><?php echo number_format($cus->cus_balance,0);?> VNĐ</h6>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-sm-2">Tài khoản nhận</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-bank"></i></label>
                                                        </div>
                                                        <select class="form-control" name="withdrawel_bank" id="withdrawel_bank">
                                                            <option value="">Chọn</option>
															<?php foreach($banklist as $bl)
															{
															?>
																<option value="<?php echo $bl->cbid;?>"><?php echo $bl->bank_code;?> <?php echo substr_replace($bl->bank_account,"*************",0,9);?></option>
															<?php
															}
															?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-sm-2">Số tiền rút <br><small class="text-muted">Lưu ý : Số tiền giá trị tối thiểu của một lần rút là 1.000.000 VND . Việc rút tiền yêu cầu phí xử lí là <?php echo $this->config->_config("withdraw_fee");?>% trên tổng số tiền rút</small></label>
													
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-money"></i></label>
                                                        </div>
                                                        <input type="number" id="withdrawel_amount"  name="withdrawel_amount" class="form-control"
                                                            placeholder="0" min="1000000" value="">
                                                    </div>
													<div class="d-flex justify-content-between mt-3">
                                                        <p class="mb-0">Phí:</p>
                                                        <h6 class="mb-0" id="withdrawel_fee"></h6>
                                                    </div>
                                                </div>
												<input type="hidden" name="withdrawel_hash" id="withdrawel_hash" value="<?php echo bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));?>">
                                                <button type="submit" id="btn-withdraw" name="submit"
                                                    class="btn btn-success btn-block">Tạo lệnh rút</button>

                                            </form>
                                        </div>
										<div class="tab-pane fade" id="trans">
                                            <form method="post" name="myform" class="currency2_validate">
                                                <div class="form-group">
                                                    <label class="mr-sm-2">Chuyển tiền</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-bank"></i></label>
                                                        </div>
                                                        <select id="trans_from" class="form-control" name="trans_from">
                                                            <option value="1">Tài khoản chính</option>
                                                            <option value="2">Tài khoản nhị phân</option>
                                                        </select>
                                                    </div>
													<div class="d-flex justify-content-between mt-3">
                                                        <p class="mb-0">Số dư:</p>
                                                        <h6 class="mb-0" id="balance_data_trans"><?php echo number_format($cus->cus_balance,0);?> VNĐ</h6>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-sm-2">Tài khoản nhận</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-bank"></i></label>
                                                        </div>
                                                        <select id="trans_to" class="form-control" name="trans_to">
                                                            <option value="1">Tài khoản chính</option>
                                                            <option value="2">Tài khoản nhị phân</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-sm-2">Số tiền chuyển</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-money"></i></label>
                                                        </div>
                                                        <input type="number" id="trans_amount"  name="trans_amount" class="form-control"
                                                            placeholder="500.000" value="">
                                                    </div>
                                                </div>
												<input type="hidden" name="hash" id="trans_hash" value="<?php echo bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));?>">
                                                <button type="button" id="btn-trans" name="submit"
                                                    class="btn btn-success btn-block">Tạo lệnh chuyển</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Câu hỏi thường gặp</h4>
                            </div>
                            <div class="card-body">
                                <div id="accordion-faq" class="accordion">
                                    <div class="card">
                                        <div class="card-body">
											<h4>Các biện pháp phòng ngừa:</h4>
											<ol>
											  <li>Cùng một tài khoản / địa chỉ gia đình / hộ khẩu / số điện thoại / địa chỉ IP / máy tính dùng chung / môi trường mạng được coi là cùng một thành viên. Nếu nhiều tài khoản và cùng một IP bị truy vấn và tài khoản không rõ ràng, tất cả chúng sẽ bị coi là gian lận tài khoản. </li>
											  <li>Vui lòng xác nhận số tài khoản, nếu sai số tài khoản, công ty chúng tôi không chịu trách nhiệm. Sau khi thành viên tham gia lần đầu tiên, nó sẽ bị ràng buộc mãi mãi mà không có bất kỳ thay đổi nào.</li>
											  <li>Bộ phận kiểm soát rủi ro của công ty sẽ xem xét, vui lòng không vi phạm quy định.</li>
											  <li>Nếu phản hồi chậm do yếu tố mạng, hãy kiên nhẫn.</li>
											  <li>Những hành động quá thường xuyên, hệ thống sẽ tự động lọc ra.</li>
											  <li>Điểm đầu tư lợi nhuận cần nhiều hơn 1000 điểm, vui lòng đảm bảo xác nhận số tài khoản đã điền. Nếu số tài khoản được cung cấp sai , công ty sẽ không thể chịu trách nhiệm.</li>
											  <li>Sau khi thành viên điền vào tài khoản lần đầu tiên, nó sẽ bị ràng buộc vĩnh viễn và sẽ không được thay đổi tùy ý.</li>
											  <li>Đánh giá dự án và kiểm tra mất nhiều thời gian nên các nhà đầu tư thông cảm và vui lòng kiên nhẫn chờ đợi.</li>
											  <li>Đầu tư hợp lệ không bao gồm giao dịch song phương vv..vv bộ phận kiểm soát rủi ro của công ty sẽ xem xét chúng , vui lòng không vi phạm các quy tắc bao gồm các quy tắc rút tiền hoạt động cá nhân.</li>
											  <li>Nếu bạn sử dụng nền tảng này để thực hiện bất kỳ hành vi gian lận rửa tiền nào , công ty có quyền xem xét tài khoản thành viên hoặc chấm dứt vĩnh viễn dịch vụ thành viên mà không cần thông báo trước!</li>
											</ol>
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
										<input type="hidden" id="data_amount" value="">
										<input type="hidden" id="data_bank" value="">
										<input type="hidden" id="data_hash" value="">
										<input type="hidden" id="verifytype" value="withdraw">
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
                                        <p id="verify-success-message">Giao dịch rút tiền của Quý Khách đã được xác nhận. Trung tâm đối soát thanh toán của Lightning999 sẽ thực hiện kiểm tra hợp lệ và chuyển tiền cho Quý Khách trong thời gian sớm nhất! Xin cảm ơn!</p>
                                    </div>

                                    <div class="text-center">
                                        <a href="<?php echo XC_URL;?>/lich-su-giao-dich.html" class="btn btn-success pl-5 pr-5 waves-effect">Tiếp theo</a>
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