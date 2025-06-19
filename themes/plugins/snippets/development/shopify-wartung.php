// ===================================================================
// WARTUNGSSEITE CHAMPIONS LEAGUE EDITION - ACF PRO 3.0
// Features: A11y-optimiert, Performance-boost, Mobile-first, SEO-ready
// ===================================================================

// Security Check
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue Styles wenn nötig (optional)
// wp_enqueue_style('wartungsseite-champions', get_template_directory_uri() . '/css/wartungsseite.css');
?>
<style>
/* === PERFORMANCE & ACCESSIBILITY OPTIMIERTE STYLES === */
/* Lokale Open Sans Schriftart wird verwendet */

/* CSS Custom Properties für bessere Performance */
:root {
  /* Design System - Farben */
  --primary-900: #0a0a0a;
  --primary-800: #18181b;
  --primary-700: #27272a;
  --primary-600: #3f3f46;
  --primary-500: #52525b;
  --primary-400: #71717a;
  --primary-300: #a1a1aa;
  --primary-200: #d4d4d8;
  --primary-100: #f4f4f5;
  --primary-50: #fafafa;
  
  /* Accent Colors */
  --accent-600: #7ba938;
  --accent-500: #96bf48;
  --accent-400: #a6d055;
  --accent-300: #b8dc6f;
  --accent-200: #cae889;
  --accent-100: #dcf4a3;
  
  /* Semantic Colors */
  --success: #22c55e;
  --warning: #f59e0b;
  --error: #ef4444;
  --info: #3b82f6;
  
  /* Gradients */
  --gradient-primary: linear-gradient(135deg, var(--primary-800) 0%, var(--primary-700) 100%);
  --gradient-accent: linear-gradient(135deg, var(--accent-500) 0%, var(--accent-600) 100%);
  --gradient-glass: linear-gradient(135deg, rgba(39, 39, 42, 0.4) 0%, rgba(63, 63, 70, 0.2) 100%);
  
  /* Glass Morphism */
  --glass-bg: rgba(39, 39, 42, 0.25);
  --glass-border: rgba(82, 82, 91, 0.15);
  --glass-blur: blur(12px);
  
  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  --shadow-glow: 0 0 40px rgba(150, 191, 72, 0.2);
  --shadow-focus: 0 0 0 3px rgba(150, 191, 72, 0.5);
  
  /* Spacing System */
  --space-xs: 0.25rem;
  --space-sm: 0.5rem;
  --space-md: 1rem;
  --space-lg: 1.5rem;
  --space-xl: 2rem;
  --space-2xl: 2.5rem;
  --space-3xl: 3rem;
  --space-4xl: 4rem;
  --space-5xl: 5rem;
  
  /* Border Radius */
  --radius-sm: 6px;
  --radius-md: 8px;
  --radius-lg: 12px;
  --radius-xl: 16px;
  --radius-2xl: 20px;
  --radius-full: 9999px;
  
  /* Typography */
  --font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  --font-weight-light: 300;
  --font-weight-normal: 400;
  --font-weight-medium: 500;
  --font-weight-semibold: 600;
  --font-weight-bold: 700;
  --font-weight-extrabold: 800;
  
  /* Line Heights */
  --leading-tight: 1.25;
  --leading-normal: 1.5;
  --leading-relaxed: 1.625;
  
  /* Transitions */
  --transition-fast: 150ms ease-out;
  --transition-normal: 250ms ease-out;
  --transition-slow: 350ms ease-out;
  
  /* Container */
  --container-sm: 640px;
  --container-md: 768px;
  --container-lg: 1024px;
  --container-xl: 1280px;
  --container-2xl: 1536px;
}

/* === RESET & BASE STYLES === */
*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html {
  scroll-behavior: smooth;
  scroll-padding-top: 80px;
}

body {
  font-family: var(--font-family);
  line-height: var(--leading-normal);
  color: var(--primary-50);
  background-color: var(--primary-900);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* === SKIP LINK FÜR ACCESSIBILITY === */
.skip-link {
  position: absolute;
  top: -40px;
  left: 6px;
  background: var(--accent-500);
  color: var(--primary-900);
  padding: 8px;
  text-decoration: none;
  border-radius: var(--radius-sm);
  font-weight: var(--font-weight-semibold);
  z-index: 9999;
  transition: top var(--transition-fast);
}

.skip-link:focus {
  top: 6px;
}

/* === THEME OVERRIDE FÜR BLOCKY THEME === */
.wartungsseite-champions {
  position: relative !important;
  overflow-x: hidden;
  /* Blocky Theme Overrides */
  isolation: isolate;
}

.wartungsseite-champions .toc-nav {
  /* Zusätzliche Overrides für Theme-Kompatibilität */
  margin: 0 !important;
  padding-left: 0 !important;
  padding-right: 0 !important;
  box-sizing: border-box !important;
}

/* Stellt sicher dass parent containers kein overflow:hidden haben */
.wartungsseite-champions,
.wartungsseite-champions * {
  position: relative;
}

.wartungsseite-champions .toc-nav {
  position: -webkit-sticky !important;
  position: sticky !important;
}

/* === ANIMATED BACKGROUND === */
.wartungsseite-champions::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    radial-gradient(circle at 25% 25%, rgba(150, 191, 72, 0.08) 0%, transparent 50%),
    radial-gradient(circle at 75% 75%, rgba(123, 169, 56, 0.06) 0%, transparent 50%),
    radial-gradient(circle at 50% 50%, rgba(150, 191, 72, 0.04) 0%, transparent 70%);
  animation: backgroundFloat 30s ease-in-out infinite;
  z-index: -1;
  will-change: transform;
}

