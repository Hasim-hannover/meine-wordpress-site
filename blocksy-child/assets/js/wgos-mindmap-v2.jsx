import { useState, useEffect, useRef } from "react";

const GOLD = "#D4AF37";
const GOLD_DIM = "rgba(212,175,55,0.12)";
const GOLD_BORDER = "rgba(212,175,55,0.3)";

const phases = [
  { label: "Fundament", color: "#60A5FA", range: [0, 1, 2] },
  { label: "Wachstum", color: "#34D399", range: [3, 4, 5] },
  { label: "Skalierung", color: "#FB923C", range: [6] },
];

const modules = [
  {
    id: 1,
    label: "Performance Core",
    icon: "⚡",
    phase: 0,
    color: "#60A5FA",
    claim: "Schnelle Seiten konvertieren besser.",
    without: "Jeder Besucher der länger als 3s wartet springt ab – und zahlt trotzdem Ihren CPL.",
    bullets: ["Core Web Vitals: LCP < 2.5s, CLS < 0.1", "CDN, Critical CSS, Asset-Pipeline", "Server-Tuning & Lazy Loading"],
    result: "98 Mobile Score",
    resultSub: "in 14 Tagen (von 45)",
    credits: "15 Credits",
  },
  {
    id: 2,
    label: "Security & Reliability",
    icon: "🛡",
    phase: 0,
    color: "#818CF8",
    claim: "Vertrauen beginnt bevor der Besucher klickt.",
    without: "Ein Malware-Vorfall oder Ausfall kostet mehr als 12 Monate Wartung zusammen.",
    bullets: ["WordPress-Härtung & Update-Management", "Automatisierte Backups & Uptime-Monitoring", "Malware-Scan & Disaster Recovery"],
    result: "0 Ausfälle",
    resultSub: "in 12 Monaten (betreute Projekte)",
    credits: "10 Credits",
  },
  {
    id: 3,
    label: "Privacy-First Measurement",
    icon: "📡",
    phase: 0,
    color: "#A78BFA",
    claim: "Entscheidungen brauchen verlässliche Daten.",
    without: "Ohne sauberes Tracking optimieren Sie auf Schätzungen – und skalieren das Falsche.",
    bullets: ["Server-Side GTM (sGTM)", "Consent Mode v2 ohne Cookie-Chaos", "GA4 Event Blueprint + DSGVO-Dokumentation"],
    result: ">92% Tracking",
    resultSub: "Genauigkeit (von ~55%)",
    credits: "15 Credits",
  },
  {
    id: 4,
    label: "Technical SEO & IA",
    icon: "🗺",
    phase: 1,
    color: "#34D399",
    claim: "Struktur entscheidet ob Google Sie versteht.",
    without: "Ohne saubere IA rankt Content nicht – egal wie gut er geschrieben ist.",
    bullets: ["Crawl-Optimierung & Schema Markup", "Pillar/Cluster-Planung", "Interne Verlinkung & URL-Architektur"],
    result: "+340% indexiert",
    resultSub: "nach IA-Restrukturierung",
    credits: "10 Credits",
  },
  {
    id: 5,
    label: "Owned Content Engine",
    icon: "✍",
    phase: 1,
    color: "#4ADE80",
    claim: "Content mit Ablaufdatum ist kein Asset.",
    without: "Ohne Owned Content bezahlen Sie jeden Monat für Sichtbarkeit, die Ihnen nie gehört.",
    bullets: ["Pillar Pages & Content-Cluster", "Case Studies & Proof-Assets", "Lead-Magneten & Nurture-Sequenzen"],
    result: "+180% Traffic",
    resultSub: "organisch in 6 Monaten",
    credits: "25 Credits/Pillar",
  },
  {
    id: 6,
    label: "Conversion Engineering",
    icon: "🎯",
    phase: 1,
    color: "#FBBF24",
    claim: "Traffic ohne Conversion ist Vanity.",
    without: "Selbst perfekte Rankings bringen keine Leads wenn die Page nicht konvertiert.",
    bullets: ["Landing Page Architektur & CTA-Hierarchie", "A/B-Testing & Friction-Analyse", "Offer-Framing & Lead-Formular-Engineering"],
    result: "1.2% → 4.7%",
    resultSub: "Conversion Rate (B2B)",
    credits: "20 Credits/LP",
  },
  {
    id: 7,
    label: "Paid Booster",
    icon: "🚀",
    phase: 2,
    color: "#FB923C",
    claim: "Ads als Verstärker – nicht als Betriebssystem.",
    without: "Ads ohne Fundament verbrennen Budget. Erst Modul 1–6, dann dieser Turbo.",
    bullets: ["Google & Meta Ads auf konvertierenden Pages", "n8n-Automation für Lead-Routing", "Aktivierung erst wenn Fundament steht"],
    result: "ROAS 6.2x",
    resultSub: "bei 40% weniger Ad-Spend",
    credits: "15 Credits Setup",
  },
];

