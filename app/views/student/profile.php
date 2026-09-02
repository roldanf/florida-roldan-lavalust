<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Returns an inline SVG glyph for known platforms, or null if unrecognized
 * (caller falls back to initials for anything not listed here).
 */
function social_icon_svg(string $platform): ?string
{
	$platform = strtolower($platform);

	$icons = [
		'github' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.09 3.29 9.4 7.86 10.93.58.1.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.52-1.33-1.28-1.69-1.28-1.69-1.04-.71.08-.7.08-.7 1.15.08 1.76 1.19 1.76 1.19 1.03 1.75 2.69 1.25 3.34.96.1-.75.4-1.25.73-1.54-2.56-.29-5.25-1.28-5.25-5.71 0-1.26.45-2.29 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11 11 0 0 1 5.79 0c2.2-1.49 3.17-1.18 3.17-1.18.64 1.59.24 2.76.12 3.05.74.8 1.18 1.83 1.18 3.09 0 4.44-2.69 5.42-5.26 5.7.41.36.78 1.07.78 2.16 0 1.56-.01 2.82-.01 3.2 0 .31.21.67.8.56C20.71 21.39 24 17.08 24 12 24 5.65 18.85.5 12 .5z"/></svg>',
		'facebook' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M22 12.06C22 6.5 17.52 2 11.94 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.5 1.5-3.89 3.79-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94z"/></svg>',
		'instagram' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.97.24 2.43.4a4.9 4.9 0 0 1 1.77 1.15 4.9 4.9 0 0 1 1.15 1.77c.16.46.35 1.26.4 2.43.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.24 1.97-.4 2.43a4.9 4.9 0 0 1-1.15 1.77 4.9 4.9 0 0 1-1.77 1.15c-.46.16-1.26.35-2.43.4-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.97-.24-2.43-.4a4.9 4.9 0 0 1-1.77-1.15 4.9 4.9 0 0 1-1.15-1.77c-.16-.46-.35-1.26-.4-2.43C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.24-1.97.4-2.43a4.9 4.9 0 0 1 1.15-1.77A4.9 4.9 0 0 1 5.55 1.8c.46-.16 1.26-.35 2.43-.4C9.25 1.34 9.63 1.33 12 1.33Zm0 1.85c-3.15 0-3.5.01-4.74.07-.96.04-1.48.2-1.83.34-.46.18-.79.39-1.14.74a3.06 3.06 0 0 0-.74 1.14c-.14.35-.3.87-.34 1.83-.06 1.24-.07 1.59-.07 4.74s.01 3.5.07 4.74c.04.96.2 1.48.34 1.83.18.46.39.79.74 1.14.35.35.68.56 1.14.74.35.14.87.3 1.83.34 1.24.06 1.59.07 4.74.07s3.5-.01 4.74-.07c.96-.04 1.48-.2 1.83-.34.46-.18.79-.39 1.14-.74.35-.35.56-.68.74-1.14.14-.35.3-.87.34-1.83.06-1.24.07-1.59.07-4.74s-.01-3.5-.07-4.74c-.04-.96-.2-1.48-.34-1.83a3.06 3.06 0 0 0-.74-1.14 3.06 3.06 0 0 0-1.14-.74c-.35-.14-.87-.3-1.83-.34-1.24-.06-1.59-.07-4.74-.07Zm0 3.15a4.84 4.84 0 1 1 0 9.68 4.84 4.84 0 0 1 0-9.68Zm0 1.85a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm5.03-1.99a1.13 1.13 0 1 1 0 2.26 1.13 1.13 0 0 1 0-2.26Z"/></svg>',
		'tiktok' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M16.6 2h-3.2v13.9c0 1.5-1.2 2.7-2.7 2.7a2.7 2.7 0 0 1-2.7-2.7 2.7 2.7 0 0 1 2.7-2.7c.3 0 .6.05.85.13V9.9a5.9 5.9 0 0 0-.85-.06 5.9 5.9 0 0 0-5.9 5.9A5.9 5.9 0 0 0 10.7 21.6a5.9 5.9 0 0 0 5.9-5.9V8.4a8.1 8.1 0 0 0 4.7 1.5V6.7a4.85 4.85 0 0 1-4.7-4.7z"/></svg>',
		'teams' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M22 5.9c-.7.3-1.5.5-2.3.6.8-.5 1.5-1.3 1.8-2.3-.8.5-1.6.8-2.6 1a4.1 4.1 0 0 0-7 3.7A11.6 11.6 0 0 1 3.4 4.6a4.1 4.1 0 0 0 1.3 5.5c-.7 0-1.3-.2-1.9-.5v.1c0 2 1.4 3.6 3.3 4a4.1 4.1 0 0 1-1.9.1c.5 1.6 2.1 2.8 3.9 2.9A8.2 8.2 0 0 1 2 18.6a11.6 11.6 0 0 0 6.3 1.8c7.5 0 11.7-6.3 11.7-11.7v-.5c.8-.6 1.5-1.3 2-2.1Z"/></svg>',
]
	return $icons[$platform] ?? null;
	
}
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

		/* === NAV === */
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

		nav .brand { display: flex; align-items: center; gap: 10px; }

		nav .brand .glyph {
			width: 30px; height: 30px;
			border-radius: 8px;
			background: linear-gradient(135deg, var(--accent), var(--accent-2));
			display: flex; align-items: center; justify-content: center;
			font-family: var(--mono);
			font-weight: 700; font-size: 13px;
			color: var(--bg-a);
		}

		nav .brand span.name { font-weight: 700; font-size: 14.5px; letter-spacing: 0.01em; }

		nav .brand span.name small {
			display: block;
			font-family: var(--mono);
			font-weight: 500; font-size: 10px;
			color: var(--text-dim);
			letter-spacing: 0.06em;
			margin-top: 1px;
		}

		nav .links { display: flex; align-items: center; gap: 26px; }

		nav a {
			position: relative;
			text-decoration: none;
			color: var(--text-dim);
			font-weight: 500; font-size: 14px;
			transition: color 0.2s ease;
		}

		nav a::after {
			content: '';
			position: absolute; left: 0; right: 0; bottom: -6px;
			height: 2px;
			background: linear-gradient(90deg, var(--accent), var(--accent-2));
			transform: scaleX(0); transform-origin: left;
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
			justify-content: center;
			padding: 44px 20px 60px;
		}

		.profile {
			width: 100%;
			max-width: 720px;
			opacity: 0;
			transform: translateY(18px);
			animation: rise 0.55s cubic-bezier(0.16,1,0.3,1) 0.12s forwards;
		}

		@keyframes rise {
			to { opacity: 1; transform: translateY(0); }
		}

		/* --- hero cover --- */
		.cover {
			position: relative;
			height: 128px;
			border-radius: 18px 18px 0 0;
			background:
				repeating-linear-gradient(120deg, rgba(255,255,255,0.05) 0 2px, transparent 2px 22px),
				linear-gradient(120deg, var(--accent), var(--accent-2));
			border: 1px solid var(--glass-border);
			border-bottom: none;
			overflow: hidden;
		}

		.cover .status {
			position: absolute;
			top: 14px; right: 18px;
			display: flex; align-items: center; gap: 6px;
			font-family: var(--mono);
			font-size: 10px; font-weight: 700;
			letter-spacing: 0.05em;
			color: var(--bg-a);
			background: rgba(11,18,32,0.35);
			padding: 5px 10px;
			border-radius: 999px;
		}

		.cover .status .dot {
			width: 6px; height: 6px; border-radius: 50%;
			background: var(--bg-a);
			animation: pulse 1.7s ease-in-out infinite;
		}

		@keyframes pulse {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.3; }
		}

		/* --- identity strip: avatar overlaps cover --- */
		.identity {
			position: relative;
			background: var(--glass);
			backdrop-filter: blur(18px);
			border: 1px solid var(--glass-border);
			border-top: none;
			padding: 0 28px 22px;
			display: flex;
			align-items: flex-end;
			gap: 18px;
		}

		.avatar {
			width: 92px; height: 92px;
			border-radius: 20px;
			margin-top: -46px;
			overflow: hidden;
			border: 3px solid var(--bg-a);
			box-shadow: 0 10px 26px rgba(0,0,0,0.5);
			flex-shrink: 0;
			opacity: 0;
			transform: scale(0.85);
			animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s forwards;
		}

		@keyframes popIn {
			to { opacity: 1; transform: scale(1); }
		}

		.avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }

		.identity .who {
			padding-top: 14px;
			opacity: 0;
			animation: fadeIn 0.45s ease 0.5s forwards;
		}

		@keyframes fadeIn { to { opacity: 1; } }

		.identity h1 { font-size: 1.3rem; font-weight: 700; letter-spacing: -0.01em; }

		.identity .subrole {
			font-family: var(--mono);
			font-size: 11.5px;
			color: var(--accent-2);
			margin-top: 3px;
		}

		.identity .badge {
			margin-left: auto;
			align-self: flex-start;
			margin-top: 14px;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			background: rgba(51,224,194,0.1);
			border: 1px solid rgba(51,224,194,0.35);
			color: var(--accent-2);
			font-family: var(--mono);
			font-size: 10px; font-weight: 600;
			letter-spacing: 0.04em;
			text-transform: uppercase;
			padding: 5px 12px;
			border-radius: 999px;
			white-space: nowrap;
			opacity: 0;
			animation: fadeIn 0.45s ease 0.58s forwards;
		}

		.identity .badge::before { content: '✓'; }

		/* --- info card: two-column grid --- */
		.info-card {
			background: rgba(255,255,255,0.035);
			border: 1px solid var(--glass-border);
			border-top: none;
			padding: 22px 28px;
		}

		.info-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 1px;
			background: var(--glass-border);
			border: 1px solid var(--glass-border);
			border-radius: 12px;
			overflow: hidden;
		}

		.stat {
			background: var(--bg-a);
			padding: 12px 16px;
			opacity: 0;
			transform: translateY(8px);
			animation: slideIn 0.4s ease forwards;
		}

		@keyframes slideIn { to { opacity: 1; transform: translateY(0); } }

		.info-grid .stat:nth-child(1) { animation-delay: 0.62s; }
		.info-grid .stat:nth-child(2) { animation-delay: 0.67s; }
		.info-grid .stat:nth-child(3) { animation-delay: 0.72s; }
		.info-grid .stat:nth-child(4) { animation-delay: 0.77s; }
		.info-grid .stat:nth-child(5) { animation-delay: 0.82s; }
		.info-grid .stat:nth-child(6) { animation-delay: 0.87s; }
		.info-grid .stat:nth-child(7) { animation-delay: 0.92s; }
		.info-grid .stat:nth-child(8) { animation-delay: 0.97s; }

		.stat .k {
			font-family: var(--mono);
			font-size: 9.5px;
			text-transform: uppercase;
			letter-spacing: 0.08em;
			color: var(--text-dim);
			margin-bottom: 5px;
		}

		.stat .v {
			font-size: 13.5px;
			font-weight: 600;
			color: var(--text-main);
			word-break: break-word;
		}

		/* --- lower panel: description / skills / hobbies / social --- */
		.lower-panel {
			background: var(--glass);
			backdrop-filter: blur(18px);
			border: 1px solid var(--glass-border);
			border-top: none;
			border-radius: 0 0 18px 18px;
			padding: 22px 28px 30px;
		}

		.section-block {
			margin-bottom: 22px;
			opacity: 0;
			animation: fadeIn 0.5s ease forwards;
		}

		.section-block:last-child { margin-bottom: 0; }

		.lower-panel .section-block:nth-child(1) { animation-delay: 1.02s; }
		.lower-panel .section-block:nth-child(2) { animation-delay: 1.09s; }
		.lower-panel .section-block:nth-child(3) { animation-delay: 1.16s; }
		.lower-panel .section-block:nth-child(4) { animation-delay: 1.23s; }

		.section-title {
			font-family: var(--mono);
			font-size: 10.5px;
			text-transform: uppercase;
			letter-spacing: 0.08em;
			color: var(--accent-2);
			font-weight: 600;
			margin-bottom: 10px;
			display: flex;
			align-items: center;
			gap: 6px;
		}

		.section-title::before {
			content: '';
			width: 12px; height: 1px;
			background: var(--accent-2);
		}

		.description-text {
			background: rgba(255,255,255,0.03);
			border: 1px solid var(--glass-border);
			border-radius: 10px;
			padding: 14px 16px;
			font-size: 13.5px;
			line-height: 1.65;
			color: var(--text-main);
		}

		.tag-group { display: flex; flex-wrap: wrap; gap: 8px; }

		.tag {
			background: rgba(255,255,255,0.04);
			border: 1px solid var(--glass-border);
			color: var(--text-main);
			font-family: var(--mono);
			font-size: 11.5px; font-weight: 500;
			padding: 6px 12px;
			border-radius: 8px;
			transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
		}

		.tag:hover {
			background: linear-gradient(90deg, var(--accent), var(--accent-2));
			border-color: transparent;
			color: var(--bg-a);
			font-weight: 600;
			transform: translateY(-2px);
		}

		.social-row { display: flex; flex-wrap: wrap; gap: 10px; }

		.social-link {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			background: rgba(255,255,255,0.04);
			border: 1px solid var(--glass-border);
			border-radius: 10px;
			padding: 8px 14px 8px 8px;
			text-decoration: none;
			transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
		}

		.social-link:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 18px rgba(0,0,0,0.35);
			background: rgba(255,255,255,0.08);
		}

		.social-icon {
			width: 24px; height: 24px;
			border-radius: 6px;
			background: linear-gradient(135deg, var(--accent), var(--accent-2));
			color: var(--bg-a);
			display: flex; align-items: center; justify-content: center;
			font-family: var(--mono);
			font-size: 9.5px; font-weight: 700;
			flex-shrink: 0;
		}

		.social-icon svg { display: block; }

		.social-label { font-size: 12.5px; font-weight: 600; color: var(--text-main); }

		@media (max-width: 560px) {
			nav { padding: 16px 20px; }
			nav .links { gap: 16px; }
			.identity { flex-wrap: wrap; }
			.identity .badge { margin-left: 0; margin-top: 8px; }
			.info-grid { grid-template-columns: 1fr; }
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
		<div class="profile">

			<div class="cover">
				<span class="status"><span class="dot"></span>Live</span>
			</div>

			<div class="identity">
				<div class="avatar">
					<img src="<?= base_url('assets/img/dan.png') ?>"
						 onerror="this.onerror=null;this.src='<?= base_url('assets/img/dan.svg') ?>';"
						 alt="Profile photo of <?= $name ?>">
				</div>
				<div class="who">
					<h1><?= $name ?></h1>
					<div class="subrole"><?= $course ?> · <?= $section ?></div>
				</div>
				<span class="badge">Verified</span>
			</div>

			<div class="info-card">
				<div class="info-grid">
					<div class="stat"><div class="k">Student ID</div><div class="v"><?= $student_id ?></div></div>
					<div class="stat"><div class="k">Name</div><div class="v"><?= $name ?></div></div>
					<div class="stat"><div class="k">Course</div><div class="v"><?= $course ?></div></div>
					<div class="stat"><div class="k">Year Level</div><div class="v"><?= $year ?></div></div>
					<div class="stat"><div class="k">Section</div><div class="v"><?= $section ?></div></div>
					<div class="stat"><div class="k">Email</div><div class="v"><?= $email ?></div></div>
					<div class="stat"><div class="k">Address</div><div class="v"><?= $address ?></div></div>
					<div class="stat"><div class="k">Contact No.</div><div class="v"><?= $contact_number ?></div></div>
				</div>
			</div>

			<div class="lower-panel">
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
					<div class="social-row">
						<?php foreach ($social as $platform => $link): ?>
							<?php $icon = social_icon_svg($platform); ?>
							<a class="social-link" href="<?= $link ?>" target="_blank" rel="noopener">
								<span class="social-icon"><?= $icon ?? strtoupper(substr($platform, 0, 2)) ?></span>
								<span class="social-label"><?= ucfirst($platform) ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		</div>
	</main>

</body>
</html>
