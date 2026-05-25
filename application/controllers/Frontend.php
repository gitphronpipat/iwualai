<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/PHPMailer/class.phpmailer.php');


class Frontend extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/BannerModel', 'banner');
		$this->load->model('admin/TitleModel', 'title_model');
		$this->load->model('admin/HotelModel', 'hotel');
		$this->load->model('admin/SlideotherModel', 'slide_other');
		$this->load->model('admin/FooterModel', 'footer');
				$this->load->model('admin/HotelBannnerImageModel', 'banner_img');
				$this->load->model('admin/HotelHomeFacilitiesModel', 'facilities_model');
				$this->load->model('admin/HotelHomeRoomsModel', 'home_rooms');
				$this->load->model('admin/HotelHomeBannerModel', 'home_banner');
				$this->load->model('admin/RoomModel', 'room');
				$this->load->model('admin/GalleryModel', 'gallery');
						$this->load->model('admin/FacilityModel', 'facility');




		if (!$this->session->has_userdata('lang')) {
			$this->session->set_userdata('lang', 'en');
		}
		$this->_data['lang'] = $this->session->userdata('lang');

	}

	public function set_language($lang)
	{
		$this->session->set_userdata('lang', $lang);

		if (isset($_SERVER['HTTP_REFERER'])) {
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}


	public function index()
	{
		$this->_data['banners'] = $this->banner->getBannersfront();
		$this->_data['bigTitle'] = $this->title_model->getBigTitlefront();
		$this->_data['hotels'] = $this->hotel->getHotelsfront();
		$this->_data['subTitle'] = $this->title_model->getSubTitlefront();


		// echo '<pre>';
		// print_r($this->_data);
		// echo '</pre>';
		// exit;

		$this->load->view('index', $this->_data);
	}

	public function phpinfo()
	{
		$this->load->view('phpinfo');
	}

	public function hotel_index($hotel_name = null)
	{
		
		if ($hotel_name) {
			$search = str_replace('-', ' ', urldecode($hotel_name));

			// ✅ เก็บไว้ใน variable ก่อน แล้วค่อยใส่ _data
			$hotel = $this->hotel->getHotelByName($search);
			$hotel_id = $hotel['hotel_id'] ?? null;

			$this->_data['hotel'] = $hotel;
			$this->_data['about'] = $hotel_id
				? $this->home_banner->get_bannerfront($hotel_id)
				: [];

			$this->_data['banner_img'] = $hotel_id
				? $this->banner_img->getBannersByHotelIdfront($hotel_id)
				: [];
			
			$this->_data['room_info'] = $hotel_id
				? $this->home_rooms->get_roomsfront($hotel_id)
				: [];

			$this->_data['rooms'] = $hotel_id      // ข้อมูล title/desc
				? $this->room->getRoomByIdfront($hotel_id)
				: [];

			$this->_data['facilities'] = $hotel_id
				? $this->facilities_model->get_facilitiesfront($hotel_id)
				: [];
			
			$this->_data['facility'] = $hotel_id
				? $this->facility->_getDatafront($hotel_id) 
				: [];
			
			$this->_data['gallery'] = $hotel_id
				? $this->gallery->getGalleryByHotelfront($hotel_id) 
				: [];

			$this->_data['footer'] = $hotel_id
				? $this->footer->_getFooterfront($hotel_id) 
				: [];
			
			

			
			// echo '<pre>';
			// print_r($this->_data);
			// echo '</pre>';
			// exit;
		}

		$this->load->view('hotel/index', $this->_data);
		
	}

public function hotel_contact($hotel_name = null)
{
	echo '1';
	exit;
    // if ($hotel_name) {
    //     $search = str_replace('-', ' ', urldecode($hotel_name));

    //     $hotel = $this->hotel->getHotelByName($search);
    //     $hotel_id = $hotel['hotel_id'] ?? null;

    //     $this->_data['hotel'] = $hotel;
    //     $this->_data['footer'] = $hotel_id
    //         ? $this->footer->_getFooterfront($hotel_id)
    //         : [];

    //     // เพิ่ม data อื่นที่หน้า contact ต้องใช้
    // }

    $this->load->view('hotel/contact', $this->_data);
}

public function room($hotel_name = null)
{
	echo '1';
	echo $hotel_name;
	exit;
	if($hotel_name) {
		
	}
    // if ($hotel_name) {
    //     $search = str_replace('-', ' ', urldecode($hotel_name));

    //     $hotel = $this->hotel->getHotelByName($search);
    //     $hotel_id = $hotel['hotel_id'] ?? null;

    //     $this->_data['hotel'] = $hotel;
    //     $this->_data['footer'] = $hotel_id
    //         ? $this->footer->_getFooterfront($hotel_id)
    //         : [];

    //     // เพิ่ม data อื่นที่หน้า contact ต้องใช้
    // }

    $this->load->view('room', $this->_data);
}
}