@keyframes backgroundFloat {
  0%, 100% { 
    transform: translate3d(0, 0, 0) rotate(0deg) scale(1); 
  }
  25% { 
    transform: translate3d(-10px, -15px, 0) rotate(0.5deg) scale(1.02); 
  }
  50% { 
    transform: translate3d(15px, -10px, 0) rotate(-0.3deg) scale(0.98); 
  }
  75% { 
    transform: translate3d(-5px, 12px, 0) rotate(0.2deg) scale(1.01); 
  }
}

/* === UTILITY CLASSES === */
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

.container {
  width: 100%;
  max-width: var(--container-xl);
  margin: 0 auto;
  padding: 0 var(--space-md);
}

@media (min-width: 640px) {
  .container {
    padding: 0 var(--space-lg);
  }
}

@media (min-width: 1024px) {
  .container {
    padding: 0 var(--space-xl);
  }
}

/* === SECTION STYLES === */
.section {
  padding: var(--space-4xl) 0;
}

@media (min-width: 768px) {
  .section {
    padding: var(--space-5xl) 0;
  }
}

.section-title {
  font-size: clamp(1.875rem, 4vw, 3rem);
  font-weight: var(--font-weight-bold);
  line-height: var(--leading-tight);
  text-align: center;
  margin-bottom: var(--space-3xl);
  color: var(--primary-50);
  letter-spacing: -0.025em;
}

.section-subtitle {
  font-size: clamp(1rem, 2vw, 1.25rem);
  color: var(--primary-200);
  text-align: center;
  max-width: 600px;
  margin: 0 auto var(--space-3xl);
  line-height: var(--leading-relaxed);
}

/* === HERO SECTION === */
.hero-section {
  min-height: 100vh;
  display: flex;
  align-items: center;
  position: relative;
  padding: var(--space-3xl) 0;
}

.hero-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-3xl);
  align-items: center;
  text-align: center;
}

@media (min-width: 768px) {
  .hero-grid {
    grid-template-columns: 1fr 1fr;
    gap: var(--space-4xl);
    text-align: left;
  }
}

.hero-badge {
  display: inline-block;
  background: var(--gradient-accent);
  color: var(--primary-900);
  font-size: 0.875rem;
  font-weight: var(--font-weight-semibold);
  padding: var(--space-sm) var(--space-lg);
  border-radius: var(--radius-full);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: var(--space-lg);
  box-shadow: var(--shadow-glow);
}

.hero-title {
  font-size: clamp(2.5rem, 6vw, 4rem);
  font-weight: var(--font-weight-extrabold);
  line-height: var(--leading-tight);
  margin-bottom: var(--space-lg);
  letter-spacing: -0.02em;
  background: linear-gradient(135deg, var(--primary-50) 0%, var(--accent-400) 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-lead {
  font-size: clamp(1.125rem, 2vw, 1.25rem);
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
  margin-bottom: var(--space-xl);
  max-width: 500px;
}

.hero-cta {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--gradient-accent);
  color: var(--primary-900);
  text-decoration: none;
  font-weight: var(--font-weight-semibold);
  padding: var(--space-lg) var(--space-2xl);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  transition: all var(--transition-normal);
  transform: translateY(0);
}

.hero-cta:hover,
.hero-cta:focus-visible {
  transform: translateY(-2px);
  box-shadow: var(--shadow-xl), var(--shadow-glow);
}

.hero-cta:focus-visible {
  outline: none;
  box-shadow: var(--shadow-focus);
}

.hero-image {
  position: relative;
}

.hero-image img {
  width: 100%;
  height: auto;
  max-width: 500px;
  border-radius: var(--radius-2xl);
  box-shadow: var(--shadow-xl);
  transition: transform var(--transition-slow);
}

.hero-image:hover img {
  transform: scale(1.02);
}

/* === TABLE OF CONTENTS VERZEICHNIS === */
.toc-nav {
  position: -webkit-sticky !important;
  position: sticky !important;
  top: 0 !important;
  z-index: 1000 !important;
  background: rgba(10, 10, 10, 0.95) !important;
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border-bottom: 1px solid var(--glass-border);
  padding: var(--space-lg) 0;
  box-shadow: var(--shadow-md);
  width: 100% !important;
  left: 0 !important;
  right: 0 !important;
}

.toc-nav::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  z-index: -1;
}

