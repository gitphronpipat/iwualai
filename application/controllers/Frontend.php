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
		$this->load->model('admin/GalleryCategoryModel', 'gallerycategory');
		




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



public function room($hotel_name = null)
{
if ($hotel_name) {

			$search = str_replace('-', ' ', urldecode($hotel_name));

			$hotel = $this->hotel->getHotelByName($search);
			$hotel_id = $hotel['hotel_id'] ?? null;

			$this->_data['hotel'] = $hotel;

			$this->_data['slide_other'] = $hotel_id
				? $this->slide_other->getHotelsslideotherfront($hotel_id)
				: [];

			$this->_data['rooms'] = $hotel_id      // ข้อมูล title/desc
				? $this->room->getRoomByIdfront($hotel_id)
				: [];	

			$this->_data['footer'] = $hotel_id
				? $this->footer->_getFooterfront($hotel_id) 
				: [];
			
			// echo '<pre>';
			// print_r($this->_data);
			// echo '</pre>';
			// exit;
		}

    $this->load->view('hotel/room', $this->_data);
}

public function room_details($hotel_name = null, $room_id = null)
	{
		
		if ($hotel_name) {
			$search = str_replace('-', ' ', urldecode($hotel_name));

			// ✅ เก็บไว้ใน variable ก่อน แล้วค่อยใส่ _data
			$hotel = $this->hotel->getHotelByName($search);
			$hotel_id = $hotel['hotel_id'] ?? null;

			$this->_data['hotel'] = $hotel;

			$this->_data['slide_other'] = $hotel_id
				? $this->slide_other->getHotelsslideotherfront($hotel_id)
				: [];

			$this->_data['rooms'] = $hotel_id      // ข้อมูล title/desc
				? $this->room->getRoomByIdfront($hotel_id)
				: [];
			
			$this->_data['room_facility'] = $room_id      // ข้อมูล title/desc
				? $this->room->getFacilityIdsByRoomIdfront($room_id)
				: [];

			$this->_data['room_gallery'] = $room_id      // ข้อมูล title/desc
				? $this->room->getGalleryIdsByRoomIdfront($room_id)
				: [];


			$this->_data['room_details'] = ($hotel_id && $room_id)
				? $this->room->getRoomByIdRoomfront($hotel_id, $room_id)[0] ?? []
				: [];

			$this->_data['footer'] = $hotel_id
				? $this->footer->_getFooterfront($hotel_id) 
				: [];
			
			

			
			// echo '<pre>';
			// print_r($this->_data);
			// echo '</pre>';
			// exit;
		}

		$this->load->view('hotel/room-details', $this->_data);
		
	}
public function facilities($hotel_name = null)
{
	
		if ($hotel_name) {
			$search = str_replace('-', ' ', urldecode($hotel_name));

			// ✅ เก็บไว้ใน variable ก่อน แล้วค่อยใส่ _data
			$hotel = $this->hotel->getHotelByName($search);
			$hotel_id = $hotel['hotel_id'] ?? null;

			$this->_data['hotel'] = $hotel;

			$this->_data['slide_other'] = $hotel_id
				? $this->slide_other->getHotelsslideotherfront($hotel_id)
				: [];

			$this->_data['facility'] = $hotel_id
				? $this->facility->_getDatafront($hotel_id) 
				: [];


			$this->_data['footer'] = $hotel_id
				? $this->footer->_getFooterfront($hotel_id) 
				: [];
			
			// echo '<pre>';
			// print_r($this->_data);
			// echo '</pre>';
			// exit;
		}

    $this->load->view('hotel/facilities', $this->_data);
}
public function gallery($hotel_name = null)
{
	if ($hotel_name) {
			$search = str_replace('-', ' ', urldecode($hotel_name));

			// ✅ เก็บไว้ใน variable ก่อน แล้วค่อยใส่ _data
			$hotel = $this->hotel->getHotelByName($search);
			$hotel_id = $hotel['hotel_id'] ?? null;

			$this->_data['hotel'] = $hotel;

			$this->_data['slide_other'] = $hotel_id
				? $this->slide_other->getHotelsslideotherfront($hotel_id)
				: [];

			$this->_data['gallerycategory'] = $hotel_id
				? $this->gallerycategory->_getDatagalleryfront($hotel_id) 
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


    $this->load->view('hotel/gallery', $this->_data);
}
public function contact($hotel_name = null)
{
	
		if ($hotel_name) {
			$search = str_replace('-', ' ', urldecode($hotel_name));

			// ✅ เก็บไว้ใน variable ก่อน แล้วค่อยใส่ _data
			$hotel = $this->hotel->getHotelByName($search);
			$hotel_id = $hotel['hotel_id'] ?? null;

			$this->_data['hotel'] = $hotel;

			$this->_data['contact'] = $hotel_id
				? $this->db->where('hotel_id', $hotel_id)->get('contact')->row_array()
				: [];
			// $this->_data['banner_img'] = $hotel_id
			// 	? $this->banner_img->getBannersByHotelIdfront($hotel_id)
			// 	: [];
			
			// $this->_data['room_info'] = $hotel_id
			// 	? $this->home_rooms->get_roomsfront($hotel_id)
			// 	: [];

			// $this->_data['rooms'] = $hotel_id      // ข้อมูล title/desc
			// 	? $this->room->getRoomByIdfront($hotel_id)
			// 	: [];

			// $this->_data['facilities'] = $hotel_id
			// 	? $this->facilities_model->get_facilitiesfront($hotel_id)
			// 	: [];
			
			// $this->_data['facility'] = $hotel_id
			// 	? $this->facility->_getDatafront($hotel_id) 
			// 	: [];
			$this->_data['slide_other'] = $hotel_id
				? $this->slide_other->getHotelsslideotherfront($hotel_id)
				: [];


			$this->_data['footer'] = $hotel_id
				? $this->footer->_getFooterfront($hotel_id) 
				: [];
			
			

			
			// echo '<pre>';
			// print_r($this->_data);
			// echo '</pre>';
			// exit;
		}


    $this->load->view('hotel/contact', $this->_data);
}
}
