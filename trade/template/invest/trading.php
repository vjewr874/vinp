<?php include_once "header.php"; ?>
                <div class="container-fluid">
                    
                    <div class="partners">
                        <h3 class="main-title" style="margin-top: 5px;margin-bottom: 5px;">Giao dịch thị trường</h3>
                        <div class="notification-check-area" style="padding: 6px;border-radius: 8px;">
							<iFrame frameborder="0" scrolling="no" src="<?php echo XC_URL; ?>/trading?game=700&auth=<?php echo $this->config->_config("auth");?>&token=<?php echo $_SESSION['token'];?>" width="100%" height="800px" allowfullscreen></iFrame>
                            
                        </div>
                    </div>
                </div>
                <?php include_once "footer.php"; ?>