.toc-header {
  text-align: center;
  margin-bottom: var(--space-md);
}

.toc-title {
  font-size: 1rem;
  font-weight: var(--font-weight-semibold);
  color: var(--accent-400);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: var(--space-sm);
}

.toc-subtitle {
  font-size: 0.875rem;
  color: var(--primary-300);
  font-style: italic;
}

.toc-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: var(--space-md);
  list-style: none;
  margin: 0;
  padding: 0;
}

.toc-link {
  color: var(--primary-300);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  font-size: 0.875rem;
  padding: var(--space-sm) var(--space-md);
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
  position: relative;
}

.toc-link:hover,
.toc-link:focus-visible {
  color: var(--accent-400);
  background: rgba(150, 191, 72, 0.1);
}

.toc-link:focus-visible {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
}

/* === CARD COMPONENTS === */
.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: var(--space-xl);
}

.card {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-xl);
  padding: var(--space-xl);
  transition: all var(--transition-normal);
  position: relative;
  overflow: hidden;
}

.card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: var(--gradient-accent);
  transform: scaleX(0);
  transition: transform var(--transition-normal);
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-xl);
  border-color: var(--accent-500);
}

.card:hover::before {
  transform: scaleX(1);
}

.card-horizontal {
  display: flex;
  gap: var(--space-lg);
  align-items: flex-start;
}

.card-icon {
  font-size: 2rem;
  flex-shrink: 0;
  color: var(--accent-500);
  display: flex;
  align-items: center;
  justify-content: center;
  width: 3rem;
  height: 3rem;
  background: rgba(150, 191, 72, 0.1);
  border-radius: var(--radius-lg);
}

.card-title {
  font-size: 1.25rem;
  font-weight: var(--font-weight-semibold);
  color: var(--primary-50);
  margin-bottom: var(--space-sm);
  line-height: var(--leading-tight);
  font-family: var(--font-family);
}

.card-description {
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
  font-size: 0.9375rem;
}

/* === WARUM SECTION SPECIAL STYLES === */
.warum-card {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-xl);
  padding: var(--space-xl);
  transition: all var(--transition-normal);
  height: 100%;
}

.warum-header {
  display: flex;
  align-items: center;
  gap: var(--space-md);
  margin-bottom: var(--space-lg);
}

.warum-icon {
  font-size: 1.5rem;
  color: var(--accent-500);
}

.warum-title {
  font-size: 1.125rem;
  font-weight: var(--font-weight-semibold);
  color: var(--primary-50);
  font-family: var(--font-family);
}

.warum-divider {
  height: 1px;
  background: linear-gradient(90deg, var(--accent-500), transparent);
  margin-bottom: var(--space-md);
}

.warum-description {
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
}

/* === ABLAUF SECTION === */
.ablauf-container {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
}

.ablauf-step {
  display: flex;
  gap: var(--space-xl);
  margin-bottom: var(--space-3xl);
  position: relative;
  opacity: 0;
  transform: translateY(20px);
  transition: all var(--transition-slow);
}

.ablauf-step.animate-in {
  opacity: 1;
  transform: translateY(0);
}

.ablauf-line {
  position: relative;
  width: 4px;
  background: var(--primary-600);
  border-radius: var(--radius-full);
  overflow: hidden;
  flex-shrink: 0;
}

.ablauf-line::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--gradient-accent);
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.8s ease-out;
}

.ablauf-step.filled .ablauf-line::after {
  transform: scaleY(1);
}

.ablauf-number {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 2rem;
  height: 2rem;
  background: var(--gradient-accent);
  color: var(--primary-900);
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: var(--font-weight-bold);
  font-size: 0.875rem;
  box-shadow: var(--shadow-md);
  z-index: 1;
}

.ablauf-content {
  flex: 1;
  padding-top: var(--space-xs);
}

.ablauf-title {
  font-size: 1.25rem;
  font-weight: var(--font-weight-semibold);
  color: var(--primary-50);
  margin-bottom: var(--space-sm);
  line-height: var(--leading-tight);
  font-family: var(--font-family);
}

.ablauf-description {
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
  margin-bottom: var(--space-sm);
}

.ablauf-highlight {
  color: var(--accent-400);
  font-style: italic;
  font-size: 0.875rem;
  font-weight: var(--font-weight-medium);
  display: block;
  margin-top: var(--space-sm);
}

/* === PREISE SECTION === */
.preise-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: var(--space-xl);
  align-items: stretch;
}

.preis-card {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-2xl);
  padding: var(--space-2xl);
  text-align: center;
  position: relative;
  transition: all var(--transition-normal);
  height: 100%;
  display: flex;
  flex-direction: column;
}

