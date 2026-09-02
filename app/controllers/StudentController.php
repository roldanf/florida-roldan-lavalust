<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
	public function index()
{
    $data = $this->student_data();
    $data['access_denied'] = $this->session->flashdata('access_denied');

    $this->call->view('student/home', $data);
}

public function profile()
{
    // Example condition — replace with your real check
    if (!$this->session->has_userdata('student_id')) {
        $this->session->set_flashdata('access_denied', 'You must access your profile through the student portal.');
        redirect('student');
        return;
    }

    $data = $this->student_data();
    $data['access_denied'] = $this->session->flashdata('access_denied');

    $this->call->view('student/profile', $data);
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
