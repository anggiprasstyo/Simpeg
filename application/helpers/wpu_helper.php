<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    if ($result->num_rows() > 0) {
        return "checked = 'checked' ";
    }
}

if (!function_exists('get_csrf_token')) {
    function get_csrf_token()
    {
        $ci = get_instance();
        // if (!$ci->session->csrf_token) {
        $token = $ci->session->csrf_token = hash('sha1', time());
        // }
        return $token;
    }
}

if (!function_exists('cek_csrf')) {
    function cek_csrf()
    {
        $ci = get_instance();
        if ($ci->input->post('token') != $ci->session->csrf_token or !$ci->input->post('token') or !$ci->session->csrf_token) {
            $ci->session->unset_userdata('csrf_token');
            $ci->output->set_status_header(403);
            show_error('The action you have requested is not allowed.');
            return false;
        }
    }
}

function csrf()
{
    return "<input type='hidden' name='token' value='" . get_csrf_token() . "'>";
}