.preis-card.featured {
  border-color: var(--accent-500);
  transform: scale(1.05);
  box-shadow: var(--shadow-glow);
}

.preis-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-xl);
}

.preis-card.featured:hover {
  transform: scale(1.05) translateY(-4px);
}

.preis-badge {
  position: absolute;
  top: -12px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--gradient-accent);
  color: var(--primary-900);
  font-size: 0.75rem;
  font-weight: var(--font-weight-semibold);
  padding: var(--space-sm) var(--space-lg);
  border-radius: var(--radius-full);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  box-shadow: var(--shadow-md);
}

.preis-header {
  margin-bottom: var(--space-lg);
  min-height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.preis-name {
  font-size: 1.25rem;
  font-weight: var(--font-weight-semibold);
  color: var(--primary-50);
  font-family: var(--font-family);
}

.preis-amount {
  font-size: 2.5rem;
  font-weight: var(--font-weight-bold);
  color: var(--accent-500);
  margin: var(--space-lg) 0;
  line-height: 1;
}

.preis-suffix {
  font-size: 1rem;
  font-weight: var(--font-weight-normal);
  color: var(--primary-300);
  margin-left: var(--space-sm);
}

.preis-features {
  list-style: none;
  padding: 0;
  margin: var(--space-xl) 0;
  text-align: left;
  flex: 1;
}

.preis-features li {
  padding: var(--space-sm) 0;
  padding-left: var(--space-xl);
  position: relative;
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
  border-bottom: 1px solid rgba(82, 82, 91, 0.1);
}

.preis-features li:last-child {
  border-bottom: none;
}

.preis-features li::before {
  content: '✓';
  position: absolute;
  left: 0;
  top: var(--space-sm);
  color: var(--accent-500);
  font-weight: var(--font-weight-bold);
  font-size: 1.125rem;
}

.preis-button {
  display: block;
  width: 100%;
  padding: var(--space-lg);
  background: var(--gradient-primary);
  color: var(--primary-50);
  text-decoration: none;
  font-weight: var(--font-weight-semibold);
  border-radius: var(--radius-lg);
  border: 1px solid var(--primary-600);
  transition: all var(--transition-normal);
  margin-top: auto;
}

.preis-card.featured .preis-button {
  background: var(--gradient-accent);
  color: var(--primary-900);
  border-color: var(--accent-600);
}

.preis-button:hover,
.preis-button:focus-visible {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}

.preis-button:focus-visible {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
}

/* === FAQ SECTION === */
.faq-container {
  max-width: 800px;
  margin: 0 auto;
}

.faq-item {
  border-bottom: 1px solid var(--glass-border);
  margin-bottom: var(--space-md);
}

.faq-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
}

.faq-button {
  width: 100%;
  text-align: left;
  background: none;
  border: none;
  padding: var(--space-xl) 0;
  font-family: inherit;
  font-size: 1.125rem;
  font-weight: var(--font-weight-semibold);
  color: var(--primary-50);
  cursor: pointer;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-md);
  transition: color var(--transition-fast);
}

.faq-button:hover,
.faq-button:focus-visible {
  color: var(--accent-400);
}

.faq-button:focus-visible {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
  border-radius: var(--radius-sm);
}

.faq-icon {
  font-size: 1.5rem;
  transition: transform var(--transition-normal);
  color: var(--accent-500);
  flex-shrink: 0;
}

.faq-item.open .faq-icon {
  transform: rotate(45deg);
}

.faq-answer {
  overflow: hidden;
  transition: all var(--transition-normal);
  max-height: 0;
  opacity: 0;
}

.faq-item.open .faq-answer {
  max-height: 300px;
  opacity: 1;
  padding-bottom: var(--space-xl);
}

.faq-answer-content {
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
  padding-right: var(--space-3xl);
}

/* === CTA SECTION === */
.cta-section {
  background: var(--gradient-primary);
  border-radius: var(--radius-2xl);
  padding: var(--space-4xl) var(--space-xl);
  text-align: center;
  position: relative;
  overflow: hidden;
}

.cta-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    radial-gradient(circle at 30% 30%, rgba(150, 191, 72, 0.1) 0%, transparent 50%),
    radial-gradient(circle at 70% 70%, rgba(123, 169, 56, 0.08) 0%, transparent 50%);
  z-index: 0;
}

.cta-content {
  position: relative;
  z-index: 1;
  max-width: 600px;
  margin: 0 auto;
}

.cta-title {
  font-size: clamp(1.875rem, 4vw, 2.5rem);
  font-weight: var(--font-weight-bold);
  color: var(--primary-50);
  margin-bottom: var(--space-lg);
  line-height: var(--leading-tight);
}

.cta-text {
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
  margin-bottom: var(--space-xl);
  font-size: 1.125rem;
}

