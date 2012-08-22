<?php
/*
 * Контроллер информации о пользователе
 */
class Users extends CI_Controller
{
    public function index(){
        $this->load->helper('url');
        if(isset($_COOKIE['ci_session'])){
            redirect('users/show', 'location');
        }
        else {
            redirect('users/login', 'location');
        }
    }
    //Метод отображения имени пользователя
    public function show($id = null)
    {
        $this->load->library('session');
        if ($id == null) {
            $id = $this->session->userdata('id');
        }
        $this->load->view("header");
        $this->load->model("User_model");
        $this->load->model("Group_model");
        $data["user"] = $this->User_model->get_user($id);
        $data["groups"] = $this->Group_model->get_by_user($id);
        $data["uid"] = $this->session->userdata('id');
        $this->load->view("users/show", $data);
        $this->load->view("footer");
    }

//Метод отображения школы
    public
    function school($name_school)
    {
        $this->load->view("header");
        $this->load->model("User_model");
        $data["school"] = $this->User_model->get_by_school($name_school);
        $this->load->view("users/show", $data);
        $this->load->view("footer");
    }

//Метод отображения города
    public
    function city($city)
    {
        $this->load->view("header");
        $this->load->model("User_model");
        $data["city"] = $this->User_model->get_by_city($city);
        $this->load->view("users/show", $data);
        $this->load->view("footer");
    }

//Метод отображения отряда
    public
    function group($group)
    {
        $this->load->view("header");
        $this->load->model("User_model");
        $this->load->model("Group_model");
        $data["users"] = $this->User_model->get_by_group($group);
        $data["group"] = $this->Group_model->get_group($group);
        $this->load->view("users/group", $data);
        $this->load->view("footer");
    }

//Метод логина
    public
    function login()
    {
        $this->load->view("header");
        $this->load->model("User_model");
        $this->load->helper('url');
        $login = $this->input->post('login');
        $pass = $this->input->post('password');
        $result = $this->User_model->get_by_login($login);
        if ($pass != null && $result['password'] == $pass) {
            $this->load->library('session');
            $user_data = array(
                'username' => $result['name'],
                'id' => $result['id']
            );
            $this->session->set_userdata($user_data);
            $test = $this->session->userdata('username');
            \
                redirect('/users/show/' . $result['id'], 'location');
        } else {
            $this->load->view('users/login');
        }
        $this->load->view("footer");
    }

    public
    function logout()
    {
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->library('session');
        if ($this->input->cookie('ci_session') != null) {
            $this->session->sess_destroy();
            redirect('users/login', 'location');
        }
    }

    public function add_friend()
    {
        $this->load->model("Friends_model");
        $id = $this->input->post("fid");
        $this->load->library('session');
        $uid = $this->session->userdata('id');
        $this->Friends_model->add_friend($id,$uid);
        echo "OK";
    }
    
    public function get_friends()
    {
        $this->load->model("Friends_model");
        $this->load->model("User_model");
        $this->load->model("Search_model");
        $this->load->library('session');
        $data["uid"] = $this->session->userdata('id');
        $friends = $this->Friends_model->get_friends($data["uid"]);
        $i = 0;
        foreach($friends as $fid)
        {
            $data["friends"][$i] = $this->User_model->get_user($fid["friend_id"]);
            $data["group"][$i] = $this->Search_model->search_group($data["friends"][$i]["id"]);
            $i++;
        }
        $this->load->view("header");
        $this->load->view("users/friends", $data);
        $this->load->view("footer");
    }
}