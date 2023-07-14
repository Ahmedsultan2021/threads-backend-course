<?php

class users 
{
    public $first_name;
    public $id;
    static public $PI = 3.14;
    public $last_name;
    public $email;
    public $role = 'user';
    protected $password;

    public function __construct($id,$first_name,$last_name,$email,$password) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }


   static  function login($email,$password) {
        $user = Null;
        $password = md5($password);
        require_once("config.php");
        $qry = "SELECT * FROM users WHERE email='$email' And password='$password'";
        $cn = mysqli_connect(DB_HOST,DB_USER_NAME,DB_USER_PW,DB_NAME);
        // var_dump($cn);
        $rslt = mysqli_query($cn,$qry);
        // var_dump($rslt);
        if ($data = mysqli_fetch_assoc($rslt)) {
            switch ($data['role']) {
                case 'user':
                    $user = new users($data['id'],$data['first_name'],$data['last_name'],$email,$password);
                    break;
                case 'admin':
                    $user = new admin($data['id'],$data['first_name'],$data['last_name'],$email,$password);
                    break;
                case 'sp':
                    $user = new superAdmin($data['id'],$data['first_name'],$data['last_name'],$email,$password);
                    break;
            }
        }
        mysqli_close($cn);
        return $user;
    }
    static function signup() {
        
    }
    static function logout() {
        
    }
    function add_post($file_name,$title,$content,$user_id) {
        require_once("config.php");
        $qry = "INSERT into posts(image,title,content,users_id) values('$file_name','$title','$content',$user_id)";
        $cn = mysqli_connect(DB_HOST,DB_USER_NAME,DB_USER_PW,DB_NAME);
        $rslt = mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $rslt;
    }
    function update_post() {
        
    }
    function delete_post() {
        
    }
    function show_all_post() {
        require_once("config.php");
        $qry = "Select * from posts";
        $cn = mysqli_connect(DB_HOST,DB_USER_NAME,DB_USER_PW,DB_NAME);
        $rslt = mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $rslt;
    }
    function show_all_my_post() {
        
    }
    function add_comment() {
        
    }

}


class admin extends users 
{
    public $role = 'admin';
}

class superAdmin extends users 
{
    public $role = 'sp';
}

