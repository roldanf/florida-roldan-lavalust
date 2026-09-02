<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile ni Cabrera</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }

		:root {
			--maroon: #6d0f24;
			--maroon-deep: #4a0e21;
			--wine: #8c1c3d;
			--pink: #e75480;
			--pink-soft: #fbe4ec;
			--paper: #fff5f8;
			--mono: 'JetBrains Mono', monospace;
			--sans: 'Poppins', Arial, sans-serif;
		}

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after {
				animation-duration: 0.01ms !important;
				animation-iteration-count: 1 !important;
				transition-duration: 0.01ms !important;
			}
		}

		body {
			font-family: var(--sans);
			background:
				radial-gradient(circle at 15% 10%, rgba(231,84,128,0.35), transparent 40%),
				radial-gradient(circle at 85% 90%, rgba(231,84,128,0.25), transparent 45%),
				linear-gradient(135deg, var(--maroon-deep) 0%, var(--maroon) 45%, var(--wine) 100%);
			background-size: 100% 100%, 100% 100%, 220% 220%;
			animation: drift 18s ease-in-out infinite;
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 40px 20px;
			position: relative;
			overflow-x: hidden;
		}

		@keyframes drift {
			0%, 100% { background-position: 0% 0%, 0% 0%, 0% 50%; }
			50% { background-position: 0% 0%, 0% 0%, 100% 50%; }
		}

		body::before {
			content: '';
			position: fixed;
			inset: 0;
			background-image:
				linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
				linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
			background-size: 42px 42px;
			pointer-events: none;
		}

		nav {
			position: relative;
			z-index: 2;
			background: rgba(255,255,255,0.95);
			padding: 12px 26px;
			border-radius: 999px;
			margin-bottom: 34px;
			box-shadow: 0 8px 22px rgba(74,14,33,0.4);
			display: flex;
			align-items: center;
			gap: 6px;
			opacity: 0;
			animation: fadeDown 0.5s ease forwards;
		}

		@keyframes fadeDown {
			from { opacity: 0; transform: translateY(-14px); }
			to { opacity: 1; transform: translateY(0); }
		}

		nav .tag {
			font-family: var(--mono);
			font-size: 11px;
			color: var(--pink);
			font-weight: 700;
			margin-right: 8px;
		}

		nav a {
			position: relative;
			text-decoration: none;
			color: var(--wine);
			font-weight: 600;
			font-size: 14px;
			margin: 0 10px;
			letter-spacing: 0.02em;
			padding-bottom: 2px;
			transition: color 0.2s ease;
		}

		nav a::after {
			content: '';
			position: absolute;
			left: 0;
			bottom: -3px;
			width: 0%;
			height: 2px;
			background: var(--pink);
			border-radius: 2px;
			transition: width 0.25s ease;
		}

		nav a:hover { color: var(--pink); }
		nav a:hover::after { width: 100%; }

		.terminal {
			position: relative;
			z-index: 2;
			width: 100%;
			max-width: 560px;
			background: var(--paper);
			border-radius: 16px;
			box-shadow: 0 20px 50px rgba(74,14,33,0.45);
			overflow: hidden;
			opacity: 0;
			transform: translateY(24px) scale(0.98);
			animation: riseIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
		}

		@keyframes riseIn {
			to { opacity: 1; transform: translateY(0) scale(1); }
		}

		.term-bar {
			background: linear-gradient(90deg, var(--maroon-deep), var(--wine));
			padding: 12px 18px;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.term-dot { width: 11px; height: 11px; border-radius: 50%; }
		.term-dot.r { background: #ff5f57; }
		.term-dot.y { background: #febc2e; }
		.term-dot.g { background: #28c840; }

		.term-title {
			font-family: var(--mono);
			font-size: 12px;
			color: #f3c9d6;
			margin-left: 10px;
		}

		.term-body { padding: 32px; text-align: center; }

		.badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			background: var(--pink);
			color: #fff;
			font-family: var(--mono);
			font-size: 10.5px;
			font-weight: 700;
			letter-spacing: 0.06em;
			text-transform: uppercase;
			padding: 5px 14px;
			border-radius: 999px;
			margin-bottom: 20px;
			opacity: 0;
			animation: fadeIn 0.4s ease 0.4s forwards;
		}

		@keyframes fadeIn {
			to { opacity: 1; }
		}

		.badge::before { content: '✓'; }

		.avatar {
			width: 110px;
			height: 110px;
			border-radius: 50%;
			margin: 0 auto 18px;
			overflow: hidden;
			border: 4px solid var(--pink);
			box-shadow: 0 8px 24px rgba(74,14,33,0.35);
			position: relative;
			opacity: 0;
			transform: scale(0.85);
			animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s forwards,
				pulse 2.6s ease-in-out 1.1s infinite;
		}

		@keyframes popIn {
			to { opacity: 1; transform: scale(1); }
		}

		@keyframes pulse {
			0%, 100% { box-shadow: 0 8px 24px rgba(74,14,33,0.35), 0 0 0 0 rgba(231,84,128,0.45); }
			50% { box-shadow: 0 8px 24px rgba(74,14,33,0.35), 0 0 0 8px rgba(231,84,128,0); }
		}

		.avatar img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}

		h1 {
			color: var(--maroon-deep);
			font-size: 1.5rem;
			font-weight: 700;
			margin-bottom: 4px;
			opacity: 0;
			animation: fadeIn 0.4s ease 0.65s forwards;
		}

		.subrole {
			font-family: var(--mono);
			font-size: 12px;
			color: var(--pink);
			margin-bottom: 24px;
			opacity: 0;
			animation: fadeIn 0.4s ease 0.75s forwards;
		}

		.fields { margin-bottom: 4px; }

		.field {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 12px 14px;
			margin-bottom: 8px;
			background: var(--pink-soft);
			border-radius: 8px;
			border-left: 3px solid var(--pink);
			text-align: left;
			opacity: 0;
			transform: translateX(-10px);
			animation: slideIn 0.45s ease forwards;
			transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
		}

		.field:hover {
			transform: translateX(4px);
			background: #f8d3e0;
			box-shadow: 0 6px 16px rgba(74,14,33,0.18);
		}

		@keyframes slideIn {
			to { opacity: 1; transform: translateX(0); }
		}

		/* staggered reveal, counted only among .field siblings inside .fields */
		.fields .field:nth-child(1) { animation-delay: 0.85s; }
		.fields .field:nth-child(2) { animation-delay: 0.93s; }
		.fields .field:nth-child(3) { animation-delay: 1.01s; }
		.fields .field:nth-child(4) { animation-delay: 1.09s; }
		.fields .field:nth-child(5) { animation-delay: 1.17s; }
		.fields .field:nth-child(6) { animation-delay: 1.25s; }
		.fields .field:nth-child(7) { animation-delay: 1.33s; }
		.fields .field:nth-child(8) { animation-delay: 1.41s; }

		.field .label {
			font-family: var(--mono);
			font-size: 11px;
			text-transform: uppercase;
			letter-spacing: 0.05em;
			color: var(--wine);
			font-weight: 700;
			white-space: nowrap;
		}

		.field .value {
			font-size: 14px;
			font-weight: 500;
			color: var(--maroon-deep);
			text-align: right;
			margin-left: 12px;
		}

		.section-block {
			margin-top: 22px;
			text-align: left;
			opacity: 0;
			animation: fadeIn 0.5s ease forwards;
		}

		/* staggered reveal, counted only among .section-block siblings inside .sections */
		.sections .section-block:nth-child(1) { animation-delay: 1.49s; }
		.sections .section-block:nth-child(2) { animation-delay: 1.57s; }
		.sections .section-block:nth-child(3) { animation-delay: 1.65s; }
		.sections .section-block:nth-child(4) { animation-delay: 1.73s; }

		.section-title {
			font-family: var(--mono);
			font-size: 11px;
			text-transform: uppercase;
			letter-spacing: 0.05em;
			color: var(--wine);
			font-weight: 700;
			margin-bottom: 10px;
			display: flex;
			align-items: center;
			gap: 6px;
		}

		.section-title::before {
			content: '>';
			color: var(--pink);
		}

		.description-text {
			background: var(--pink-soft);
			border-left: 3px solid var(--pink);
			border-radius: 8px;
			padding: 14px 16px;
			font-size: 13.5px;
			line-height: 1.6;
			color: var(--maroon-deep);
		}

		.tag-group {
			display: flex;
			flex-wrap: wrap;
			gap: 8px;
		}

		.tag {
			background: #fff;
			border: 1px solid var(--pink);
			color: var(--wine);
			font-family: var(--mono);
			font-size: 11.5px;
			font-weight: 600;
			padding: 6px 12px;
			border-radius: 999px;
			transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
		}

		.tag:hover {
			background: var(--pink);
			color: #fff;
			transform: translateY(-2px);
		}

		.social-links {
			display: flex;
			flex-wrap: wrap;
			gap: 10px;
		}

		.social-link {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			background: var(--pink-soft);
			border-radius: 999px;
			padding: 6px 14px 6px 6px;
			text-decoration: none;
			transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
		}

		.social-link:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 18px rgba(74,14,33,0.25);
			background: #f8d3e0;
		}

		.social-icon {
			width: 26px;
			height: 26px;
			border-radius: 50%;
			background: linear-gradient(135deg, var(--maroon-deep), var(--pink));
			color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: var(--mono);
			font-size: 10px;
			font-weight: 700;
		}

		.social-label {
			font-size: 12.5px;
			font-weight: 600;
			color: var(--maroon-deep);
		}
	</style>
</head>
<body>

	<nav>
		<span class="tag">IT&nbsp;PORTAL</span>
		<a href="<?= site_url('student') ?>">Home</a>
		<a href="<?= site_url('student/profile') ?>">Cabrera Profile</a>
	</nav>

	<div class="terminal">
		<div class="term-bar">
			<span class="term-dot r"></span>
			<span class="term-dot y"></span>
			<span class="term-dot g"></span>
			<span class="term-title">student_profile.php</span>
		</div>
		<div class="term-body">
			<span class="badge">Verified by StudentMiddleware</span>

			<div class="avatar">
				<img src="<?= base_url('assets/img/nikolprof.jpeg') ?>"
					 onerror="this.onerror=null;this.src='<?= base_url('assets/img/nikolprof.svg') ?>';"
					 alt="Profile photo of <?= $name ?>">
			</div>

			<h1><?= $name ?></h1>
			<div class="subrole"><?= $course ?> · <?= $section ?></div>

			<div class="fields">
				<div class="field"><span class="label">Student_ID</span><span class="value"><?= $student_id ?></span></div>
				<div class="field"><span class="label">Name</span><span class="value"><?= $name ?></span></div>
				<div class="field"><span class="label">Course</span><span class="value"><?= $course ?></span></div>
				<div class="field"><span class="label">Year_Level</span><span class="value"><?= $year ?></span></div>
				<div class="field"><span class="label">Section</span><span class="value"><?= $section ?></span></div>
				<div class="field"><span class="label">Email</span><span class="value"><?= $email ?></span></div>
				<div class="field"><span class="label">Address</span><span class="value"><?= $address ?></span></div>
				<div class="field"><span class="label">Contact_No</span><span class="value"><?= $contact_number ?></span></div>
			</div>

			<div class="sections">
				<div class="section-block">
					<div class="section-title">Description</div>
					<p class="description-text"><?= $description ?></p>
				</div>

				<div class="section-block">
					<div class="section-title">Skills</div>
					<div class="tag-group">
						<?php foreach ($skills as $skill): ?>
							<span class="tag"><?= $skill ?></span>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="section-block">
					<div class="section-title">Hobbies</div>
					<div class="tag-group">
						<?php foreach ($hobbies as $hobby): ?>
							<span class="tag"><?= $hobby ?></span>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="section-block">
					<div class="section-title">Social</div>
					<div class="social-links">
						<?php foreach ($social as $platform => $link): ?>
							<a class="social-link" href="<?= $link ?>" target="_blank" rel="noopener">
								<span class="social-icon"><?= strtoupper(substr($platform, 0, 2)) ?></span>
								<span class="social-label"><?= ucfirst($platform) ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
