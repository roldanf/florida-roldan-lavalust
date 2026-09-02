<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Information</title>
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

		/* === FULL-WIDTH NAV BAR (not a pill) === */
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
			max-width: 440px;
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

		.panel-head {
			padding: 26px 28px 20px;
			display: flex;
			align-items: flex-start;
			justify-content: space-between;
			gap: 14px;
			border-bottom: 1px solid var(--glass-border);
			background: linear-gradient(90deg, rgba(79,139,255,0.1), transparent 70%);
		}

		.panel-head h1 {
			font-size: 1.3rem;
			font-weight: 700;
			letter-spacing: -0.01em;
		}

		.panel-head .sub {
			font-family: var(--mono);
			font-size: 11px;
			color: var(--accent-2);
			margin-top: 6px;
			letter-spacing: 0.02em;
		}

		.badge {
			flex-shrink: 0;
			display: flex;
			align-items: center;
			gap: 6px;
			font-family: var(--mono);
			font-size: 10px;
			font-weight: 600;
			letter-spacing: 0.05em;
			color: var(--accent-2);
			border: 1px solid rgba(51,224,194,0.35);
			background: rgba(51,224,194,0.08);
			padding: 5px 10px;
			border-radius: 999px;
			white-space: nowrap;
		}

		.badge .dot {
			width: 6px;
			height: 6px;
			border-radius: 50%;
			background: var(--accent-2);
			box-shadow: 0 0 6px var(--accent-2);
			animation: pulse 1.7s ease-in-out infinite;
		}

		@keyframes pulse {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.3; }
		}

		.fields {
			padding: 10px 28px 4px;
		}

		.field {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 12px;
			padding: 14px 0;
			border-bottom: 1px solid rgba(255,255,255,0.07);
			opacity: 0;
			transform: translateY(8px);
			animation: fieldIn 0.4s ease forwards;
		}

		.field:last-child { border-bottom: none; }

		.fields .field:nth-child(1) { animation-delay: 0.42s; }
		.fields .field:nth-child(2) { animation-delay: 0.48s; }
		.fields .field:nth-child(3) { animation-delay: 0.54s; }
		.fields .field:nth-child(4) { animation-delay: 0.60s; }
		.fields .field:nth-child(5) { animation-delay: 0.66s; }
		.fields .field:nth-child(6) { animation-delay: 0.72s; }

		@keyframes fieldIn {
			to { opacity: 1; transform: translateY(0); }
		}

		.field .label {
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 13px;
			font-weight: 500;
			color: var(--text-dim);
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

		.panel-foot {
			padding: 22px 28px 28px;
		}

		.profile-link {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			text-decoration: none;
			background: linear-gradient(90deg, var(--accent), var(--accent-2));
			color: var(--bg-a);
			font-weight: 700;
			font-size: 13.5px;
			padding: 13px;
			border-radius: 12px;
			opacity: 0;
			animation: fieldIn 0.5s ease 0.8s forwards;
			transition: filter 0.2s ease, transform 0.2s ease;
		}

		.profile-link:hover {
			filter: brightness(1.08);
			transform: translateY(-2px);
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
			<div class="panel-head">
				<div>
					<h1>Student Information</h1>
					<div class="sub">record::lookup()</div>
				</div>
				<span class="badge"><span class="dot"></span>Live</span>
			</div>

			<div class="fields">
				<div class="field"><span class="label">Student ID</span><span class="value"><?= $student_id ?></span></div>
				<div class="field"><span class="label">Name</span><span class="value"><?= $name ?></span></div>
				<div class="field"><span class="label">Course</span><span class="value"><?= $course ?></span></div>
				<div class="field"><span class="label">Year Level</span><span class="value"><?= $year ?></span></div>
				<div class="field"><span class="label">Section</span><span class="value"><?= $section ?></span></div>
				<div class="field"><span class="label">Email</span><span class="value"><?= $email ?></span></div>
			</div>

			<div class="panel-foot">
				<a class="profile-link" href="<?= site_url('student/profile') ?>">View Full Profile &rarr;</a>
			</div>
		</div>
	</main>

</body>
</html>
