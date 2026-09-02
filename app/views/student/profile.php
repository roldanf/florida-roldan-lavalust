<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Profile</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }

		:root {
			--bg-a: #0b1220;
			--bg-b: #101a2e;
			--accent: #4f8bff;
			--accent-2: #33e0c2;
			--glass: rgba(255,255,255,0.06);
			--glass-border: rgba(255,255,255,0.14);
			--text-main: #eef2fb;
			--text-dim: #93a1bd;
			--sans: 'Sora', Arial, sans-serif;
			--mono: 'JetBrains Mono', monospace;
		}

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after {
				animation-duration: 0.01ms !important;
				animation-iteration-count: 1 !important;
				transition-duration: 0.01ms !important;
			}
		}

		html, body { height: 100%; }

		body {
			font-family: var(--sans);
			background:
				radial-gradient(60% 50% at 15% 0%, rgba(79,139,255,0.22), transparent 60%),
				radial-gradient(55% 45% at 100% 100%, rgba(51,224,194,0.16), transparent 60%),
				linear-gradient(160deg, var(--bg-a), var(--bg-b));
			min-height: 100vh;
			color: var(--text-main);
			display: flex;
			flex-direction: column;
			align-items: center;
			position: relative;
			overflow-x: hidden;
		}

		/* faint circuit lines */
		body::before {
			content: '';
			position: fixed;
			inset: 0;
			background-image:
				linear-gradient(rgba(255,255,255,0.045) 1px, transparent 1px),
				linear-gradient(90deg, rgba(255,255,255,0.045) 1px, transparent 1px);
			background-size: 44px 44px;
			mask-image: radial-gradient(circle at 50% 20%, black, transparent 70%);
			pointer-events: none;
			z-index: 0;
		}

		/* === FULL-WIDTH NAV BAR === */
		nav {
			position: relative;
			z-index: 3;
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 18px 36px;
			background: rgba(11,18,32,0.65);
			backdrop-filter: blur(14px);
			border-bottom: 1px solid var(--glass-border);
			opacity: 0;
			animation: fadeDown 0.5s ease forwards;
		}

		@keyframes fadeDown {
			from { opacity: 0; transform: translateY(-10px); }
			to { opacity: 1; transform: translateY(0); }
		}

		nav .brand {
			display: flex;
			align-items: center;
			gap: 10px;
		}

		nav .brand .glyph {
			width: 30px;
			height: 30px;
			border-radius: 8px;
			background: linear-gradient(135deg, var(--accent), var(--accent-2));
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: var(--mono);
			font-weight: 700;
			font-size: 13px;
			color: var(--bg-a);
		}

		nav .brand span.name {
			font-weight: 700;
			font-size: 14.5px;
			letter-spacing: 0.01em;
		}

		nav .brand span.name small {
			display: block;
			font-family: var(--mono);
			font-weight: 500;
			font-size: 10px;
			color: var(--text-dim);
			letter-spacing: 0.06em;
			margin-top: 1px;
		}

		nav .links {
			display: flex;
			align-items: center;
			gap: 26px;
		}

		nav a {
			position: relative;
			text-decoration: none;
			color: var(--text-dim);
			font-weight: 500;
			font-size: 14px;
			transition: color 0.2s ease;
		}

		nav a::after {
			content: '';
			position: absolute;
			left: 0; right: 0;
			bottom: -6px;
			height: 2px;
			background: linear-gradient(90deg, var(--accent), var(--accent-2));
			transform: scaleX(0);
			transform-origin: left;
			transition: transform 0.25s ease;
		}

		nav a:hover { color: var(--text-main); }
		nav a:hover::after { transform: scaleX(1); }

		/* === MAIN === */
		main {
			position: relative;
			z-index: 2;
			flex: 1;
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 48px 20px;
		}

		.panel {
			width: 100%;
			max-width: 560px;
			background: var(--glass);
			backdrop-filter: blur(18px);
			border: 1px solid var(--glass-border);
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 30px 70px rgba(0,0,0,0.45);
			opacity: 0;
			transform: translateY(22px);
			animation: rise 0.55s cubic-bezier(0.16,1,0.3,1) 0.15s forwards;
		}

		@keyframes rise {
			to { opacity: 1; transform: translateY(0); }
		}

		.panel-body {
			padding: 34px 32px 30px;
			text-align: center;
		}

		.badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			background: rgba(51,224,194,0.1);
			border: 1px solid rgba(51,224,194,0.35);
			color: var(--accent-2);
			font-family: var(--mono);
			font-size: 10.5px;
			font-weight: 600;
			letter-spacing: 0.05em;
			text-transform: uppercase;
			padding: 5px 14px;
			border-radius: 999px;
			margin-bottom: 22px;
			opacity: 0;
			animation: fadeIn 0.4s ease 0.4s forwards;
		}

		@keyframes fadeIn {
			to { opacity: 1; }
		}

		.badge::before { content: '✓'; }

		.avatar {
			width: 108px;
			height: 108px;
			border-radius: 50%;
			margin: 0 auto 18px;
			overflow: hidden;
			border: 3px solid var(--accent-2);
			box-shadow: 0 8px 24px rgba(0,0,0,0.4);
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
			0%, 100% { box-shadow: 0 8px 24px rgba(0,0,0,0.4), 0 0 0 0 rgba(51,224,194,0.4); }
			50% { box-shadow: 0 8px 24px rgba(0,0,0,0.4), 0 0 0 8px rgba(51,224,194,0); }
		}

		.avatar img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}

		h1 {
			font-size: 1.4rem;
			font-weight: 700;
			letter-spacing: -0.01em;
			margin-bottom: 4px;
			opacity: 0;
			animation: fadeIn 0.4s ease 0.65s forwards;
		}

		.subrole {
			font-family: var(--mono);
			font-size: 12px;
			color: var(--accent-2);
			margin-bottom: 26px;
			opacity: 0;
			animation: fadeIn 0.4s ease 0.75s forwards;
		}

		.fields {
			text-align: left;
			margin-bottom: 4px;
		}

		.field {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 12px;
			padding: 13px 0;
			border-bottom: 1px solid rgba(255,255,255,0.07);
			opacity: 0;
			transform: translateY(8px);
			animation: slideIn 0.4s ease forwards;
		}

		.field:last-child { border-bottom: none; }

		@keyframes slideIn {
			to { opacity: 1; transform: translateY(0); }
		}

		/* staggered reveal, counted only among .field siblings inside .fields */
		.fields .field:nth-child(1) { animation-delay: 0.85s; }
		.fields .field:nth-child(2) { animation-delay: 0.92s; }
		.fields .field:nth-child(3) { animation-delay: 0.99s; }
		.fields .field:nth-child(4) { animation-delay: 1.06s; }
		.fields .field:nth-child(5) { animation-delay: 1.13s; }
		.fields .field:nth-child(6) { animation-delay: 1.20s; }
		.fields .field:nth-child(7) { animation-delay: 1.27s; }
		.fields .field:nth-child(8) { animation-delay: 1.34s; }

		.field .label {
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 13px;
			font-weight: 500;
			color: var(--text-dim);
			white-space: nowrap;
		}

		.field .label::before {
			content: '';
			width: 5px;
			height: 5px;
			border-radius: 50%;
			background: var(--accent);
			flex-shrink: 0;
		}

		.field .value {
			font-family: var(--mono);
			font-size: 13.5px;
			font-weight: 500;
			color: var(--text-main);
			text-align: right;
		}

		.sections { text-align: left; }

		.section-block {
			margin-top: 24px;
			opacity: 0;
			animation: fadeIn 0.5s ease forwards;
		}

		/* staggered reveal, counted only among .section-block siblings inside .sections */
		.sections .section-block:nth-child(1) { animation-delay: 1.42s; }
		.sections .section-block:nth-child(2) { animation-delay: 1.50s; }
		.sections .section-block:nth-child(3) { animation-delay: 1.58s; }
		.sections .section-block:nth-child(4) { animation-delay: 1.66s; }

		.section-title {
			font-family: var(--mono);
			font-size: 11px;
			text-transform: uppercase;
			letter-spacing: 0.06em;
			color: var(--accent-2);
			font-weight: 600;
			margin-bottom: 10px;
			display: flex;
			align-items: center;
			gap: 6px;
		}

		.section-title::before {
			content: '';
			width: 5px;
			height: 5px;
			border-radius: 50%;
			background: var(--accent-2);
			box-shadow: 0 0 6px var(--accent-2);
		}

		.description-text {
			background: rgba(255,255,255,0.04);
			border: 1px solid var(--glass-border);
			border-left: 3px solid var(--accent);
			border-radius: 10px;
			padding: 14px 16px;
			font-size: 13.5px;
			line-height: 1.65;
			color: var(--text-main);
		}

		.tag-group {
			display: flex;
			flex-wrap: wrap;
			gap: 8px;
		}

		.tag {
			background: rgba(255,255,255,0.04);
			border: 1px solid var(--glass-border);
			color: var(--text-main);
			font-family: var(--mono);
			font-size: 11.5px;
			font-weight: 500;
			padding: 6px 12px;
			border-radius: 999px;
			transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
		}

		.tag:hover {
			background: linear-gradient(90deg, var(--accent), var(--accent-2));
			border-color: transparent;
			color: var(--bg-a);
			font-weight: 600;
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
			background: rgba(255,255,255,0.04);
			border: 1px solid var(--glass-border);
			border-radius: 999px;
			padding: 6px 14px 6px 6px;
			text-decoration: none;
			transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
		}

		.social-link:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 18px rgba(0,0,0,0.35);
			background: rgba(255,255,255,0.08);
		}

		.social-icon {
			width: 26px;
			height: 26px;
			border-radius: 50%;
			background: linear-gradient(135deg, var(--accent), var(--accent-2));
			color: var(--bg-a);
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
			color: var(--text-main);
		}

		@media (max-width: 560px) {
			nav { padding: 16px 20px; }
			nav .links { gap: 16px; }
		}
	</style>
