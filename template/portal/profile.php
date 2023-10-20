<?php
include_once "header.php";
?>
<script>
		$(document).ready(function() {
			$(".hasDatepicker").datepicker({
				dateFormat: "dd-mm-yy",
				duration: "fast"
			});
			$("#btn-change-pass").on("click",function()
				{
					if($("#old-password").val().length <=3 || $("#new-password").val().length <= 3)
					{
						alert("Mật khẩu không hợp lệ, vui lòng nhập lại");
						$("#old-password").focus();
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
									//$("#message").fadeIn(200);
									alert("Đã đổi thành công mật khẩu. Vui lòng đăng nhập lại!");
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
					
		});
		</script>
<div class="settings mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="card-title">Hồ sơ</h4>
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
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Tổng quan</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo XC_URL;?>/page/updateavatar" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Tài khoản</label>
                                                    <input type="text" readonly class="form-control" placeholder="" value="<?php echo $cus->cus_code;?>">
                                                </div>
                                                <div class="form-group col-xl-12">
                                                    <div class="media align-items-center mb-3">
                                                        <img class="mr-3 rounded-circle mr-0 mr-sm-3"
                                                            src="<?php echo $upload_path;?>/users/<?php echo $cus->cus_avatar;?>" width="55" height="55" alt="">
                                                        <div class="media-body">
                                                            <h4 class="mb-0">Ảnh đại diện</h4>
                                                            <p class="mb-0">Kích thước tối đa 2MB
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="file-upload-wrapper" data-text="Tải ảnh mới">
                                                        <input name="avatar" type="file"
                                                            class="file-upload-field" value="">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success waves-effect">Lưu</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="#">
                                            <div class="form-row">
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Mật khẩu hiện tại</label>
                                                    <input type="password" class="form-control" id="old-password" placeholder="Mật khẩu cũ">
                                                </div>
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Mật khẩu mới</label>
                                                    <input type="password" class="form-control" id="new-password"
                                                        placeholder="Mật khẩu mới">
                                                    <p class="mt-2 mb-0">Lưu ý: Trong trường hợp bất khả kháng, bạn cần thay đổi thông tin, vui lòng liên hệ với nhân viên dịch vụ khách hàng!
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-success waves-effect" id="btn-change-pass">Đổi mật khẩu</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Thông tin tài khoản</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" name="myform" class="personal_validate">
                                            <div class="form-row">
                                                <div class="form-group col-xl-6">
                                                    <label class="mr-sm-2">Họ và tên</label>
                                                    <input type="text" class="form-control"  value="<?php echo $cus->cus_fullname;?>" name="fullname">
                                                </div>
                                                <div class="form-group col-xl-6">
                                                    <label class="mr-sm-2">Điện thoại</label>
                                                    <input type="text" class="form-control"
                                                        readonly value="<?php echo $cus->cus_phone;?>" name="phone">
                                                </div>
												<div class="form-group col-xl-6">
                                                    <label class="mr-sm-2">Email</label>
                                                    <input type="email" class="form-control"
                                                        readonly value="<?php echo $cus->cus_email;?>" name="email">
                                                </div>
                                                <div class="form-group col-xl-6">
                                                    <label class="mr-sm-2">Ngày sinh</label>
                                                    <input type="text" class="form-control hasDatepicker"  value="<?php echo date("d-m-Y",strtotime($cus->cus_birthday));?>"
                                                        id="datepicker" autocomplete="off" name="dob">
                                                </div>
												<div class="form-group col-xl-6">
                                                    <label class="mr-sm-2">CMND</label>
                                                    <input type="text" class="form-control" readonly value="<?php echo $cus->cus_national_id;?>" name="national_id">
                                                </div>
												<div class="form-group col-xl-6">
                                                    <label class="mr-sm-2">Ngày cấp</label>
                                                    <input type="text" class="form-control" readonly value="<?php echo date("d-m-Y",strtotime($cus->cus_national_issue_date));?>"
                                                        autocomplete="off" name="national_issue_date">
                                                </div>
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Địa chỉ</label>
                                                    <input type="text" class="form-control"
                                                          value="<?php echo $cus->cus_address;?>" name="presentaddress">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success waves-effect">Lưu</button>
                                                </div>
                                            </div>
                                        </form>
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