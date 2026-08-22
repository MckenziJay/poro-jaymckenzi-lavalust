<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
class StudentController extends Controller
{
 public function index()
 {
  $this->call->view('student_home.php');
 }
 public function profile()
 {
 // Display student profile
 $student = [
    'student_id' => 'MCC2024-00147',
    'name' => 'Jay Mckenzi A. Poro',
    'course' => 'BS Information Technology',
    'year' => '3rd Year',
    'section' => 'F3',
    'email' => 'porojaymack@gmail.com'
 ];
 $this->call->view('student_profile', [ 'student' => $student ]);
 }
}