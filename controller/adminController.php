<?php
Class adminController extends baseController
{
    public function index()
    {
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		$this->view->show("backend/index");
    }
	public function config()
    {
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		if(isset($_POST['updatekey']) && $_POST['updatekey'] != "")
		{
			global $db;
			$listkey = explode(',',$_POST['updatekey']);
			for($i = 0;$i< count($listkey);$i++)
			{
				$db->query("SELECT id FROM bds_configs WHERE config_key = '".$listkey[$i]."'");
				if($db->num_row())
				{
					$db->query("UPDATE bds_configs SET config_value = '".$_POST[$listkey[$i]]."' WHERE config_key = '".$listkey[$i]."'");
				}
				else
				{
					$db->query("INSERT INTO bds_configs(config_key,config_value) VALUES('".$listkey[$i]."','".$_POST[$listkey[$i]]."')");
				}
			}
			header("Location: ".XC_URL."/admin/config");
		}
		else
		{
			$this->view->show("backend/config");
		}
		
    }
	public function login()
	{
		$this->view->show("backend/login");
	}
	public function transaction($para)
	{
		$this->view->show("backend/add-transaction");
	}
	public function users()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT *, (SELECT count(id) FROM bds_posts WHERE post_author = u.id) as countpost FROM hicrm_users as u
		WHERE user_group IN (1,2,3)
		ORDER BY user_register_time DESC");
		$this->view->data["users"] = $db->fetch_object();
		$this->view->show("backend/users");
	}
	public function customers()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT *, (SELECT count(id) FROM bds_posts WHERE post_author = u.id) as countpost FROM hicrm_users as u
		WHERE user_group IN (4,5)
		ORDER BY user_register_time DESC");
		$this->view->data["users"] = $db->fetch_object();
		$this->view->show("backend/customers");
	}
	public function posts()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		
		$spp = 40;
		$page = 1;
		if(isset($_GET['page']) && $_GET['page'] != "")
		{
			$page = $_GET['page'];
		}
		$cp = $page - 1;
		$db->query("SELECT * FROM bds_posts");
		
		$totalsms = $db->num_row();
		$totalpage = $totalsms/$spp;
		$db->query("SELECT *, p.id as pid FROM bds_posts as p 
		LEFT JOIN hicrm_users as u ON p.post_author = u.id
		LEFT JOIN bds_categories as c ON p.post_category = c.id
		ORDER BY p.post_create_time DESC LIMIT ".$cp*$spp.",".$spp);
		$this->view->data["posts"] = $db->fetch_object();
		$this->view->data['totalpost'] = $totalsms;
		$this->view->data["page"] = $page;
		$this->view->data["spp"] = $spp;
		$this->view->data['totalpage'] = $totalpage;
		$this->view->data["page_name"] = "sms_list";
		$this->view->data["page_title"] = "Danh sách SMS";
		$this->view->show("backend/posts");
	}
	public function places()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT *, p.id as placeid, (SELECT COUNT(*) FROM bds_posts WHERE post_district = p.place_district) as countpost FROM bds_places as p
		LEFT JOIN hicrm_districts as d ON p.place_district = d.id
		LEFT JOIN hicrm_provinces as pr ON p.place_province = pr.id
		");
		$this->view->data["places"] = $db->fetch_object();
		$this->view->show("backend/places");
	}
	public function projects()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT * FROM bds_projects ORDER BY id DESC
		");
		$this->view->data["projects"] = $db->fetch_object();
		$this->view->show("backend/project-manager");
	}
	public function provinces()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT *, (SELECT COUNT(*) FROM bds_posts WHERE post_province = p.id) as countpost FROM hicrm_provinces as p ORDER BY id ASC");
		$this->view->data["provinces"] = $db->fetch_object();
		$this->view->show("backend/province_manager");
	}
	public function menu()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT * FROM bds_menus ORDER BY menu_order ASC");
		$this->view->data["menus"] = $db->fetch_object();
		$this->view->show("backend/menu_manager");
	}
	public function categories()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT *, (SELECT COUNT(*) FROM bds_posts WHERE post_category = c.id) as countpost FROM bds_categories as c ORDER BY id ASC");
		$this->view->data["categories"] = $db->fetch_object();
		$this->view->show("backend/categories_manager");
	}
	public function news()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		
		$db->query("SELECT *, p.id as pid FROM bds_news as p 
		LEFT JOIN hicrm_users as u ON p.news_author = u.id
		LEFT JOIN bds_news_categories as c ON p.news_category = c.id
		ORDER BY p.news_date DESC");
		$this->view->data["posts"] = $db->fetch_object();
		$db->query("SELECT * FROM bds_news_categories");
		$this->view->data["news_cat"] = $db->fetch_object();
		$this->view->data["page_name"] = "news_all";
		$this->view->data["page_title"] = "Danh sách sự kiện";
		$this->view->data["news"] = $db->fetch_object();
		$this->view->show("backend/news_manager");
	}
	public function pages()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		
		$db->query("SELECT *, p.id as pid FROM bds_pages as p 
		LEFT JOIN hicrm_users as u ON p.page_author = u.id
		ORDER BY p.page_date DESC");
		$this->view->data["posts"] = $db->fetch_object();
		$this->view->data["page_name"] = "pages_all";
		$this->view->data["page_title"] = "Danh sách sự kiện";
		$this->view->data["news"] = $db->fetch_object();
		$this->view->show("backend/page_manager");
	}
	public function category()
	{
		if(!(isset($_SESSION['staff']['id']) && $_SESSION['staff']['id'] != "")){ header("Location: ".XC_URL."/admin/login"); }
		global $db;
		$db->query("SELECT * FROM bds_categories ORDER BY id ASC");
		$this->view->data["categories"] = $db->fetch_object();
		$this->view->show("backend/category_manager");
	}
	
	public function postsss($para)
	{
		switch($para[1])
		{
			case "new":
			{
				$this->view->show("backend/post-add");
				break;
			}
			default:
				break;
		}
		
	}
	
	public function upload()
	{
		include('./class.uploader.php');
		$uploader = new Uploader();
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => './uploads/images/tour/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
		
		if($data['isComplete']){
			$files = $data['data'];
			print_r($files);
			global $db;
			$db->query("INSERT INTO sgt_tour_images(tourid,image_path,thumb_path,images_type) VALUES('".$_SESSION['tourid']."','".$files['metas'][0]['name']."','".$files['metas'][0]['name']."','1')");
		}

		if($data['hasErrors']){
			$errors = $data['errors'];
			print_r($errors);
		}
		
		function onFilesRemoveCallback($removed_files){
			foreach($removed_files as $key=>$value){
				$file = '../uploads/' . $value;
				if(file_exists($file)){
					unlink($file);
				}
			}
			
			return $removed_files;
		}
	}
}