</head>
<body>

	<nav>
		<div class="brand">
			<span class="glyph">IT</span>
			<span class="name">Student Portal<small>Registrar Access</small></span>
		</div>
		<div class="links">
			<a href="<?= site_url('student') ?>">Home</a>
			<a href="<?= site_url('student/profile') ?>">Profile</a>
		</div>
	</nav>

	<main>
		<div class="panel">
			<div class="panel-body">
				<span class="badge">Verified by StudentMiddleware</span>

				<div class="avatar">
					<img src="<?= base_url('assets/img/nikolprof.jpeg') ?>"
						 onerror="this.onerror=null;this.src='<?= base_url('assets/img/nikolprof.svg') ?>';"
						 alt="Profile photo of <?= $name ?>">
				</div>

				<h1><?= $name ?></h1>
				<div class="subrole"><?= $course ?> · <?= $section ?></div>

				<div class="fields">
					<div class="field"><span class="label">Student ID</span><span class="value"><?= $student_id ?></span></div>
					<div class="field"><span class="label">Name</span><span class="value"><?= $name ?></span></div>
					<div class="field"><span class="label">Course</span><span class="value"><?= $course ?></span></div>
					<div class="field"><span class="label">Year Level</span><span class="value"><?= $year ?></span></div>
					<div class="field"><span class="label">Section</span><span class="value"><?= $section ?></span></div>
					<div class="field"><span class="label">Email</span><span class="value"><?= $email ?></span></div>
					<div class="field"><span class="label">Address</span><span class="value"><?= $address ?></span></div>
					<div class="field"><span class="label">Contact No.</span><span class="value"><?= $contact_number ?></span></div>
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
	</main>

</body>
</html>