function getPos(index, total, cx, cy, r) {
  const angle = (index / total) * 2 * Math.PI - Math.PI / 2 + 0.15;
  return { x: cx + r * Math.cos(angle), y: cy + r * Math.sin(angle) };
}

const AnimatedCircle = ({ cx, cy, r, color, delay = 0 }) => {
  const [opacity, setOpacity] = useState(0.15);
  useEffect(() => {
    let t = delay;
    const interval = setInterval(() => {
      t += 0.05;
      setOpacity(0.08 + Math.sin(t) * 0.07);
    }, 50);
    return () => clearInterval(interval);
  }, [delay]);
  return <circle cx={cx} cy={cy} r={r} fill="none" stroke={color} strokeWidth={0.8} opacity={opacity} />;
};

export default function WGOSMindmap() {
  const [active, setActive] = useState(null);
  const [hovered, setHovered] = useState(null);
  const [mounted, setMounted] = useState(false);
  const [showWithout, setShowWithout] = useState(false);

  useEffect(() => {
    const t = setTimeout(() => setMounted(true), 100);
    return () => clearTimeout(t);
  }, []);

  useEffect(() => {
    setShowWithout(false);
  }, [active]);

  const cx = 390, cy = 310, r = 205;
  const positions = modules.map((_, i) => getPos(i, modules.length, cx, cy, r));
  const activeModule = active !== null ? modules[active] : null;

  return (
    <div style={{
      background: "#070709",
      minHeight: "100vh",
      fontFamily: "'DM Sans', 'Helvetica Neue', sans-serif",
      color: "#fff",
      display: "flex",
      flexDirection: "column",
      alignItems: "center",
      padding: "36px 16px 48px",
    }}>
      <div style={{ textAlign: "center", marginBottom: 4 }}>
        <div style={{
          display: "inline-block",
          border: `1px solid ${GOLD_BORDER}`,
          borderRadius: 100,
          padding: "4px 16px",
          fontSize: 10,
          letterSpacing: "0.2em",
          color: GOLD,
          textTransform: "uppercase",
          marginBottom: 14,
          fontWeight: 500,
        }}>
          WordPress Growth Operating System
        </div>
        <h2 style={{
          fontSize: "clamp(20px, 3vw, 28px)",
          fontWeight: 800,
          margin: "0 0 8px",
          letterSpacing: "-0.03em",
          lineHeight: 1.2,
        }}>
          7 Module. Ein System.<br />
          <span style={{ color: GOLD }}>Alles baut aufeinander auf.</span>
        </h2>
        <p style={{ color: "#555", fontSize: 13, margin: 0 }}>
          Klick auf ein Modul · Reihenfolge ist kein Zufall
        </p>
      </div>

      <div style={{ display: "flex", gap: 20, marginBottom: 16, marginTop: 16 }}>
        {phases.map(p => (
          <div key={p.label} style={{ display: "flex", alignItems: "center", gap: 6 }}>
            <div style={{ width: 8, height: 8, borderRadius: "50%", background: p.color }} />
            <span style={{ fontSize: 11, color: "#666", letterSpacing: "0.05em" }}>{p.label}</span>
          </div>
        ))}
      </div>

      <div style={{ width: "100%", maxWidth: 780, position: "relative" }}>
        <svg viewBox="0 0 780 620" width="100%" style={{ display: "block", overflow: "visible" }}>
          <defs>
            <radialGradient id="centerBg" cx="50%" cy="50%" r="50%">
              <stop offset="0%" stopColor="rgba(212,175,55,0.18)" />
              <stop offset="70%" stopColor="rgba(212,175,55,0.04)" />
              <stop offset="100%" stopColor="transparent" />
            </radialGradient>
            <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
              <feGaussianBlur stdDeviation="4" result="blur" />
              <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
            </filter>
            <filter id="softglow" x="-30%" y="-30%" width="160%" height="160%">
              <feGaussianBlur stdDeviation="2" result="blur" />
              <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
            </filter>
          </defs>

          <AnimatedCircle cx={cx} cy={cy} r={r - 10} color={GOLD} delay={0} />
          <AnimatedCircle cx={cx} cy={cy} r={r + 30} color={GOLD} delay={1} />
          <AnimatedCircle cx={cx} cy={cy} r={r + 55} color="rgba(255,255,255,0.3)" delay={2} />

          {positions.map((pos, i) => {
            const mod = modules[i];
            const isActive = active === i;
            const isHov = hovered === i;
            return (
              <line key={`l${i}`}
                x1={cx} y1={cy} x2={pos.x} y2={pos.y}
                stroke={isActive ? mod.color : isHov ? GOLD : "rgba(255,255,255,0.06)"}
                strokeWidth={isActive ? 1.5 : 0.8}
                strokeDasharray={isActive ? "none" : "3 5"}
                style={{ transition: "stroke 0.3s, stroke-width 0.3s" }}
              />
            );
          })}

          <circle cx={cx} cy={cy} r={100} fill="url(#centerBg)" />
          <circle cx={cx} cy={cy} r={72} fill="#0c0c0e" stroke={GOLD} strokeWidth={1.5} filter="url(#glow)" />
          <circle cx={cx} cy={cy} r={66} fill="none" stroke={GOLD_BORDER} strokeWidth={0.5} />
          <text x={cx} y={cy - 22} textAnchor="middle" fill={GOLD} fontSize={13} fontWeight={800} letterSpacing="0.15em">WGOS</text>
          <text x={cx} y={cy - 4} textAnchor="middle" fill="#777" fontSize={8.5} letterSpacing="0.06em">OWNED LEADS</text>
          <text x={cx} y={cy + 10} textAnchor="middle" fill="#555" fontSize={8} letterSpacing="0.06em">MIT WORDPRESS</text>
          <text x={cx} y={cy + 28} textAnchor="middle" fill="#333" fontSize={7.5} letterSpacing="0.08em">1 → 2 → 3 → ... → 7</text>

          {positions.map((pos, i) => {
            const mod = modules[i];
            const isActive = active === i;
            const isHov = hovered === i;
            const phaseColor = phases[mod.phase].color;
            const visible = mounted;
            return (
              <g key={`n${i}`}
                onClick={() => setActive(active === i ? null : i)}
                onMouseEnter={() => setHovered(i)}
                onMouseLeave={() => setHovered(null)}
                style={{
                  cursor: "pointer",
                  opacity: visible ? 1 : 0,
                  transform: visible ? "scale(1)" : "scale(0.5)",
                  transition: `opacity 0.5s ${i * 0.07}s, transform 0.5s ${i * 0.07}s`,
                  transformOrigin: `${pos.x}px ${pos.y}px`,
                }}
              >
                {isActive && (
                  <circle cx={pos.x} cy={pos.y} r={52} fill="none" stroke={mod.color} strokeWidth={1} opacity={0.25} />
                )}
                <circle cx={pos.x} cy={pos.y} r={44}
                  fill={isActive ? `${mod.color}18` : "#0f0f12"}
                  stroke={isActive ? mod.color : isHov ? phaseColor : "rgba(255,255,255,0.1)"}
                  strokeWidth={isActive ? 1.8 : 1}
                  filter={isActive ? "url(#softglow)" : "none"}
                  style={{ transition: "all 0.25s" }}
                />
                <path
                  d={`M ${pos.x - 28} ${pos.y - 38} A 44 44 0 0 1 ${pos.x + 28} ${pos.y - 38}`}
                  fill="none" stroke={phaseColor} strokeWidth={2.5} strokeLinecap="round"
                  opacity={isActive ? 1 : 0.4}
                  style={{ transition: "opacity 0.25s" }}
                />
                <text x={pos.x} y={pos.y - 20} textAnchor="middle"
                  fill={isActive ? mod.color : "#444"} fontSize={8.5} fontWeight={700} letterSpacing="0.08em"
                  style={{ transition: "fill 0.25s" }}>
                  {`0${i + 1}`}
                </text>
                <text x={pos.x} y={pos.y + 2} textAnchor="middle" fontSize={17} dominantBaseline="middle">
                  {mod.icon}
                </text>
                <text x={pos.x} y={pos.y + 22} textAnchor="middle"
                  fill={isActive ? "#fff" : "#999"} fontSize={8.5} fontWeight={isActive ? 600 : 400}
                  style={{ transition: "fill 0.25s" }}>
                  {mod.label.split(" ").slice(0, 2).join(" ")}
                </text>
              </g>
            );
          })}
        </svg>
      </div>

      <div style={{ width: "100%", maxWidth: 700, marginTop: 4, minHeight: 220 }}>
        {activeModule ? (
          <div style={{
            background: "#0d0d10",
            border: `1px solid ${activeModule.color}33`,
            borderRadius: 14,
            overflow: "hidden",
            animation: "fadeUp 0.3s ease",
          }}>
            <style>{`
              @keyframes fadeUp {
                from { opacity: 0; transform: translateY(8px); }
                to { opacity: 1; transform: translateY(0); }
              }
            `}</style>
            <div style={{ height: 3, background: `linear-gradient(90deg, ${activeModule.color}, ${activeModule.color}44)` }} />
            <div style={{ padding: "20px 24px" }}>
              <div style={{ display: "flex", alignItems: "flex-start", justifyContent: "space-between", gap: 16, flexWrap: "wrap" }}>
                <div style={{ flex: 1, minWidth: 220 }}>
                  <div style={{ display: "flex", alignItems: "center", gap: 10, marginBottom: 10 }}>
                    <span style={{ fontSize: 22 }}>{activeModule.icon}</span>
                    <div>
                      <div style={{ fontSize: 9, color: activeModule.color, letterSpacing: "0.14em", textTransform: "uppercase", fontWeight: 700 }}>
                        Modul {activeModule.id} · {phases[activeModule.phase].label}
                      </div>
                      <div style={{ fontSize: 16, fontWeight: 700, color: "#fff", marginTop: 2 }}>
                        {activeModule.label}
                      </div>
                    </div>
                  </div>
                  <div style={{ display: "flex", gap: 6, marginBottom: 12 }}>
                    <button onClick={() => setShowWithout(false)} style={{
                      fontSize: 10, padding: "4px 10px", borderRadius: 4, border: "none", cursor: "pointer",
                      background: !showWithout ? activeModule.color : "#1a1a1e",
                      color: !showWithout ? "#000" : "#666",
                      fontWeight: !showWithout ? 700 : 400,
                      transition: "all 0.2s",
                    }}>Was es bringt</button>
                    <button onClick={() => setShowWithout(true)} style={{
                      fontSize: 10, padding: "4px 10px", borderRadius: 4, border: "none", cursor: "pointer",
                      background: showWithout ? "#ef4444" : "#1a1a1e",
                      color: showWithout ? "#fff" : "#666",
                      fontWeight: showWithout ? 700 : 400,
                      transition: "all 0.2s",
                    }}>Ohne dieses Modul</button>
                  </div>
                  {!showWithout ? (
                    <>
                      <p style={{ color: "#aaa", fontSize: 13, margin: "0 0 12px", fontStyle: "italic", lineHeight: 1.55 }}>
                        "{activeModule.claim}"
                      </p>
                      <ul style={{ margin: 0, padding: "0 0 0 14px" }}>
                        {activeModule.bullets.map((b, i) => (
                          <li key={i} style={{ color: "#777", fontSize: 12.5, lineHeight: 1.8, paddingLeft: 4 }}>{b}</li>
                        ))}
                      </ul>
                    </>
                  ) : (
                    <div style={{
                      background: "rgba(239,68,68,0.08)",
                      border: "1px solid rgba(239,68,68,0.2)",
                      borderRadius: 8,
                      padding: "12px 14px",
                    }}>
                      <div style={{ fontSize: 10, color: "#ef4444", letterSpacing: "0.1em", textTransform: "uppercase", fontWeight: 700, marginBottom: 6 }}>
                        ⚠ Risiko
                      </div>
                      <p style={{ color: "#cc8888", fontSize: 13, margin: 0, lineHeight: 1.6 }}>
                        {activeModule.without}
                      </p>
                    </div>
                  )}
                </div>
                <div style={{ display: "flex", flexDirection: "column", gap: 10, minWidth: 150 }}>
                  <div style={{
                    background: `${activeModule.color}0f`,
                    border: `1px solid ${activeModule.color}2a`,
                    borderRadius: 10,
                    padding: "14px 16px",
                    textAlign: "center",
                  }}>
                    <div style={{ fontSize: 9, color: activeModule.color, letterSpacing: "0.12em", textTransform: "uppercase", fontWeight: 700, marginBottom: 6 }}>Track Record</div>
                    <div style={{ fontSize: 20, fontWeight: 800, color: "#fff", lineHeight: 1.1 }}>{activeModule.result}</div>
                    <div style={{ fontSize: 10, color: "#555", marginTop: 4 }}>{activeModule.resultSub}</div>
                  </div>
                  <div style={{
                    background: "#111115",
                    border: "1px solid rgba(255,255,255,0.07)",
                    borderRadius: 10,
                    padding: "10px 14px",
                    textAlign: "center",
                  }}>
                    <div style={{ fontSize: 9, color: "#555", letterSpacing: "0.1em", textTransform: "uppercase", marginBottom: 4 }}>Investment</div>
                    <div style={{ fontSize: 13, color: "#D4AF37", fontWeight: 700 }}>{activeModule.credits}</div>
                  </div>
                </div>
              </div>
              <div style={{
                display: "flex", justifyContent: "space-between", alignItems: "center",
                marginTop: 16, paddingTop: 14,
                borderTop: "1px solid rgba(255,255,255,0.05)",
                flexWrap: "wrap", gap: 10,
              }}>
                <div style={{ display: "flex", gap: 8 }}>
                  <button onClick={() => setActive((active - 1 + modules.length) % modules.length)}
                    style={{ background: "none", border: "1px solid rgba(255,255,255,0.1)", color: "#666", padding: "5px 12px", borderRadius: 5, cursor: "pointer", fontSize: 11 }}>←</button>
                  <span style={{ color: "#333", fontSize: 11, alignSelf: "center" }}>{activeModule.id}/{modules.length}</span>
                  <button onClick={() => setActive((active + 1) % modules.length)}
                    style={{ background: "none", border: "1px solid rgba(255,255,255,0.1)", color: "#666", padding: "5px 12px", borderRadius: 5, cursor: "pointer", fontSize: 11 }}>→</button>
                </div>
                <a href="https://hasimuener.de/customer-journey-audit/"
                  target="_blank" rel="noreferrer"
                  style={{
                    background: "#D4AF37", color: "#000", padding: "8px 18px",
                    borderRadius: 6, fontSize: 11, fontWeight: 700,
                    textDecoration: "none", letterSpacing: "0.04em", display: "inline-block",
                  }}>
                  Diesen Hebel prüfen →
                </a>
              </div>
            </div>
          </div>
        ) : (
          <div style={{ textAlign: "center", padding: "40px 0" }}>
            <div style={{ color: "#222", fontSize: 13 }}>Wähle ein Modul aus der Map</div>
            <div style={{ display: "flex", justifyContent: "center", gap: 24, marginTop: 20, flexWrap: "wrap" }}>
              {phases.map(p => (
                <div key={p.label} style={{ textAlign: "center" }}>
                  <div style={{ fontSize: 10, color: p.color, letterSpacing: "0.1em", textTransform: "uppercase", fontWeight: 700, marginBottom: 4 }}>{p.label}</div>
                  <div style={{ fontSize: 11, color: "#444" }}>
                    {p.label === "Fundament" ? "Module 01–03" : p.label === "Wachstum" ? "Module 04–06" : "Modul 07"}
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>

      <div style={{
        marginTop: 28, display: "flex", alignItems: "center", gap: 0,
        overflowX: "auto", maxWidth: 680, width: "100%",
        justifyContent: "center", flexWrap: "wrap", rowGap: 8,
      }}>
        {modules.map((m, i) => (
          <div key={i} style={{ display: "flex", alignItems: "center" }}>
            <div onClick={() => setActive(active === i ? null : i)}
              style={{
                width: 30, height: 30, borderRadius: "50%",
                background: active === i ? m.color : "#111",
                border: `1px solid ${active === i ? m.color : "rgba(255,255,255,0.1)"}`,
                display: "flex", alignItems: "center", justifyContent: "center",
                fontSize: 13, cursor: "pointer", transition: "all 0.2s",
              }}>
              {m.icon}
            </div>
            {i < modules.length - 1 && (
              <div style={{ width: 16, height: 1, background: "rgba(255,255,255,0.08)", margin: "0 2px" }} />
            )}
          </div>
        ))}
      </div>
      <div style={{ color: "#2a2a2a", fontSize: 10, marginTop: 8, letterSpacing: "0.06em" }}>
        Reihenfolge ist nicht optional — das System baut aufeinander auf
      </div>
    </div>
  );
}