.cta-button {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--gradient-accent);
  color: var(--primary-900);
  text-decoration: none;
  font-weight: var(--font-weight-semibold);
  padding: var(--space-lg) var(--space-2xl);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  transition: all var(--transition-normal);
  font-size: 1.125rem;
}

.cta-button:hover,
.cta-button:focus-visible {
  transform: translateY(-2px);
  box-shadow: var(--shadow-xl), var(--shadow-glow);
}

.cta-button:focus-visible {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
}

.cta-trust {
  font-size: 0.875rem;
  color: var(--primary-300);
  margin-top: var(--space-lg);
  font-style: italic;
}

/* === NORMALISIERUNG FÜR H3/H4 ÜBERSCHRIFTEN === */
h3, h4 {
  font-family: var(--font-family) !important;
  font-style: normal !important;
  text-transform: none !important;
  letter-spacing: normal !important;
  text-shadow: none !important;
  -webkit-text-stroke: unset !important;
  text-stroke: unset !important;
  filter: none !important;
}

/* === RESPONSIVE IMPROVEMENTS === */
@media (max-width: 767px) {
  .card-horizontal {
    flex-direction: column;
    text-align: center;
  }
  
  .ablauf-step {
    gap: var(--space-lg);
  }
  
  .ablauf-number {
    position: relative;
    transform: none;
    margin-bottom: var(--space-md);
  }
  
  .faq-answer-content {
    padding-right: 0;
  }
  
  .toc-list {
    gap: var(--space-sm);
  }
  
  .toc-link {
    font-size: 0.8125rem;
    padding: var(--space-xs) var(--space-sm);
  }
}

/* === ANIMATION CLASSES === */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.6s ease-out forwards;
}

.animate-slide-in-left {
  animation: slideInLeft 0.6s ease-out forwards;
}

.animate-slide-in-right {
  animation: slideInRight 0.6s ease-out forwards;
}

/* === PERFORMANCE OPTIMIZATIONS === */
.card,
.preis-card,
.warum-card,
.hero-image img {
  will-change: transform;
}

/* Reduce motion for users who prefer it */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
  
  .wartungsseite-champions::before {
    animation: none;
  }
  
  .hero-image:hover img,
  .card:hover,
  .preis-card:hover,
  .hero-cta:hover,
  .cta-button:hover,
  .preis-button:hover {
    transform: none;
  }
}

/* === HIGH CONTRAST MODE SUPPORT === */
@media (prefers-contrast: high) {
  :root {
    --glass-bg: rgba(0, 0, 0, 0.8);
    --glass-border: rgba(255, 255, 255, 0.3);
    --primary-200: #ffffff;
    --primary-300: #e5e5e5;
  }
}

/* === FOCUS IMPROVEMENTS === */
.hero-cta:focus,
.toc-link:focus,
.faq-button:focus,
.preis-button:focus,
.cta-button:focus {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
}

/* === PRINT STYLES === */
@media print {
  .wartungsseite-champions::before,
  .toc-nav,
  .hero-cta,
  .preis-button,
  .cta-button {
    display: none;
  }
  
  .section {
    page-break-inside: avoid;
  }
  
  .card,
  .preis-card,
  .warum-card {
    border: 1px solid #000;
    background: #fff;
    color: #000;
  }
}
</style>

<!-- Skip Link für Barrierefreiheit -->
<a href="#main-content" class="skip-link">Zum Hauptinhalt springen</a>

