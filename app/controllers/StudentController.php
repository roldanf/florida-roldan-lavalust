<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
	public function index()
	{
		
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		$_SESSION['student_access'] = true;

	
		$student = $this->student_data();

		$this->call->view('student/home', $student);
	}

	public function profile()
	{
	
		$student = $this->student_data();

		$this->call->view('student/profile', $student);
	}


	private function student_data()
	{
		return [
			'student_id'      => '2024-00037',
			'name'            => 'Roldan O. Florida',
			'course'          => 'BS Information Technology',
			'year'            => '3rd Year',
			'section'         => 'F1',
			'email'           => 'rldnflorida@gmail.com',
			'address'         => 'Sta. Isabel, Calapan City, Oriental Mindoro, Philippines',
			'contact_number'  => '09369445004',
			'description'     => 'Driven and forward‑thinking IT student with a passion for programming and innovation. Known for strong leadership skills, guiding peers through collaborative projects and inspiring teamwork. Currently honing expertise in coding, system design, and problem‑solving, with the goal of becoming a versatile programmer who creates impactful digital solutions.',
			'skills'          => ['PHP', 'Java', 'JavaScript', 'HTML', 'CSS', 'C#'],
			'hobbies'         => ['Playing Online Games', 'Exploring', 'Coding', 'Inventing', 'Cleaning', 'Eating'],
			'social'          => [
				'facebook'  => 'https://www.facebook.com/profile.php?id=61585165521411',
				'tiktok'    => 'https://www.tiktok.com/@roldan.florida',
				'github'    => 'https://github.com/roldanf',
		 		'instagram' => 'https://www.instagram.com/its.danskieee/',
				'twitter' => 'https://x.com/mysteryman_1111',
			],
		];
	}
}
?>
