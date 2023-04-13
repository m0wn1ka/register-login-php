
<?php 
if(isset($_POST["submit1"])){
    $user=new reg2($_POST['username'],$_POST['password'],$_POST["repassword"]);

}
if(isset($_POST["submit2"])){
    login($_POST['username'],$_POST['password']);
 
 }
?>
<?php

setcookie("user_name", "Guru99");
?>
<html>
    <head>
        <title>index page</title>
    </head>
    <body >
        <form method="POST" action="" >
            <input type="text" name="username">name<br>
            <input type="password" name="password">password<br>
            <input type="passwor" name="repassword"> checkpassword<br>
            <input type="submit" name="submit1">
        </form>
       <hr>

       <form action="" method="POST">
        <input type="text" name="username">name<br>
        <input type="password" name="password"> password<br>
        <input type="submit" name="submit2"><br>

</form>
    </body>


    <?php
class reg2{
    public $username;
    public $password;
    public $repassword;

    public $storage="json.json";//for now it will store jsong objects
    public $stored_users;//will store array of above
    public $new_user;//array
    public function __construct($username,$password,$repassword){
        // echo "in constructor".$_POST['username']." ". $_POST['password'];
        $this->username=$username;
        $this->password=$password;
        $this->repassword=$repassword;
        //json decode------json obj to php obj 2nd parameter as true will return ans as array else anz
        //file_get_contens-----file to string
        //json obj 1:curly braces 2:key value are separated by semicolon
        $x=file_get_contents($this->storage);
        $this->stored_users=json_decode($x,true);//json obj to php obj
        $this->new_user=[
            "username" => $this->username,
            "password" => $this->password,
        ];
        if ($this->checkpass()){
        if($this->checkuser()){
            $this->insertuser();
        }

    }
}

public function checkuser(){
    if(empty($this->username) || empty($this->password)){
        //$this->error="both are needed";
        return false;

    }
    else{
        return true;
    }
}
public function checkpass(){
    if($this->password==$this->repassword){
        return true;
    }
    else{
        echo "passwords must match";
        return false;
    }
}
public function checkexist(){
    foreach($this->stored_users  as $user){
        if ($user['username']==$this->username){
           // $this->error="existing user";
        return true;
        }
    }
    return false;
}
public function insertuser(){
    if($this->checkexist()==FALSE){
        array_push($this->stored_users,$this->new_user);
        if(file_put_contents($this->storage,json_encode($this->stored_users,JSON_PRETTY_PRINT))){
            // return $this->success="success fully registerd";
            
        }
        // else{
        //     return $this->error="try agin";
        // }
    }
}


}

function login($n,$p){
    $x=file_get_contents('json.json');
    $y=json_decode($x,true);
    
        foreach($y as $b){
            if ($b['username']==$n ){
                if($b['password']==$p){
                    setcookie("username", "radha");
                // echo "<div><a href='userpage.html'>click to goto user page</a></div>";
                 header("Location:userpage.php");
                // echo "<h1>you have logged in</h1>";
            return true;
            }
        }
        }
        return false;
    
    
}
?>



</html>