<div class="wartungsseite-champions">
    <!-- Hero Section -->
    <section class="hero-section" aria-labelledby="hero-title">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <?php if(get_field('wartung_hero_slogan')): ?>
                        <span class="hero-badge" aria-label="Service-Badge">
                            <?php the_field('wartung_hero_slogan'); ?>
                        </span>
                    <?php endif; ?>
                    
                    <h1 id="hero-title" class="hero-title">
                        <?php the_field('wartung_hero_headline'); ?>
                    </h1>
                    
                    <?php $lead_text = get_field('wartung_hero_lead_text'); if($lead_text): ?>
                        <p class="hero-lead">
                            <?php echo wp_kses_post(nl2br($lead_text)); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php $hero_button = get_field('wartung_hero_button'); if($hero_button): ?>
                        <a href="<?php echo esc_url($hero_button['url']); ?>" 
                           class="hero-cta" 
                           target="<?php echo esc_attr($hero_button['target'] ?: '_self'); ?>"
                           <?php if($hero_button['target'] === '_blank'): ?>
                               rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr($hero_button['title']); ?> (öffnet in neuem Fenster)"
                           <?php endif; ?>>
                            <span><?php echo esc_html($hero_button['title']); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="hero-image">
                    <?php $hero_image = get_field('wartung_hero_image'); if($hero_image): ?>
                        <img src="<?php echo esc_url($hero_image['url']); ?>" 
                             alt="<?php echo esc_attr($hero_image['alt'] ?: 'Wartungsservice Illustration'); ?>"
                             loading="eager"
                             decoding="async" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Table of Contents Navigation als Verzeichnis -->
    <nav class="toc-nav toc-sticky-fix" aria-label="Seitenverzeichnis">
        <div class="container">
            <div class="toc-header">
                <h2 class="toc-title">Inhaltsverzeichnis</h2>
                <p class="toc-subtitle">Navigation durch unsere Wartungsleistungen</p>
            </div>
            <ul class="toc-list" role="list">
                <li><a href="#hero" class="toc-link">Überblick</a></li>
                <li><a href="#vorteile" class="toc-link">Mehrwert</a></li>
                <li><a href="#warum" class="toc-link">Warum wir</a></li>
                <li><a href="#leistungen" class="toc-link">Leistungen</a></li>
                <li><a href="#ablauf" class="toc-link">Ablauf</a></li>
                <li><a href="#preise" class="toc-link">Preise</a></li>
                <li><a href="#faq" class="toc-link">FAQ</a></li>
                <li><a href="#kontakt" class="toc-link">Kontakt</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Vorteile Section -->
        <section id="vorteile" class="section" aria-labelledby="vorteile-title">
            <div class="container">
                <h2 id="vorteile-title" class="section-title">
                    <?php the_field('wartung_vorteile_headline'); ?>
                </h2>
                
                <?php if(have_rows('wartung_vorteile_repeater')): ?>
                    <div class="card-grid" role="list">
                        <?php while(have_rows('wartung_vorteile_repeater')): the_row(); ?>
                            <div class="card card-horizontal" role="listitem">
                                <div class="card-icon" aria-hidden="true">
                                    <?php the_sub_field('icon'); ?>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                    <p class="card-description">
                                        <?php the_sub_field('description'); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Warum Section -->
        <section id="warum" class="section" aria-labelledby="warum-title">
            <div class="container">
                <h2 id="warum-title" class="section-title">
                    <?php the_field('wartung_warum_headline'); ?>
                </h2>
                
                <?php if(have_rows('wartung_warum_repeater')): ?>
                    <div class="card-grid" role="list">
                        <?php while(have_rows('wartung_warum_repeater')): the_row(); ?>
                            <div class="warum-card" role="listitem">
                                <div class="warum-header">
                                    <span class="warum-icon" aria-hidden="true">
                                        <?php the_sub_field('icon'); ?>
                                    </span>
                                    <h3 class="warum-title">
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                </div>
                                <div class="warum-divider" aria-hidden="true"></div>
                                <p class="warum-description">
                                    <?php the_sub_field('description'); ?>
                                </p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Leistungen Section -->
        <section id="leistungen" class="section" aria-labelledby="leistungen-title">
            <div class="container">
                <h2 id="leistungen-title" class="section-title">
                    <?php the_field('wartung_leistungen_headline'); ?>
                </h2>
                
                <?php if(have_rows('wartung_leistungen_repeater')): ?>
                    <div class="card-grid" role="list">
                        <?php while(have_rows('wartung_leistungen_repeater')): the_row(); ?>
                            <div class="card card-horizontal" role="listitem">
                                <div class="card-icon" aria-hidden="true">
                                    <?php the_sub_field('icon'); ?>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                    <p class="card-description">
                                        <?php the_sub_field('description'); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Ablauf Section -->
        <section id="ablauf" class="section" aria-labelledby="ablauf-title">
            <div class="container">
                <h2 id="ablauf-title" class="section-title">
                    <?php the_field('wartung_ablauf_headline'); ?>
                </h2>
                
                <?php if(have_rows('wartung_ablauf_repeater')): ?>
                    <div class="ablauf-container">
                        <ol class="sr-only">
                            <?php while(have_rows('wartung_ablauf_repeater')): the_row(); ?>
                                <li><?php the_sub_field('title'); ?></li>
                            <?php endwhile; ?>
                        </ol>
                        
                        <?php 
                        $step_counter = 1; 
                        while(have_rows('wartung_ablauf_repeater')): the_row(); 
                        ?>
                            <div class="ablauf-step" data-step="<?php echo $step_counter; ?>">
                                <div class="ablauf-line">
                                    <div class="ablauf-number" aria-hidden="true">
                                        <?php echo $step_counter; ?>
                                    </div>
                                </div>
                                <div class="ablauf-content">
                                    <h3 class="ablauf-title">
                                        <span class="sr-only">Schritt <?php echo $step_counter; ?>: </span>
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                    <div class="ablauf-description">
                                        <?php 
                                        $description = get_sub_field('description');
                                        // Verkaufspsychologie-Text hervorheben
                                        $description = preg_replace(
                                            '/\*([^*]+)\*/',
                                            '<span class="ablauf-highlight">$1</span>',
                                            $description
                                        );
                                        echo wp_kses_post(nl2br($description));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $step_counter++; 
                        endwhile; 
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Preise Section -->
        <section id="preise" class="section" aria-labelledby="preise-title">
            <div class="container">
                <h2 id="preise-title" class="section-title">
                    <?php the_field('wartung_preise_headline'); ?>
                </h2>
                
                <?php if(have_rows('wartung_preise_repeater')): ?>
                    <div class="preise-grid" role="list">
                        <?php while(have_rows('wartung_preise_repeater')): the_row(); 
                        $is_featured = get_sub_field('is_highlighted');
                        ?>
                            <div class="preis-card <?php echo $is_featured ? 'featured' : ''; ?>" role="listitem">
                                <?php if($is_featured && get_sub_field('highlight_badge_text')): ?>
                                    <div class="preis-badge">
                                        <?php the_sub_field('highlight_badge_text'); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="preis-header">
                                    <h3 class="preis-name">
                                        <?php the_sub_field('package_name'); ?>
                                    </h3>
                                </div>
                                
                                <div class="preis-amount">
                                    <?php the_sub_field('price'); ?>
                                    <?php if(get_sub_field('price_suffix')): ?>
                                        <span class="preis-suffix">
                                            <?php the_sub_field('price_suffix'); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <?php 
                                $features = get_sub_field('features');
                                if($features):
                                    // Convert HTML list to proper markup
                                    $features = wp_kses_post($features);
                                ?>
                                    <div class="preis-features">
                                        <?php echo $features; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php $preis_button = get_sub_field('button'); if($preis_button): ?>
                                    <a href="<?php echo esc_url($preis_button['url']); ?>" 
                                       class="preis-button" 
                                       target="<?php echo esc_attr($preis_button['target'] ?: '_self'); ?>"
                                       <?php if($preis_button['target'] === '_blank'): ?>
                                           rel="noopener noreferrer"
                                           aria-label="<?php echo esc_attr($preis_button['title']); ?> (öffnet in neuem Fenster)"
                                       <?php endif; ?>>
                                        <?php echo esc_html($preis_button['title']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="section" aria-labelledby="faq-title">
            <div class="container">
                <h2 id="faq-title" class="section-title">
                    <?php the_field('wartung_faq_headline'); ?>
                </h2>
                
                <?php if(have_rows('wartung_faq_repeater')): ?>
                    <div class="faq-container">
                        <?php 
                        $faq_counter = 1;
                        while(have_rows('wartung_faq_repeater')): the_row(); 
                        ?>
                            <div class="faq-item" data-faq="<?php echo $faq_counter; ?>">
                                <button class="faq-button" 
                                        aria-expanded="false" 
                                        aria-controls="faq-answer-<?php echo $faq_counter; ?>"
                                        id="faq-button-<?php echo $faq_counter; ?>">
                                    <span><?php the_sub_field('question'); ?></span>
                                    <span class="faq-icon" aria-hidden="true">+</span>
                                </button>
                                <div class="faq-answer" 
                                     id="faq-answer-<?php echo $faq_counter; ?>"
                                     aria-labelledby="faq-button-<?php echo $faq_counter; ?>"
                                     role="region">
                                    <div class="faq-answer-content">
                                        <?php echo wp_kses_post(nl2br(get_sub_field('answer'))); ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $faq_counter++;
                        endwhile; 
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- CTA Section -->
        <section id="kontakt" class="section" aria-labelledby="cta-title">
            <div class="container">
                <div class="cta-section">
                    <div class="cta-content">
                        <h2 id="cta-title" class="cta-title">
                            <?php the_field('wartung_cta_headline'); ?>
                        </h2>
                        
                        <?php $cta_text = get_field('wartung_cta_text'); if($cta_text): ?>
                            <p class="cta-text">
                                <?php echo wp_kses_post(nl2br($cta_text)); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php $cta_button = get_field('wartung_cta_button'); if($cta_button): ?>
                            <a href="<?php echo esc_url($cta_button['url']); ?>" 
                               class="cta-button" 
                               target="<?php echo esc_attr($cta_button['target'] ?: '_self'); ?>"
                               <?php if($cta_button['target'] === '_blank'): ?>
                                   rel="noopener noreferrer"
                                   aria-label="<?php echo esc_attr($cta_button['title']); ?> (öffnet in neuem Fenster)"
                               <?php endif; ?>>
                                <span><?php echo esc_html($cta_button['title']); ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if(get_field('wartung_cta_trust_text')): ?>
                            <p class="cta-trust">
                                <?php the_field('wartung_cta_trust_text'); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
(function() {
    'use strict';
    
    // JavaScript Fallback für Sticky wenn CSS nicht funktioniert
    function initStickyFallback() {
        const tocNav = document.querySelector('.toc-nav');
        if (!tocNav) return;
        
        let isSticky = false;
        const originalTop = tocNav.offsetTop;
        
        function checkSticky() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop >= originalTop && !isSticky) {
                tocNav.style.position = 'fixed';
                tocNav.style.top = '0';
                tocNav.style.left = '0';
                tocNav.style.right = '0';
                tocNav.style.width = '100%';
                tocNav.style.zIndex = '1000';
                isSticky = true;
            } else if (scrollTop < originalTop && isSticky) {
                tocNav.style.position = 'relative';
                tocNav.style.top = 'auto';
                tocNav.style.left = 'auto';
                tocNav.style.right = 'auto';
                tocNav.style.width = 'auto';
                isSticky = false;
            }
        }
        
        // Check if sticky is supported, if not use fallback
        const testEl = document.createElement('div');
        testEl.style.position = 'sticky';
        if (testEl.style.position !== 'sticky') {
            window.addEventListener('scroll', checkSticky);
            window.addEventListener('resize', checkSticky);
        }
    }
    
    // Performance optimized DOMContentLoaded
    function init() {
        initFAQ();
        initAblaufAnimation();
        initSmoothScrolling();
        initIntersectionObserver();
        initKeyboardNavigation();
        initStickyFallback(); // Sticky Fallback für Theme-Kompatibilität
    }
    
    // FAQ Accordion mit verbesserter Accessibility
    function initFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const button = item.querySelector('.faq-button');
            const answer = item.querySelector('.faq-answer');
            
            if (!button || !answer) return;
            
            button.addEventListener('click', function() {
                const isOpen = item.classList.contains('open');
                
                // Alle anderen FAQs schließen
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('open');
                        const otherButton = otherItem.querySelector('.faq-button');
                        if (otherButton) {
                            otherButton.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
                
                // Aktuelles FAQ togglen
                if (isOpen) {
                    item.classList.remove('open');
                    button.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('open');
                    button.setAttribute('aria-expanded', 'true');
                    
                    // Smooth scroll zum geöffneten FAQ
                    setTimeout(() => {
                        button.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    }, 300);
                }
            });
            
            // Keyboard Support
            button.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    button.click();
                }
            });
        });
    }
    
    // Ablauf Animation mit Intersection Observer
    function initAblaufAnimation() {
        const ablaufSteps = document.querySelectorAll('.ablauf-step');
        
        if (!ablaufSteps.length || !window.IntersectionObserver) return;
        
        const observerOptions = {
            threshold: 0.7,
            rootMargin: '-50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const step = entry.target;
                    step.classList.add('filled', 'animate-in');
                    
                    // Optional: Animation mit delay für besseren Effekt
                    const stepNumber = parseInt(step.dataset.step) || 1;
                    setTimeout(() => {
                        step.style.transitionDelay = `${stepNumber * 0.1}s`;
                    }, 100);
                }
            });
        }, observerOptions);
        
        ablaufSteps.forEach(step => {
            observer.observe(step);
        });
    }
    
    // Smooth Scrolling für TOC Links
    function initSmoothScrolling() {
        const tocLinks = document.querySelectorAll('.toc-link');
        
        tocLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    const headerOffset = 100;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Focus management für Accessibility
                    setTimeout(() => {
                        targetElement.focus();
                    }, 500);
                }
            });
        });
    }
    
    // Intersection Observer für Card Animationen
    function initIntersectionObserver() {
        const animatedElements = document.querySelectorAll('.card, .warum-card, .preis-card');
        
        if (!animatedElements.length || !window.IntersectionObserver) return;
        
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animate-fade-in-up');
                    }, index * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
    
    // Keyboard Navigation Improvements
    function initKeyboardNavigation() {
        // Focus trap für Modal-ähnliche Elemente
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // FAQ schließen bei ESC
                const openFAQ = document.querySelector('.faq-item.open');
                if (openFAQ) {
                    openFAQ.classList.remove('open');
                    const button = openFAQ.querySelector('.faq-button');
                    if (button) {
                        button.setAttribute('aria-expanded', 'false');
                        button.focus();
                    }
                }
            }
        });
        
        // Tab navigation improvements
        const focusableElements = document.querySelectorAll(
            'a[href], button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
        );
        
        focusableElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Performance: Preload critical resources
    function preloadCriticalResources() {
        const criticalImages = document.querySelectorAll('img[loading="eager"]');
        criticalImages.forEach(img => {
            if (img.complete) return;
            
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = img.src;
            document.head.appendChild(link);
        });
    }
    
    // Error handling
    window.addEventListener('error', function(e) {
        console.warn('Wartungsseite JS Error:', e.error);
    });
    
    // Expose some functions globally if needed
    window.WartungsseiteChampions = {
        init: init,
        initFAQ: initFAQ,
        initAblaufAnimation: initAblaufAnimation
    };
    
})();
</script>

<?php
// === ENDE DER WARTUNGSSEITE ===
// Zurück zu WordPress Theme
