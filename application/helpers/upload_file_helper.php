<?php

defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit', '2048M');

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log');

// ✅ helper เช็คว่าเป็นไฟล์รูปภาพหรือไม่
function is_image_ext($ext)
{
    return in_array(strtolower(ltrim($ext, '.')), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
}

// อัพโหลดทีละรูปและอัพโหลด MP3, MP4, PDF, GIF การปรับขนาดแบบรักษาอัตราส่วน
function upload_file($pic, $w, $h, $path)
{
    $CI = &get_instance();
    $config['upload_path']   = $path;
    $config['allowed_types'] = '*';
    $config['file_name']     = $pic;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload($pic)) {
        $data     = $CI->upload->data();
        $name_pic = date("YmdHis") . '_' . gen_namepic(5);
        rename($data['full_path'], $data['file_path'] . $name_pic . $data['file_ext']);

        $picname = $name_pic . $data['file_ext'];

        // ✅ resize เฉพาะไฟล์รูปภาพเท่านั้น
        if (is_image_ext($data['file_ext']) && $w && $h) {
            $config['image_library']  = "gd2";
            $config['source_image']   = $data['file_path'] . $picname;
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['new_image']      = $data['file_path'] . $picname;
            $config['width']          = $w;
            $config['height']         = $h;
            $config['thumb_marker']   = FALSE;
            $config['quality']        = '75%';

            $CI->load->library('image_lib');
            $CI->image_lib->initialize($config);

            if (!$CI->image_lib->resize()) {
                echo $CI->image_lib->display_errors();
            }
            $CI->image_lib->clear();
        }
    } else {
        $picname = '';
        echo $CI->upload->display_errors();
    }

    return $picname;
}


// อัพโหลดทีละหลายๆรูปพร้อมกัน การปรับขนาดแบบรักษาอัตราส่วน
function upload_file_array($pic, $key, $w, $h, $path)
{
    $picname = [];

    $CI = &get_instance();
    $config['upload_path']   = $path;
    $config['allowed_types'] = '*';
    $config['file_name']     = $pic;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    $files = $_FILES;
    for ($i = 0; $i < $key; $i++) {
        $_FILES['nameUpload']['name']     = $files[$pic]['name'][$i];
        $_FILES['nameUpload']['type']     = $files[$pic]['type'][$i];
        $_FILES['nameUpload']['tmp_name'] = $files[$pic]['tmp_name'][$i];
        $_FILES['nameUpload']['error']    = $files[$pic]['error'][$i];
        $_FILES['nameUpload']['size']     = $files[$pic]['size'][$i];

        if ($CI->upload->do_upload('nameUpload')) {
            $data     = $CI->upload->data();
            $name_pic = date("YmdHis") . '_' . gen_namepic(5);
            rename($data['full_path'], $data['file_path'] . $name_pic . $data['file_ext']);

            $picname[$i] = $name_pic . $data['file_ext'];

            // ✅ resize เฉพาะไฟล์รูปภาพเท่านั้น
            if (is_image_ext($data['file_ext']) && $w && $h) {
                $config['image_library']  = "gd2";
                $config['source_image']   = $data['file_path'] . $picname[$i];
                $config['create_thumb']   = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['new_image']      = $data['file_path'] . $picname[$i];
                $config['width']          = $w;
                $config['height']         = $h;
                $config['thumb_marker']   = FALSE;
                $config['quality']        = '75%';

                $CI->load->library('image_lib');
                $CI->image_lib->initialize($config);

                if (!$CI->image_lib->resize()) {
                    echo $CI->image_lib->display_errors();
                }
                $CI->image_lib->clear();
            }
        } else {
            $picname[$i] = '';
            echo $CI->upload->display_errors();
        }
    }

    return $picname;
}


// อัพโหลดทีละรูป การปรับขนาดตามค่าที่กำหนดโดยไม่รักษาอัตราส่วน
function upload_fileFix($pic, $w, $h, $path)
{
    $CI = &get_instance();
    $config['upload_path']   = $path;
    $config['allowed_types'] = '*';
    $config['file_name']     = $pic;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload($pic)) {
        $data     = $CI->upload->data();
        $name_pic = date("YmdHis") . '_' . gen_namepic(5);
        rename($data['full_path'], $data['file_path'] . $name_pic . $data['file_ext']);

        $picname = $name_pic . $data['file_ext'];

        // ✅ resize เฉพาะไฟล์รูปภาพเท่านั้น
        if (is_image_ext($data['file_ext']) && $w && $h) {
            $config['image_library']  = "gd2";
            $config['source_image']   = $data['file_path'] . $picname;
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = FALSE; // ไม่รักษาอัตราส่วน
            $config['new_image']      = $data['file_path'] . $picname;
            $config['width']          = $w;
            $config['height']         = $h;
            $config['thumb_marker']   = FALSE;
            $config['quality']        = '75%';

            $CI->load->library('image_lib');
            $CI->image_lib->initialize($config);

            if (!$CI->image_lib->resize()) {
                echo $CI->image_lib->display_errors();
            }
            $CI->image_lib->clear();
        }
    } else {
        $picname = '';
        echo $CI->upload->display_errors();
    }

    return $picname;
}


// อัพโหลดทีละหลายๆรูปพร้อมกัน การปรับขนาดตามค่าที่กำหนดโดยไม่รักษาอัตราส่วน
function upload_fileFix_array($pic, $key, $w, $h, $path)
{
    $picname = [];

    $CI = &get_instance();
    $config['upload_path']   = $path;
    $config['allowed_types'] = '*';
    $config['file_name']     = $pic;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    $files = $_FILES;
    for ($i = 0; $i < $key; $i++) {
        $_FILES['nameUpload']['name']     = $files[$pic]['name'][$i];
        $_FILES['nameUpload']['type']     = $files[$pic]['type'][$i];
        $_FILES['nameUpload']['tmp_name'] = $files[$pic]['tmp_name'][$i];
        $_FILES['nameUpload']['error']    = $files[$pic]['error'][$i];
        $_FILES['nameUpload']['size']     = $files[$pic]['size'][$i];

        if ($CI->upload->do_upload('nameUpload')) {
            $data     = $CI->upload->data();
            $name_pic = date("YmdHis") . '_' . gen_namepic(5);
            rename($data['full_path'], $data['file_path'] . $name_pic . $data['file_ext']);

            $picname[$i] = $name_pic . $data['file_ext'];

            // ✅ resize เฉพาะไฟล์รูปภาพเท่านั้น
            if (is_image_ext($data['file_ext']) && $w && $h) {
                $config['image_library']  = "gd2";
                $config['source_image']   = $data['file_path'] . $picname[$i];
                $config['create_thumb']   = TRUE;
                $config['maintain_ratio'] = FALSE; // ไม่รักษาอัตราส่วน
                $config['new_image']      = $data['file_path'] . $picname[$i];
                $config['width']          = $w;
                $config['height']         = $h;
                $config['thumb_marker']   = FALSE;
                $config['quality']        = '75%';

                $CI->load->library('image_lib');
                $CI->image_lib->initialize($config);

                if (!$CI->image_lib->resize()) {
                    echo $CI->image_lib->display_errors();
                }
                $CI->image_lib->clear();
            }
        } else {
            $picname[$i] = '';
            echo $CI->upload->display_errors();
        }
    }

    return $picname;
}
