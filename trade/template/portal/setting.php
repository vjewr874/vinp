<?php
include_once "header.php";
?>
<div class="settings mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="card-title">Settings</h4>
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
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Cài đặt thông báo</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="#">
                                            <div class="form-row col-6">
                                                <div class="form-group mb-0">
                                                    <label class="toggle">
                                                    <input class="toggle-checkbox" type="checkbox" checked>
                                                    <div class="toggle-switch"></div>
                                                    <span class="toggle-label">Thông báo qua Email</span>
                                                </label>
												<br>
                                                 <label class="toggle">
                                                    <input class="toggle-checkbox" type="checkbox" checked>
                                                    <div class="toggle-switch"></div>
                                                    <span class="toggle-label">Thông báo qua SMS</span>
                                                </label>
													<br>
                                                    <label class="toggle">
                                                    <input class="toggle-checkbox" type="checkbox" checked>
                                                    <div class="toggle-switch"></div>
                                                    <span class="toggle-label">Nhận thông tin khuyến mãi</span>
                                                </label>
                                                </div>

                                                <div class="col-12">
                                                    <button class="btn btn-success">Lưu</button>
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
