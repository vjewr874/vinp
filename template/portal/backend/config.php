<?php include_once "header.php";?>
<main id="main-container">
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Cấu hình</h1>
        </div>
   </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <script>
                    $(document).ready(function(){
                        
						$("#btnupload").on("change", function (e) {			
								var formData = new FormData();
								formData.append('file', $('#btnupload')[0].files[0]);
								$.ajax({
									type: "POST",
									url: "<?php echo XC_URL;?>/api/uploadslider",
									data: formData,
									dataType: "json",
									cache: false,
									processData: false,  // tell jQuery not to process the data
									contentType: false, 
									enctype: 'multipart/form-data',
									success: function(data)
									{
										console.log(data);
										if(data.status = 200)
										{
											$('#fillimage').html('<div class="mr-2 mb-2  boximgdt"><img src="'+data.url+'" class="img-fluid img-thumbnail rounded imgdt " ></div>');
											$("#btnupload").val("");
											
										}
									}
							});
							return false;
							});
                    })
                    </script>
        <div class="block-content block-content-full">
            <form method="POST" action="" class="form-material m-t-40">
                                    <div class="form-group">
                                        <label>Tên website <span class="help"></span></label>
                                        <input type="text" name="website_name" class="form-control form-control-line" value="<?php echo general::getInstance()->get_config("website_name");?>"> </div>
									<div class="form-group">
                                        <label>Mô tả website</label>
                                        <textarea name="website_description" class="form-control" rows="5"><?php echo general::getInstance()->get_config("website_description");?></textarea>
                                    </div>
									<div class="form-group">
                                        <label>Slider</label>
                                        <input type="file" name="btnupload" id="btnupload" accept=".jpg,.png" class="required valid">
                                    </div>
									<div class="form-group row">
									 <div class="col-sm-12">
										<div class="form-group fillimage" id="fillimage"><div class="mr-2 mb-2  boximgdt"><img src="<?php echo $upload_path;?>/general/<?php echo general::getInstance()->get_config("slider_image");?>" class="img-fluid img-thumbnail rounded imgdt " ></div></div>
									</div>
								</div>
                                    <div class="form-group">
                                        <label for="example-email">Admin Email <span class="help"></span></label>
                                        <input type="email" id="admin_email" name="admin_email" class="form-control" value="<?php echo general::getInstance()->get_config("admin_email");?>"> </div>
									<div class="form-group">
                                        <label>SMTP Server <span class="help"></span></label>
                                        <input type="text" name="smtp_server" class="form-control form-control-line" value="<?php echo general::getInstance()->get_config("smtp_server");?>"> </div>
										<div class="form-group">
                                        <label>SMTP Port <span class="help"></span></label>
                                        <input type="text" name="smtp_port" class="form-control form-control-line" value="<?php echo general::getInstance()->get_config("smtp_port");?>"> </div>
									<div class="form-group">
                                        <label>SMTP Protocol<span class="help"></span></label>
                                        <input type="text" name="smtp_protocol" class="form-control form-control-line" value="<?php echo general::getInstance()->get_config("smtp_protocol");?>"> </div>
                                    <div class="form-group">
                                        <label>SMTP Password <span class="help"></span></label>
                                        <input type="text" name="smtp_password" class="form-control form-control-line" value="<?php echo general::getInstance()->get_config("smtp_password");?>"> </div>
									
									<div class="form-group">
                                        <label>SMS API Key</label>
										<input type="text" name="sms_api_key" class="form-control form-control-line" value="<?php echo general::getInstance()->get_config("sms_api_key");?>"> 
                                    </div>
									<div class="form-group">
										<input type="hidden" value="website_name,website_description,admin_email,smtp_server,smtp_port,smtp_protocol,smtp_password,sms_api_key,sms_api_key" name="updatekey">
										<button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu cấu hình</button>
										<br>
									</div>
                                </form>
        </div>
    </div>
    
</div>
    </main>
<?php include_once "footer.php";?>