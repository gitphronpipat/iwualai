<?php

defined('BASEPATH') or exit('No direct script access allowed');

function gen_namepic($num)
{
    $rundom = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $gen_name = "";
    for ($i = 0; $i < $num; $i++) {
        $gen_name .= substr($rundom, rand(0, strlen($rundom)), 1);
    }
    return $gen_name;
}

function admin_url($path = false)
{
    return base_url('hotel-admin/') . $path; 
}

function auth_url($path = false)
{
    return base_url('hotel-login/') . $path; 
}
