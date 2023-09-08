<?php 
session_start(); 
$conn = mysqli_connect('localhost','root','','ukl-laundry'); 
$username = stripslashes($_POST['username']); 
$password = md5($_POST['password']); 
$query = "SELECT * FROM user where username='$username' AND password='$password'"; 
$row = mysqli_query($conn,$query); 
$data = mysqli_fetch_array($row);  
$cek = mysqli_num_rows($row);

include "../koneksi.php";
if($cek > 0){
    if($data['role']== 'admin'){ 
        $_SESSION['role']='admin'; 
        $_SESSION['username'] = $data['username']; 
        $_SESSION['id'] = $data['id']; 
        $_SESSION['status_login']=true;
        header('location: admin/dashboard.php'); 
    }else if($data['role'] =='kasir'){
        $_SESSION['role']='kasir';
        $_SESSION['username'] = $data['username'];
        $_SESSION['id']= $data['id']; 
        $_SESSION['status_login']=true;
        header('location: kasir/dashboard.php'); 
    }else if($data['role']== 'owner'){ 
        $_SESSION['role'] ='owner';
        $_SESSION['username'] = $data['username'];
        $_SESSION ['id'] = $data['id'] ;
        $_SESSION['status_login']=true;
        header('location: owner/dashboard.php');} 
    }else{
        echo "<script>alert('Username atau Password salah');location.href='index.php';</script>"; }