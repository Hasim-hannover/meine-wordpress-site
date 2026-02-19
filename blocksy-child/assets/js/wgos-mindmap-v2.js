/*
 * WGOS Mindmap v2 runtime renderer (no build step required)
 * Mount target: #wgos-mindmap-v2-root
 */
(function () {
	'use strict';

	var root = document.getElementById('wgos-mindmap-v2-root');
	if (!root) {
		return;
	}

	var GOLD = '#D4AF37';
	var GOLD_BORDER = 'rgba(212,175,55,0.3)';

	var phases = [
		{ label: 'Fundament', color: '#60A5FA', range: [0, 1, 2] },
		{ label: 'Wachstum', color: '#34D399', range: [3, 4, 5] },
		{ label: 'Skalierung', color: '#FB923C', range: [6] },
	];

	var modules = [
		{
			id: 1,
			label: 'Performance Core',
			icon: '⚡',
			phase: 0,
			color: '#60A5FA',
			claim: 'Schnelle Seiten konvertieren besser.',
			without: 'Jeder Besucher der länger als 3s wartet springt ab – und zahlt trotzdem Ihren CPL.',
			bullets: ['Core Web Vitals: LCP < 2.5s, CLS < 0.1', 'CDN, Critical CSS, Asset-Pipeline', 'Server-Tuning & Lazy Loading'],
			result: '98 Mobile Score',
			resultSub: 'in 14 Tagen (von 45)',
			credits: '15 Credits',
		},
		{
			id: 2,
			label: 'Security & Reliability',
			icon: '🛡',
			phase: 0,
			color: '#818CF8',
			claim: 'Vertrauen beginnt bevor der Besucher klickt.',
			without: 'Ein Malware-Vorfall oder Ausfall kostet mehr als 12 Monate Wartung zusammen.',
			bullets: ['WordPress-Härtung & Update-Management', 'Automatisierte Backups & Uptime-Monitoring', 'Malware-Scan & Disaster Recovery'],
			result: '0 Ausfälle',
			resultSub: 'in 12 Monaten (betreute Projekte)',
			credits: '10 Credits',
		},
		{
			id: 3,
			label: 'Privacy-First Measurement',
			icon: '📡',
			phase: 0,
			color: '#A78BFA',
			claim: 'Entscheidungen brauchen verlässliche Daten.',
			without: 'Ohne sauberes Tracking optimieren Sie auf Schätzungen – und skalieren das Falsche.',
			bullets: ['Server-Side GTM (sGTM)', 'Consent Mode v2 ohne Cookie-Chaos', 'GA4 Event Blueprint + DSGVO-Dokumentation'],
			result: '>92% Tracking',
			resultSub: 'Genauigkeit (von ~55%)',
			credits: '15 Credits',
		},
		{
			id: 4,
			label: 'Technical SEO & IA',
			icon: '🗺',
			phase: 1,
			color: '#34D399',
			claim: 'Struktur entscheidet ob Google Sie versteht.',
			without: 'Ohne saubere IA rankt Content nicht – egal wie gut er geschrieben ist.',
			bullets: ['Crawl-Optimierung & Schema Markup', 'Pillar/Cluster-Planung', 'Interne Verlinkung & URL-Architektur'],
			result: '+340% indexiert',
			resultSub: 'nach IA-Restrukturierung',
			credits: '10 Credits',
		},
		{
			id: 5,
			label: 'Owned Content Engine',
			icon: '✍',
			phase: 1,
			color: '#4ADE80',
			claim: 'Content mit Ablaufdatum ist kein Asset.',
			without: 'Ohne Owned Content bezahlen Sie jeden Monat für Sichtbarkeit, die Ihnen nie gehört.',
			bullets: ['Pillar Pages & Content-Cluster', 'Case Studies & Proof-Assets', 'Lead-Magneten & Nurture-Sequenzen'],
			result: '+180% Traffic',
			resultSub: 'organisch in 6 Monaten',
			credits: '25 Credits/Pillar',
		},
		{
			id: 6,
			label: 'Conversion Engineering',
			icon: '🎯',
			phase: 1,
			color: '#FBBF24',
			claim: 'Traffic ohne Conversion ist Vanity.',
			without: 'Selbst perfekte Rankings bringen keine Leads wenn die Page nicht konvertiert.',
			bullets: ['Landing Page Architektur & CTA-Hierarchie', 'A/B-Testing & Friction-Analyse', 'Offer-Framing & Lead-Formular-Engineering'],
			result: '1.2% → 4.7%',
			resultSub: 'Conversion Rate (B2B)',
			credits: '20 Credits/LP',
		},
		{
			id: 7,
			label: 'Paid Booster',
			icon: '🚀',
			phase: 2,
			color: '#FB923C',
			claim: 'Ads als Verstärker – nicht als Betriebssystem.',
			without: 'Ads ohne Fundament verbrennen Budget. Erst Modul 1–6, dann dieser Turbo.',
			bullets: ['Google & Meta Ads auf konvertierenden Pages', 'n8n-Automation für Lead-Routing', 'Aktivierung erst wenn Fundament steht'],
			result: 'ROAS 6.2x',
			resultSub: 'bei 40% weniger Ad-Spend',
			credits: '15 Credits Setup',
		},
	];

	var state = {
		active: null,
		hovered: null,
		mounted: false,
		showWithout: false,
	};

	var cx = 390;
	var cy = 310;
	var radius = 205;

	function esc(str) {
		return String(str)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
	}

	function getPos(index, total, centerX, centerY, r) {
		var angle = (index / total) * 2 * Math.PI - Math.PI / 2 + 0.15;
		return {
			x: centerX + r * Math.cos(angle),
			y: centerY + r * Math.sin(angle),
		};
	}

	function positions() {
		return modules.map(function (_, i) {
			return getPos(i, modules.length, cx, cy, radius);
		});
	}

	function injectStyles() {
		if (document.getElementById('wgos-mindmap-v2-runtime-styles')) {
			return;
		}

		var style = document.createElement('style');
		style.id = 'wgos-mindmap-v2-runtime-styles';
		style.textContent = '' +
			'.wmm2{background:#070709;color:#fff;border:1px solid rgba(212,175,55,.18);border-radius:14px;padding:28px 14px 40px;margin:0 auto 10px;font-family:"DM Sans","Helvetica Neue",sans-serif;}' +
			'.wmm2-header{text-align:center;margin-bottom:4px;}' +
			'.wmm2-pill{display:inline-block;border:1px solid rgba(212,175,55,.3);border-radius:100px;padding:4px 16px;font-size:10px;letter-spacing:.2em;color:#D4AF37;text-transform:uppercase;margin-bottom:14px;font-weight:500;}' +
			'.wmm2-title{font-size:clamp(20px,3vw,28px);font-weight:800;margin:0 0 8px;letter-spacing:-.03em;line-height:1.2;}' +
			'.wmm2-title span{color:#D4AF37;}' +
			'.wmm2-sub{color:#555;font-size:13px;margin:0;}' +
			'.wmm2-legend{display:flex;gap:20px;margin:16px 0;justify-content:center;flex-wrap:wrap;}' +
			'.wmm2-legend-item{display:flex;align-items:center;gap:6px;}' +
			'.wmm2-legend-dot{width:8px;height:8px;border-radius:50%;}' +
			'.wmm2-legend-label{font-size:11px;color:#666;letter-spacing:.05em;}' +
			'.wmm2-svg-wrap{width:100%;max-width:780px;position:relative;margin:0 auto;}' +
			'.wmm2-panel{width:100%;max-width:700px;margin:4px auto 0;min-height:220px;}' +
			'.wmm2-empty{text-align:center;padding:40px 0;}' +
			'.wmm2-empty-title{color:#222;font-size:13px;}' +
			'.wmm2-empty-phases{display:flex;justify-content:center;gap:24px;margin-top:20px;flex-wrap:wrap;}' +
			'.wmm2-empty-phase{text-align:center;}' +
			'.wmm2-empty-phase-k{font-size:10px;letter-spacing:.1em;text-transform:uppercase;font-weight:700;margin-bottom:4px;}' +
			'.wmm2-empty-phase-v{font-size:11px;color:#444;}' +
			'.wmm2-card{background:#0d0d10;border-radius:14px;overflow:hidden;animation:wmm2FadeUp .3s ease;}' +
			'.wmm2-card-top{height:3px;}' +
			'.wmm2-card-inner{padding:20px 24px;}' +
			'.wmm2-row{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;}' +
			'.wmm2-col-main{flex:1;min-width:220px;}' +
			'.wmm2-head{display:flex;align-items:center;gap:10px;margin-bottom:10px;}' +
			'.wmm2-icon{font-size:22px;}' +
			'.wmm2-meta-k{font-size:9px;letter-spacing:.14em;text-transform:uppercase;font-weight:700;}' +
			'.wmm2-meta-v{font-size:16px;font-weight:700;color:#fff;margin-top:2px;}' +
			'.wmm2-toggle{display:flex;gap:6px;margin-bottom:12px;}' +
			'.wmm2-toggle-btn{font-size:10px;padding:4px 10px;border-radius:4px;border:none;cursor:pointer;transition:all .2s;}' +
			'.wmm2-claim{color:#aaa;font-size:13px;margin:0 0 12px;font-style:italic;line-height:1.55;}' +
			'.wmm2-bullets{margin:0;padding:0 0 0 14px;}' +
			'.wmm2-bullets li{color:#777;font-size:12.5px;line-height:1.8;padding-left:4px;}' +
			'.wmm2-risk{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);border-radius:8px;padding:12px 14px;}' +
			'.wmm2-risk-k{font-size:10px;color:#ef4444;letter-spacing:.1em;text-transform:uppercase;font-weight:700;margin-bottom:6px;}' +
			'.wmm2-risk-v{color:#cc8888;font-size:13px;margin:0;line-height:1.6;}' +
			'.wmm2-col-side{display:flex;flex-direction:column;gap:10px;min-width:150px;}' +
			'.wmm2-stat{border-radius:10px;padding:14px 16px;text-align:center;}' +
			'.wmm2-stat-k{font-size:9px;letter-spacing:.12em;text-transform:uppercase;font-weight:700;margin-bottom:6px;}' +
			'.wmm2-stat-v{font-size:20px;font-weight:800;color:#fff;line-height:1.1;}' +
			'.wmm2-stat-s{font-size:10px;color:#555;margin-top:4px;}' +
			'.wmm2-credits{background:#111115;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:10px 14px;text-align:center;}' +
			'.wmm2-credits-k{font-size:9px;color:#555;letter-spacing:.1em;text-transform:uppercase;margin-bottom:4px;}' +
			'.wmm2-credits-v{font-size:13px;color:#D4AF37;font-weight:700;}' +
			'.wmm2-foot{display:flex;justify-content:space-between;align-items:center;margin-top:16px;padding-top:14px;border-top:1px solid rgba(255,255,255,.05);flex-wrap:wrap;gap:10px;}' +
			'.wmm2-nav{display:flex;gap:8px;}' +
			'.wmm2-nav button{background:none;border:1px solid rgba(255,255,255,.1);color:#666;padding:5px 12px;border-radius:5px;cursor:pointer;font-size:11px;}' +
			'.wmm2-nav span{color:#333;font-size:11px;align-self:center;}' +
			'.wmm2-cta{background:#D4AF37;color:#000;padding:8px 18px;border-radius:6px;font-size:11px;font-weight:700;text-decoration:none;letter-spacing:.04em;display:inline-block;}' +
			'.wmm2-seq{margin-top:28px;display:flex;align-items:center;gap:0;overflow-x:auto;max-width:680px;width:100%;justify-content:center;flex-wrap:wrap;row-gap:8px;margin-left:auto;margin-right:auto;}' +
			'.wmm2-seq-item{display:flex;align-items:center;}' +
			'.wmm2-seq-dot{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;cursor:pointer;transition:all .2s;}' +
			'.wmm2-seq-line{width:16px;height:1px;background:rgba(255,255,255,.08);margin:0 2px;}' +
			'.wmm2-seq-note{color:#2a2a2a;font-size:10px;margin-top:8px;letter-spacing:.06em;text-align:center;}' +
			'.wmm2-svg-node{cursor:pointer;transition:opacity .5s,transform .5s;}' +
			'.wmm2-svg-node text{user-select:none;}' +
			'@keyframes wmm2FadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}' +
			'@media (max-width: 900px){.wmm2{padding:22px 10px 28px}.wmm2-card-inner{padding:16px}.wmm2-svg-wrap svg{max-height:460px}}';
		document.head.appendChild(style);
	}

	function renderRingsSvg() {
		return '' +
			'<circle cx="' + cx + '" cy="' + cy + '" r="' + (radius - 10) + '" fill="none" stroke="' + GOLD + '" stroke-width="0.8" opacity="0.12">' +
			'<animate attributeName="opacity" values="0.05;0.18;0.05" dur="3.6s" repeatCount="indefinite"/></circle>' +
			'<circle cx="' + cx + '" cy="' + cy + '" r="' + (radius + 30) + '" fill="none" stroke="' + GOLD + '" stroke-width="0.8" opacity="0.1">' +
			'<animate attributeName="opacity" values="0.03;0.14;0.03" dur="4.2s" repeatCount="indefinite"/></circle>' +
			'<circle cx="' + cx + '" cy="' + cy + '" r="' + (radius + 55) + '" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="0.8" opacity="0.07">' +
			'<animate attributeName="opacity" values="0.03;0.11;0.03" dur="4.8s" repeatCount="indefinite"/></circle>';
	}

	function renderLinesSvg(pos) {
		return pos.map(function (p, i) {
			var mod = modules[i];
			var isActive = state.active === i;
			var isHover = state.hovered === i;
			var stroke = isActive ? mod.color : isHover ? GOLD : 'rgba(255,255,255,0.06)';
			var strokeWidth = isActive ? 1.5 : 0.8;
			var dash = isActive ? 'none' : '3 5';
			return '<line x1="' + cx + '" y1="' + cy + '" x2="' + p.x + '" y2="' + p.y + '" stroke="' + stroke + '" stroke-width="' + strokeWidth + '" stroke-dasharray="' + dash + '" />';
		}).join('');
	}

	function renderNodesSvg(pos) {
		return pos.map(function (p, i) {
			var mod = modules[i];
			var phaseColor = phases[mod.phase].color;
			var isActive = state.active === i;
			var isHover = state.hovered === i;
			var stroke = isActive ? mod.color : isHover ? phaseColor : 'rgba(255,255,255,0.1)';
			var fill = isActive ? mod.color + '18' : '#0f0f12';
			var nodeOpacity = state.mounted ? 1 : 0;
			var nodeScale = state.mounted ? 1 : 0.5;
			var delay = (i * 0.07).toFixed(2);

			return '' +
				'<g class="wmm2-svg-node" data-node-index="' + i + '" style="opacity:' + nodeOpacity + ';transform:scale(' + nodeScale + ');transform-origin:' + p.x + 'px ' + p.y + 'px;transition-delay:' + delay + 's;">' +
				(isActive ? '<circle cx="' + p.x + '" cy="' + p.y + '" r="52" fill="none" stroke="' + mod.color + '" stroke-width="1" opacity="0.25" />' : '') +
				'<circle cx="' + p.x + '" cy="' + p.y + '" r="44" fill="' + fill + '" stroke="' + stroke + '" stroke-width="' + (isActive ? 1.8 : 1) + '" />' +
				'<path d="M ' + (p.x - 28) + ' ' + (p.y - 38) + ' A 44 44 0 0 1 ' + (p.x + 28) + ' ' + (p.y - 38) + '" fill="none" stroke="' + phaseColor + '" stroke-width="2.5" stroke-linecap="round" opacity="' + (isActive ? 1 : 0.4) + '" />' +
				'<text x="' + p.x + '" y="' + (p.y - 20) + '" text-anchor="middle" fill="' + (isActive ? mod.color : '#444') + '" font-size="8.5" font-weight="700" letter-spacing="0.08em">0' + (i + 1) + '</text>' +
				'<text x="' + p.x + '" y="' + (p.y + 2) + '" text-anchor="middle" font-size="17" dominant-baseline="middle">' + mod.icon + '</text>' +
				'<text x="' + p.x + '" y="' + (p.y + 22) + '" text-anchor="middle" fill="' + (isActive ? '#fff' : '#999') + '" font-size="8.5" font-weight="' + (isActive ? 600 : 400) + '">' + esc(mod.label.split(' ').slice(0, 2).join(' ')) + '</text>' +
				'</g>';
		}).join('');
	}

	function renderSvg() {
		var pos = positions();
		return '' +
			'<svg viewBox="0 0 780 620" width="100%" style="display:block;overflow:visible;">' +
			'<defs>' +
			'<radialGradient id="wmm2-centerBg" cx="50%" cy="50%" r="50%">' +
			'<stop offset="0%" stop-color="rgba(212,175,55,0.18)" />' +
			'<stop offset="70%" stop-color="rgba(212,175,55,0.04)" />' +
			'<stop offset="100%" stop-color="transparent" />' +
			'</radialGradient>' +
			'</defs>' +
			renderRingsSvg() +
			renderLinesSvg(pos) +
			'<circle cx="' + cx + '" cy="' + cy + '" r="100" fill="url(#wmm2-centerBg)" />' +
			'<circle cx="' + cx + '" cy="' + cy + '" r="72" fill="#0c0c0e" stroke="' + GOLD + '" stroke-width="1.5" />' +
			'<circle cx="' + cx + '" cy="' + cy + '" r="66" fill="none" stroke="' + GOLD_BORDER + '" stroke-width="0.5" />' +
			'<text x="' + cx + '" y="' + (cy - 22) + '" text-anchor="middle" fill="' + GOLD + '" font-size="13" font-weight="800" letter-spacing="0.15em">WGOS</text>' +
			'<text x="' + cx + '" y="' + (cy - 4) + '" text-anchor="middle" fill="#777" font-size="8.5" letter-spacing="0.06em">OWNED LEADS</text>' +
			'<text x="' + cx + '" y="' + (cy + 10) + '" text-anchor="middle" fill="#555" font-size="8" letter-spacing="0.06em">MIT WORDPRESS</text>' +
			'<text x="' + cx + '" y="' + (cy + 28) + '" text-anchor="middle" fill="#333" font-size="7.5" letter-spacing="0.08em">1 → 2 → 3 → ... → 7</text>' +
			renderNodesSvg(pos) +
			'</svg>';
	}

	function renderEmptyPanel() {
		return '' +
			'<div class="wmm2-empty">' +
			'<div class="wmm2-empty-title">Wähle ein Modul aus der Map</div>' +
			'<div class="wmm2-empty-phases">' +
			phases.map(function (p) {
				var v = p.label === 'Fundament' ? 'Module 01–03' : p.label === 'Wachstum' ? 'Module 04–06' : 'Modul 07';
				return '<div class="wmm2-empty-phase"><div class="wmm2-empty-phase-k" style="color:' + p.color + ';">' + esc(p.label) + '</div><div class="wmm2-empty-phase-v">' + v + '</div></div>';
			}).join('') +
			'</div>' +
			'</div>';
	}

	function renderActivePanel(mod, index) {
		var list = mod.bullets.map(function (b) { return '<li>' + esc(b) + '</li>'; }).join('');
		var body = state.showWithout
			? ('<div class="wmm2-risk"><div class="wmm2-risk-k">⚠ Risiko</div><p class="wmm2-risk-v">' + esc(mod.without) + '</p></div>')
			: ('<p class="wmm2-claim">"' + esc(mod.claim) + '"</p><ul class="wmm2-bullets">' + list + '</ul>');

		var bringStyle = state.showWithout
			? 'background:#1a1a1e;color:#666;font-weight:400;'
			: 'background:' + mod.color + ';color:#000;font-weight:700;';
		var riskStyle = state.showWithout
			? 'background:#ef4444;color:#fff;font-weight:700;'
			: 'background:#1a1a1e;color:#666;font-weight:400;';

		return '' +
			'<div class="wmm2-card" style="border:1px solid ' + mod.color + '33;">' +
			'<div class="wmm2-card-top" style="background:linear-gradient(90deg,' + mod.color + ',' + mod.color + '44);"></div>' +
			'<div class="wmm2-card-inner">' +
			'<div class="wmm2-row">' +
			'<div class="wmm2-col-main">' +
			'<div class="wmm2-head"><span class="wmm2-icon">' + mod.icon + '</span><div>' +
			'<div class="wmm2-meta-k" style="color:' + mod.color + ';">Modul ' + mod.id + ' · ' + esc(phases[mod.phase].label) + '</div>' +
			'<div class="wmm2-meta-v">' + esc(mod.label) + '</div>' +
			'</div></div>' +
			'<div class="wmm2-toggle">' +
			'<button class="wmm2-toggle-btn" data-action="show-bring" style="' + bringStyle + '">Was es bringt</button>' +
			'<button class="wmm2-toggle-btn" data-action="show-risk" style="' + riskStyle + '">Ohne dieses Modul</button>' +
			'</div>' +
			body +
			'</div>' +
			'<div class="wmm2-col-side">' +
			'<div class="wmm2-stat" style="background:' + mod.color + '0f;border:1px solid ' + mod.color + '2a;">' +
			'<div class="wmm2-stat-k" style="color:' + mod.color + ';">Track Record</div>' +
			'<div class="wmm2-stat-v">' + esc(mod.result) + '</div>' +
			'<div class="wmm2-stat-s">' + esc(mod.resultSub) + '</div>' +
			'</div>' +
			'<div class="wmm2-credits">' +
			'<div class="wmm2-credits-k">Investment</div>' +
			'<div class="wmm2-credits-v">' + esc(mod.credits) + '</div>' +
			'</div>' +
			'</div>' +
			'</div>' +
			'<div class="wmm2-foot">' +
			'<div class="wmm2-nav">' +
			'<button data-action="prev-module">←</button>' +
			'<span>' + mod.id + '/' + modules.length + '</span>' +
			'<button data-action="next-module">→</button>' +
			'</div>' +
			'<a class="wmm2-cta" href="https://hasimuener.de/customer-journey-audit/" target="_blank" rel="noreferrer">Diesen Hebel prüfen →</a>' +
			'</div>' +
			'</div>' +
			'</div>';
	}

	function renderPanel() {
		if (state.active === null) {
			return renderEmptyPanel();
		}
		return renderActivePanel(modules[state.active], state.active);
	}

	function renderSequence() {
		return '' +
			'<div class="wmm2-seq">' +
			modules.map(function (m, i) {
				var active = state.active === i;
				var bg = active ? m.color : '#111';
				var border = active ? m.color : 'rgba(255,255,255,0.1)';
				return '' +
					'<div class="wmm2-seq-item">' +
					'<div class="wmm2-seq-dot" data-seq-index="' + i + '" style="background:' + bg + ';border:1px solid ' + border + ';">' + m.icon + '</div>' +
					(i < modules.length - 1 ? '<div class="wmm2-seq-line"></div>' : '') +
					'</div>';
			}).join('') +
			'</div>' +
			'<div class="wmm2-seq-note">Reihenfolge ist nicht optional — das System baut aufeinander auf</div>';
	}

	function renderLegend() {
		return phases.map(function (p) {
			return '<div class="wmm2-legend-item"><div class="wmm2-legend-dot" style="background:' + p.color + ';"></div><span class="wmm2-legend-label">' + esc(p.label) + '</span></div>';
		}).join('');
	}

	function bindEvents() {
		var nodeGroups = root.querySelectorAll('[data-node-index]');
		Array.prototype.forEach.call(nodeGroups, function (g) {
			var idx = Number(g.getAttribute('data-node-index'));

			g.addEventListener('click', function () {
				state.active = state.active === idx ? null : idx;
				state.showWithout = false;
				render();
			});

			g.addEventListener('mouseenter', function () {
				state.hovered = idx;
				render();
			});

			g.addEventListener('mouseleave', function () {
				state.hovered = null;
				render();
			});
		});

		var bringBtn = root.querySelector('[data-action="show-bring"]');
		if (bringBtn) {
			bringBtn.addEventListener('click', function () {
				state.showWithout = false;
				render();
			});
		}

		var riskBtn = root.querySelector('[data-action="show-risk"]');
		if (riskBtn) {
			riskBtn.addEventListener('click', function () {
				state.showWithout = true;
				render();
			});
		}

		var prevBtn = root.querySelector('[data-action="prev-module"]');
		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				if (state.active === null) {
					return;
				}
				state.active = (state.active - 1 + modules.length) % modules.length;
				state.showWithout = false;
				render();
			});
		}

		var nextBtn = root.querySelector('[data-action="next-module"]');
		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				if (state.active === null) {
					return;
				}
				state.active = (state.active + 1) % modules.length;
				state.showWithout = false;
				render();
			});
		}

		var seqDots = root.querySelectorAll('[data-seq-index]');
		Array.prototype.forEach.call(seqDots, function (dot) {
			dot.addEventListener('click', function () {
				var idx = Number(dot.getAttribute('data-seq-index'));
				state.active = state.active === idx ? null : idx;
				state.showWithout = false;
				render();
			});
		});
	}

	function render() {
		root.innerHTML = '' +
			'<section class="wmm2">' +
			'<div class="wmm2-header">' +
			'<div class="wmm2-pill">WordPress Growth Operating System</div>' +
			'<h2 class="wmm2-title">7 Module. Ein System.<br><span>Alles baut aufeinander auf.</span></h2>' +
			'<p class="wmm2-sub">Klick auf ein Modul · Reihenfolge ist kein Zufall</p>' +
			'</div>' +
			'<div class="wmm2-legend">' + renderLegend() + '</div>' +
			'<div class="wmm2-svg-wrap">' + renderSvg() + '</div>' +
			'<div class="wmm2-panel">' + renderPanel() + '</div>' +
			renderSequence() +
			'</section>';

		bindEvents();
	}

	injectStyles();
	render();
	setTimeout(function () {
		state.mounted = true;
		render();
	}, 100);
})();
