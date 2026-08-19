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
			'student_id'      => '2024-00036',
			'name'            => 'Angela Nicole Cabrera',
			'course'          => 'BS Information Technology',
			'year'            => '3rd Year',
			'section'         => 'F1',
			'email'           => 'angelanicole1627@gmail.com',
			'address'         => 'Comunal, Calapan City, Oriental Mindoro, Philippines',
			'contact_number'  => '+63 963 252 9240',
			'description'     => 'A working student and crafter, managing my own small business while studying. I aim to build a career in the IT field abroad, with a dream of becoming a full‑stack developer skilled in backend architecture, database design, and clean, creative layouts.',
			'skills'          => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'C#'],
			'hobbies'         => ['Reading', 'Crafting', 'Watching Movies/Anime', 'Playing ML', 'Cleaning', 'Organizing'],
			'social'          => [
				'facebook'  => 'https://www.facebook.com/ayenisbc',
				'instagram' => 'https://www.instagram.com/ni.colies/',
				'github'    => 'https://github.com/ayennnnbc',
				'tiktok'    => 'https://tiktok.com/@twistfloraa',
			],
		];
	}
}
?>
