// ===================================================================
// STARTSEITE CHAMPIONS LEAGUE EDITION - ACF PRO 3.0
// Features: A11y-optimiert, Performance-boost, Open Sans, SEO-ready
// KORRIGIERT FÜR STICKY INHALTSVERZEICHNIS UNTER BLOCKSY HEADER
// ===================================================================

// Security Check
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<style>
/* === CHAMPIONS LEAGUE STARTSEITE CSS === */
/* Lokale Open Sans Schriftart wird verwendet */

/* CSS Custom Properties für bessere Performance */
:root {
  /* Design System - Farben */
  --primary-900: #09090b;
  --primary-800: #18181b;
  --primary-700: #27272a;
  --primary-600: #3f3f46;
  --primary-500: #52525b;
  --primary-400: #71717a;
  --primary-300: #a1a1aa;
  --primary-200: #d4d4d8;
  --primary-100: #f4f4f5;
  --primary-50: #fafafa;
  
  /* Accent Colors - Blau Theme */
  --accent-600: #0284c7;
  --accent-500: #0ea5e9;
  --accent-400: #38bdf8;
  --accent-300: #7dd3fc;
  --accent-200: #bae6fd;
  --accent-100: #e0f2fe;
  
  /* Gradients */
  --gradient-primary: linear-gradient(135deg, var(--primary-800) 0%, var(--primary-700) 100%);
  --gradient-secondary: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-500) 100%);
  --gradient-accent: linear-gradient(135deg, var(--accent-500) 0%, var(--accent-600) 100%);
  --gradient-glass: linear-gradient(135deg, rgba(39, 39, 42, 0.4) 0%, rgba(63, 63, 70, 0.2) 100%);
  
  /* Glass Morphism */
  --glass-bg: rgba(39, 39, 42, 0.3);
  --glass-border: rgba(82, 82, 91, 0.2);
  --glass-blur: blur(20px);
  
  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  --shadow-glow: 0 8px 32px rgba(14, 165, 233, 0.15);
  --shadow-intense: 0 20px 40px rgba(0, 0, 0, 0.6);
  --shadow-focus: 0 0 0 3px rgba(14, 165, 233, 0.5);
  
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
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 20px;
  --radius-2xl: 24px;
  
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
  --leading-loose: 1.75;
  
  /* Transitions */
  --transition-fast: 150ms ease-out;
  --transition-normal: 250ms ease-out;
  --transition-slow: 350ms ease-out;
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
  scroll-padding-top: 140px; /* Erhöht für sticky Header + Puffer */
}

body {
  font-family: var(--font-family);
  line-height: var(--leading-normal);
  color: var(--primary-50);
  background: var(--primary-900);
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

/* === STARTSEITE CONTAINER === */
.startseite-champions {
  position: relative;
  min-height: 100vh;
  overflow-x: hidden;
}

/* === ANIMATED BACKGROUND === */
.startseite-champions::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    radial-gradient(circle at 20% 50%, rgba(14, 165, 233, 0.08) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.06) 0%, transparent 50%);
  animation: backgroundMove 25s ease-in-out infinite;
  z-index: -1;
  will-change: transform;
}

@keyframes backgroundMove {
  0%, 100% { 
    transform: translate3d(0, 0, 0) rotate(0deg); 
  }
  33% { 
    transform: translate3d(-20px, -20px, 0) rotate(1deg); 
  }
  66% { 
    transform: translate3d(20px, 20px, 0) rotate(-1deg); 
  }
}

/* === HERO SECTION === */
.hero-section {
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding: var(--space-4xl) var(--space-md) var(--space-xl);
}

.hero-container {
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-3xl);
  align-items: center;
}

@media (min-width: 768px) {
  .hero-container {
    grid-template-columns: 1fr 1fr;
    gap: var(--space-4xl);
    padding: 0 var(--space-4xl);
  }
}

@media (min-width: 1200px) {
  .hero-container {
    padding: 0 var(--space-5xl);
  }
}

.hero-content {
  text-align: center;
  animation: slideInLeft 0.8s ease-out;
}

@media (min-width: 768px) {
  .hero-content {
    text-align: left;
  }
}

.hero-badge {
  display: inline-block;
  font-size: 0.875rem;
  font-weight: var(--font-weight-medium);
  background: var(--gradient-accent);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: var(--space-md);
  text-transform: uppercase;
  letter-spacing: 0.15em;
}

.hero-title {
  font-size: clamp(1.875rem, 5vw, 3.5rem);
  font-weight: var(--font-weight-bold);
  line-height: var(--leading-tight);
  margin-bottom: var(--space-lg);
  color: var(--primary-50);
  letter-spacing: -0.025em;
}

.hero-description {
  font-size: clamp(1rem, 2vw, 1.25rem);
  color: var(--primary-200);
  margin-bottom: var(--space-xl);
  line-height: var(--leading-loose);
  max-width: 600px;
}

@media (min-width: 768px) {
  .hero-description {
    margin-left: 0;
    margin-right: 0;
  }
}

@media (max-width: 767px) {
  .hero-description {
    margin-left: auto;
    margin-right: auto;
  }
}

.hero-actions {
  margin-bottom: var(--space-md);
}

.hero-note {
  font-size: 0.875rem;
  color: var(--primary-300);
  font-style: italic;
}

.hero-image {
  text-align: center;
  animation: slideInRight 0.8s ease-out;
}

.hero-image img {
  width: 100%;
  max-width: 500px;
  height: auto;
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-intense);
  transition: transform var(--transition-slow);
}

@media (min-width: 768px) {
  .hero-image img {
    width: 80%;
    max-width: 600px;
  }
}

.hero-image:hover img {
  transform: scale(1.02);
}

/* === TABLE OF CONTENTS (STICKY FIX APPLIED) === */
.toc-section {
    /* STICKY POSITIONING */
    position: sticky !important;
    
    /* Dein Header ist 120px hoch. Wir nehmen 135px (120px + 15px Puffer). */
    top: 135px !important; 
    
    /* Der Header hat wahrscheinlich z-index: 1000, wir nehmen 1001. */
    z-index: 1001 !important;

    /* Original Layout-Stile beibehalten */
    max-width: 1200px;
    margin: var(--space-3xl) auto var(--space-xl);
    padding: 0 var(--space-md);
}

@media (min-width: 768px) {
  .toc-section {
    margin-top: var(--space-5xl);
  }
}

.toc-container {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: var(--space-md);
  box-shadow: var(--shadow-glow);
}

.toc-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-sm);
  list-style: none;
}

@media (min-width: 768px) {
  .toc-list {
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    gap: var(--space-md);
    padding: var(--space-md) var(--space-xl);
  }
}

.toc-link {
  color: var(--primary-200);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  transition: all var(--transition-normal);
  padding: var(--space-sm) var(--space-md);
  border-radius: var(--radius-sm);
  display: block;
  text-align: center;
}

@media (min-width: 768px) {
  .toc-link {
    display: inline-block;
  }
}

.toc-link:hover,
.toc-link:focus-visible {
  color: var(--primary-50);
  background: var(--gradient-accent);
  transform: translateY(-1px);
}

.toc-link:focus-visible {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
}

/* ===================================================================
   WICHTIG: FALLS ES IMMER NOCH NICHT FUNKTIONIERT
   ===================================================================
   Wenn das Inhaltsverzeichnis beim Scrollen verschwindet, 
   entferne die Kommentarzeichen (/* und * /) von diesem Block 
   und ersetze '.der-blocksy-container-mit-overflow' mit der 
   Klasse des Containers, der 'overflow: hidden' hat.
   Du findest ihn mit der Rechtsklick -> Untersuchen Methode.
   ===================================================================

*.der-blocksy-container-mit-overflow {
    overflow: visible !important;
}

*/

/* === SECTION STYLES === */
.section {
  padding: var(--space-3xl) var(--space-md);
  max-width: 1200px;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .section {
    padding: var(--space-5xl) var(--space-xl);
  }
}

.section-title {
  font-size: clamp(1.875rem, 4vw, 3rem);
  font-weight: var(--font-weight-semibold);
  text-align: center;
  margin-bottom: var(--space-xl);
  color: var(--primary-50);
  letter-spacing: -0.025em;
}

@media (min-width: 768px) {
  .section-title {
    margin-bottom: var(--space-3xl);
  }
}

/* === CARD GRID SYSTEMS === */
.card-grid {
  display: grid;
  gap: var(--space-lg);
  grid-template-columns: 1fr;
}

.card-grid.whyme-grid {
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

.card-grid.facts-grid {
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

@media (min-width: 768px) {
  .card-grid {
    gap: var(--space-xl);
  }
}

/* === CARD COMPONENTS === */
.card {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: var(--space-lg);
  transition: all var(--transition-normal);
  position: relative;
  overflow: hidden;
}

@media (min-width: 768px) {
  .card {
    padding: var(--space-xl);
  }
}

.card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: var(--gradient-accent);
  transform: scaleX(0);
  transition: transform var(--transition-normal);
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-glow);
  border-color: rgba(14, 165, 233, 0.3);
}

.card:hover::before {
  transform: scaleX(1);
}

.card-title {
  font-size: 1.25rem;
  font-weight: var(--font-weight-normal);
  margin-bottom: var(--space-sm);
  color: var(--primary-50);
  font-family: var(--font-family);
}

@media (min-width: 768px) {
  .card-title {
    font-size: 1.4rem;
    margin-bottom: var(--space-md);
  }
}

.card-text {
  color: var(--primary-200);
  line-height: var(--leading-relaxed);
}

/* === FACTS CARDS === */
.facts-card {
  text-align: center;
}

.facts-number {
  font-size: 2rem;
  font-weight: var(--font-weight-bold);
  background: var(--gradient-accent);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: var(--space-sm);
  line-height: 1;
}

@media (min-width: 768px) {
  .facts-number {
    font-size: 2.5rem;
  }
}

/* === TIMELINE SECTION === */
.timeline-section {
  background: var(--gradient-primary);
  border-radius: var(--radius-xl);
  padding: var(--space-xl) var(--space-md);
  margin: var(--space-xl) 0;
  position: relative;
  overflow: hidden;
}

@media (min-width: 768px) {
  .timeline-section {
    padding: var(--space-4xl) var(--space-xl);
  }
}

.timeline-container {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
}

.timeline-track {
  display: none;
}

@media (min-width: 768px) {
  .timeline-track {
    display: block;
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: var(--glass-bg);
    transform: translateX(-50%);
    border-radius: 2px;
  }
  
  .timeline-progress {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 0;
    background: var(--gradient-accent);
    border-radius: 2px;
    transition: height var(--transition-normal);
    box-shadow: 0 0 10px rgba(14, 165, 233, 0.3);
  }
}

.timeline-step {
  margin-bottom: var(--space-xl);
}

@media (min-width: 768px) {
  .timeline-step {
    display: flex;
    align-items: center;
    margin-bottom: var(--space-4xl);
  }
  
  .timeline-step:nth-child(even) {
    flex-direction: row-reverse;
  }
  
  .timeline-step:nth-child(even) .timeline-card {
    text-align: right;
  }
}

.timeline-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--gradient-accent);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: var(--font-weight-semibold);
  font-size: 1rem;
  color: var(--primary-900);
  box-shadow: var(--shadow-glow);
  flex-shrink: 0;
  margin: 0 auto var(--space-md);
}

@media (min-width: 768px) {
  .timeline-icon {
    width: 50px;
    height: 50px;
    font-size: 1.1rem;
    margin: 0 var(--space-xl);
  }
}

.timeline-card {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: var(--space-lg);
  max-width: 100%;
  transition: all var(--transition-normal);
  text-align: center;
}

@media (min-width: 768px) {
  .timeline-card {
    padding: var(--space-xl);
    max-width: 300px;
    text-align: left;
  }
}

.timeline-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-glow);
}

.timeline-card h3 {
  font-size: 1.2rem;
  font-weight: var(--font-weight-normal);
  margin-bottom: var(--space-sm);
  color: var(--primary-50);
  font-family: var(--font-family);
}

@media (min-width: 768px) {
  .timeline-card h3 {
    font-size: 1.3rem;
    margin-bottom: var(--space-md);
  }
}

.timeline-card p {
  color: var(--primary-200);
  font-size: 0.95rem;
  line-height: var(--leading-relaxed);
}

@media (min-width: 768px) {
  .timeline-card p {
    font-size: 1rem;
  }
}

/* === FAQ SECTION === */
.faq-container {
  max-width: 800px;
  margin: 0 auto;
}

.faq-item {
  margin-bottom: var(--space-sm);
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  overflow: hidden;
  transition: all var(--transition-normal);
}

@media (min-width: 768px) {
  .faq-item {
    margin-bottom: var(--space-md);
  }
}

.faq-item:hover {
  border-color: rgba(14, 165, 233, 0.3);
}

.faq-checkbox {
  display: none;
}

.faq-question {
  display: block;
  padding: var(--space-lg) var(--space-md);
  cursor: pointer;
  font-weight: var(--font-weight-semibold);
  position: relative;
  transition: all var(--transition-normal);
  padding-right: var(--space-3xl);
  font-size: 0.95rem;
  color: var(--primary-50);
  font-family: var(--font-family);
}

@media (min-width: 768px) {
  .faq-question {
    padding: var(--space-lg) var(--space-xl);
    font-size: 1rem;
  }
}

.faq-question:hover {
  background: rgba(255, 255, 255, 0.05);
}

.faq-question::after {
  content: '+';
  position: absolute;
  right: var(--space-md);
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.5rem;
  transition: transform var(--transition-normal);
  color: var(--accent-500);
}

@media (min-width: 768px) {
  .faq-question::after {
    right: var(--space-xl);
  }
}

.faq-checkbox:checked + .faq-question::after {
  transform: translateY(-50%) rotate(45deg);
}

.faq-answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height var(--transition-normal);
  padding: 0 var(--space-md);
  color: var(--primary-200);
  font-size: 0.9rem;
  line-height: var(--leading-relaxed);
}

@media (min-width: 768px) {
  .faq-answer {
    padding: 0 var(--space-xl);
    font-size: 1rem;
  }
}

.faq-checkbox:checked ~ .faq-answer {
  max-height: 300px;
  padding-bottom: var(--space-lg);
}

@media (min-width: 768px) {
  .faq-checkbox:checked ~ .faq-answer {
    padding-bottom: var(--space-lg);
  }
}

/* === ABOUT SECTION === */
.about-container {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-xl);
  align-items: center;
  text-align: center;
}

@media (min-width: 768px) {
  .about-container {
    grid-template-columns: 1fr 2fr;
    gap: var(--space-3xl);
    text-align: left;
  }
}

.about-image img {
  width: 70%;
  max-width: 300px;
  border-radius: var(--radius-md);
  border: 3px solid var(--accent-500);
  box-shadow: var(--shadow-intense);
  transition: transform var(--transition-normal);
  margin: 0 auto;
  display: block;
}

@media (min-width: 768px) {
  .about-image img {
    width: 60%;
    margin: 0;
  }
}

.about-image img:hover {
  transform: scale(1.05);
}

.about-content h2 {
  margin-bottom: var(--space-lg);
}

@media (min-width: 768px) {
  .about-content h2 {
    text-align: left;
    margin-bottom: var(--space-xl);
  }
}

.about-content p {
  font-size: 1rem;
  color: var(--primary-200);
  line-height: var(--leading-loose);
}

@media (min-width: 768px) {
  .about-content p {
    font-size: 1.1rem;
  }
}

/* === CTA SECTION === */
.cta-section {
  text-align: center;
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-xl);
  padding: var(--space-3xl) var(--space-lg);
  margin: var(--space-3xl) auto;
}

@media (min-width: 768px) {
  .cta-section {
    padding: var(--space-4xl) var(--space-xl);
    margin: var(--space-4xl) auto;
  }
}

.cta-section h2 {
  margin-bottom: var(--space-md);
}

@media (min-width: 768px) {
  .cta-section h2 {
    margin-bottom: var(--space-lg);
  }
}

.cta-section p {
  font-size: 1.1rem;
  color: var(--primary-200);
  margin-bottom: var(--space-xl);
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
  line-height: var(--leading-relaxed);
}

@media (min-width: 768px) {
  .cta-section p {
    font-size: 1.2rem;
  }
}

/* === BUTTON SYSTEM === */
.btn {
  display: inline-block;
  padding: var(--space-sm) var(--space-lg);
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-semibold);
  text-decoration: none;
  transition: all var(--transition-normal);
  font-size: 1rem;
  text-align: center;
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;
  touch-action: manipulation;
  font-family: var(--font-family);
}

@media (min-width: 768px) {
  .btn {
    padding: var(--space-md) var(--space-xl);
    font-size: 1.1rem;
  }
}

.btn-primary {
  background: var(--gradient-accent);
  color: white;
  box-shadow: var(--shadow-glow);
  border: 1px solid rgba(14, 165, 233, 0.3);
}

.btn-primary:hover,
.btn-primary:focus-visible {
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(14, 165, 233, 0.25);
}

.btn-secondary {
  background: var(--glass-bg);
  color: white;
  border: 1px solid var(--glass-border);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
}

.btn-secondary:hover,
.btn-secondary:focus-visible {
  background: var(--gradient-secondary);
  transform: translateY(-2px);
}

.btn:focus-visible {
  outline: 2px solid var(--accent-500);
  outline-offset: 2px;
}

.btn-group {
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
  align-items: center;
}

@media (min-width: 600px) {
  .btn-group {
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
  }
}

.btn-group .btn {
  width: 100%;
  max-width: 280px;
}

@media (min-width: 600px) {
  .btn-group .btn {
    width: auto;
  }
}

/* === ANIMATIONS === */
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

.animate-on-scroll {
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.6s ease;
}

.animate-on-scroll.animated {
  opacity: 1;
  transform: translateY(0);
}

/* === ACCESSIBILITY & PERFORMANCE === */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
  
  .startseite-champions::before {
    animation: none;
  }
  
  .hero-image:hover img,
  .card:hover,
  .btn:hover,
  .timeline-card:hover,
  .about-image img:hover {
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

/* === PRINT STYLES === */
@media print {
  .startseite-champions::before,
  .toc-section,
  .btn {
    display: none;
  }
  
  .section {
    page-break-inside: avoid;
  }
  
  .card,
  .timeline-card {
    border: 1px solid #000;
    background: #fff;
    color: #000;
  }
}

/* === PERFORMANCE OPTIMIZATIONS === */
.card,
.timeline-card,
.hero-image img,
.about-image img {
  will-change: transform;
}
</style>

<a href="#main-content" class="skip-link">Zum Hauptinhalt springen</a>

<div class="startseite-champions">
    <header class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <?php if ($slogan = get_field('start_hero_slogan')): ?>
                    <span class="hero-badge" role="text" aria-label="Service-Badge">
                        <?php echo esc_html($slogan); ?>
                    </span>
                <?php endif; ?>
                
                <?php if ($headline = get_field('start_hero_headline')): ?>
                    <h1 class="hero-title">
                        <?php echo wp_kses_post($headline); ?>
                    </h1>
                <?php endif; ?>
                
                <?php if ($description = get_field('start_hero_description')): ?>
                    <p class="hero-description">
                        <?php echo wp_kses_post($description); ?>
                    </p>
                <?php endif; ?>
                
                <div class="hero-actions">
                    <?php $button = get_field('start_hero_button'); if ($button): ?>
                        <a href="<?php echo esc_url($button['url']); ?>" 
                           class="btn btn-primary" 
                           target="<?php echo esc_attr($button['target'] ?: '_self'); ?>"
                           <?php if($button['target'] === '_blank'): ?>
                               rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr($button['title']); ?> (öffnet in neuem Fenster)"
                           <?php endif; ?>>
                            <?php echo esc_html($button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
                
                <?php if ($note = get_field('start_hero_note')): ?>
                    <span class="hero-note">
                        <?php echo esc_html($note); ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <div class="hero-image">
                <?php $image = get_field('start_hero_image'); if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt'] ?: 'Hero Illustration'); ?>" 
                         width="<?php echo esc_attr($image['width'] ?: '500'); ?>" 
                         height="<?php echo esc_attr($image['height'] ?: '400'); ?>" 
                         loading="eager"
                         decoding="async">
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <nav class="toc-section" aria-label="Inhaltsverzeichnis">
        <div class="toc-container">
            <ul class="toc-list" role="list">
                <li><a href="#warum-mit-mir" class="toc-link">Warum mit mir?</a></li>
                <li><a href="#hard-facts" class="toc-link">Hard Facts</a></li>
                <li><a href="#prozess" class="toc-link">Roadmovie-Prozess</a></li>
                <li><a href="#faq" class="toc-link">FAQ</a></li>
                <li><a href="#ueber-mich" class="toc-link">Über mich</a></li>
                <li><a href="#cta-kontakt" class="toc-link">Los geht's</a></li>
            </ul>
        </div>
    </nav>
    
    <main id="main-content">
        <section id="warum-mit-mir" class="section animate-on-scroll" aria-labelledby="warum-title">
            <h2 id="warum-title" class="section-title">
                <?php 
                $warum_headline = get_field('start_warum_headline');
                echo $warum_headline ? esc_html($warum_headline) : 'Warum gerade mit mir?';
                ?>
            </h2>
            
            <div class="card-grid whyme-grid" role="list">
                <?php if(have_rows('start_warum_cards')): ?>
                    <?php while(have_rows('start_warum_cards')): the_row(); ?>
                        <article class="card" role="listitem">
                            <h3 class="card-title">
                                <?php the_sub_field('title'); ?>
                            </h3>
                            <p class="card-text">
                                <?php the_sub_field('text'); ?>
                            </p>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <article class="card" role="listitem">
                        <h3 class="card-title">WordPress & Shopify-Expertise</h3>
                        <p class="card-text">Individuelle Themes und Shops, die mit deinem Wachstum skalieren – lokal entwickelt in der Region Hannover, global einsetzbar.</p>
                    </article>
                    <article class="card" role="listitem">
                        <h3 class="card-title">SEO 2025 & Content</h3>
                        <p class="card-text">Themen-Cluster, AI-Inhalte und technisches SEO sorgen für nachhaltige Rankings und mehr Sichtbarkeit in Hannover und darüber hinaus.</p>
                    </article>
                    <article class="card" role="listitem">
                        <h3 class="card-title">Conversion & Psychologie</h3>
                        <p class="card-text">UX-Audits, A/B-Tests und psychologische Copy machen Besucher zu loyalen Kunden.</p>
                    </article>
                    <article class="card" role="listitem">
                        <h3 class="card-title">Datengestütztes Tracking</h3>
                        <p class="card-text">Server-seitiger GTM & GA4-Dashboards liefern verlässliche Daten für dein Online-Marketing.</p>
                    </article>
                    <article class="card" role="listitem">
                        <h3 class="card-title">Ganzheitliche Strategie</h3>
                        <p class="card-text">Technik, Strategie und Texte aus einer Hand – flexibel für lokale Bedürfnisse und deinen digitalen Erfolg.</p>
                    </article>
                <?php endif; ?>
            </div>
        </section>
        
        <section id="hard-facts" class="section animate-on-scroll" aria-labelledby="facts-title">
            <h2 id="facts-title" class="section-title">
                <?php 
                $facts_headline = get_field('start_facts_headline');
                echo $facts_headline ? esc_html($facts_headline) : 'Hard Facts statt Testimonials';
                ?>
            </h2>
            
            <div class="card-grid facts-grid" role="list">
                <?php if(have_rows('start_facts_cards')): ?>
                    <?php while(have_rows('start_facts_cards')): the_row(); ?>
                        <article class="card facts-card" role="listitem">
                            <div class="facts-number">
                                <?php the_sub_field('number'); ?>
                            </div>
                            <p class="card-text">
                                <?php the_sub_field('text'); ?>
                            </p>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <article class="card facts-card" role="listitem">
                        <div class="facts-number">6+ Jahre</div>
                        <p class="card-text">Performance-Marketing-Praxis</p>
                    </article>
                    <article class="card facts-card" role="listitem">
                        <div class="facts-number">250.000 €</div>
                        <p class="card-text">Ad-Budget skaliert</p>
                    </article>
                    <article class="card facts-card" role="listitem">
                        <div class="facts-number">30× ROAS</div>
                        <p class="card-text">Pilot-Projekt</p>
                    </article>
                    <article class="card facts-card" role="listitem">
                        <div class="facts-number">100 %</div>
                        <p class="card-text">DSGVO-konformes Tracking</p>
                    </article>
                <?php endif; ?>
            </div>
        </section>
        
        <section id="prozess" class="timeline-section">
            <div class="timeline-container">
                <h2 class="section-title" style="color: var(--primary-50);">
                    <?php 
                    $prozess_headline = get_field('start_prozess_headline');
                    echo $prozess_headline ? esc_html($prozess_headline) : 'So wird dein Projekt zum Roadmovie';
                    ?>
                </h2>
                
                <div class="timeline-track">
                    <div class="timeline-progress"></div>
                </div>
                
                <div class="timeline-events">
                    <?php if(have_rows('start_prozess_steps')): ?>
                        <?php $step_counter = 1; while(have_rows('start_prozess_steps')): the_row(); ?>
                            <article class="timeline-step animate-on-scroll">
                                <span class="timeline-icon" aria-hidden="true">
                                    <?php echo $step_counter; ?>
                                </span>
                                <div class="timeline-card">
                                    <h3><?php the_sub_field('title'); ?></h3>
                                    <p><?php the_sub_field('text'); ?></p>
                                </div>
                            </article>
                        <?php $step_counter++; endwhile; ?>
                    <?php else: ?>
                        <article class="timeline-step animate-on-scroll">
                            <span class="timeline-icon" aria-hidden="true">1</span>
                            <div class="timeline-card">
                                <h3>Kick-off „Espresso & Ziele"</h3>
                                <p>30 Minuten Call – wir klären Ziel, Timeline und Next Steps für maximalen Impact.</p>
                            </div>
                        </article>
                        <article class="timeline-step animate-on-scroll">
                            <span class="timeline-icon" aria-hidden="true">2</span>
                            <div class="timeline-card">
                                <h3>Plot-Planung</h3>
                                <p>Individuelles Konzept mit Fahrplan und transparentem Fixpreis – ohne böse Überraschungen.</p>
                            </div>
                        </article>
                        <article class="timeline-step animate-on-scroll">
                            <span class="timeline-icon" aria-hidden="true">3</span>
                            <div class="timeline-card">
                                <h3>Dreh & Schnitt</h3>
                                <p>Modernes UI, starke UX, technisches SEO und Tracking – alles perfekt auf dein Ziel abgestimmt.</p>
                            </div>
                        </article>
                        <article class="timeline-step animate-on-scroll">
                            <span class="timeline-icon" aria-hidden="true">4</span>
                            <div class="timeline-card">
                                <h3>Premiere</h3>
                                <p>Feedback, Feinschliff und Go-Live – deine Website ist bereit für echte Wirkung.</p>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <section id="faq" class="section animate-on-scroll" aria-labelledby="faq-title">
            <h2 id="faq-title" class="section-title">
                <?php 
                $faq_headline = get_field('start_faq_headline');
                echo $faq_headline ? esc_html($faq_headline) : 'Häufige Fragen';
                ?>
            </h2>
            
            <div class="faq-container">
                <?php if(have_rows('start_faq_items')): ?>
                    <?php $faq_counter = 1; while(have_rows('start_faq_items')): the_row(); ?>
                        <div class="faq-item">
                            <input type="checkbox" id="faq-<?php echo $faq_counter; ?>" class="faq-checkbox">
                            <label for="faq-<?php echo $faq_counter; ?>" class="faq-question">
                                <?php the_sub_field('question'); ?>
                            </label>
                            <div class="faq-answer">
                                <?php the_sub_field('answer'); ?>
                            </div>
                        </div>
                    <?php $faq_counter++; endwhile; ?>
                <?php else: ?>
                    <div class="faq-item">
                        <input type="checkbox" id="faq-1" class="faq-checkbox">
                        <label for="faq-1" class="faq-question">Wie schnell bin ich live?</label>
                        <div class="faq-answer">Website in 3–4 Wochen, Shop in 4–8 Wochen (abhängig von Umfang und Integrationen).</div>
                    </div>
                    <div class="faq-item">
                        <input type="checkbox" id="faq-2" class="faq-checkbox">
                        <label for="faq-2" class="faq-question">Was kostet das?</label>
                        <div class="faq-answer">Websites ab 3.000 €, Shops ab 6.000 € – Fixpreis, klare Meilensteine.</div>
                    </div>
                    <div class="faq-item">
                        <input type="checkbox" id="faq-3" class="faq-checkbox">
                        <label for="faq-3" class="faq-question">Kann ich später selbst pflegen?</label>
                        <div class="faq-answer">Ja – du bekommst Video-Tutorials und ein intuitives Backend. Keine Entwicklerbindung.</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
        <section id="ueber-mich" class="section animate-on-scroll" aria-labelledby="about-title">
            <div class="about-container">
                <div class="about-image">
                    <?php $image = get_field('start_about_image'); if ($image): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             alt="<?php echo esc_attr($image['alt'] ?: 'Über mich Porträt'); ?>" 
                             width="300" 
                             height="300" 
                             loading="lazy"
                             decoding="async">
                    <?php endif; ?>
                </div>
                <div class="about-content">
                    <?php if ($headline = get_field('start_about_headline')): ?>
                        <h2 id="about-title"><?php echo esc_html($headline); ?></h2>
                    <?php else: ?>
                        <h2 id="about-title">Über mich</h2>
                    <?php endif; ?>
                    
                    <?php if ($text = get_field('start_about_text')): ?>
                        <?php echo wpautop(wp_kses_post($text)); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <section id="cta-kontakt" class="cta-section animate-on-scroll" aria-labelledby="cta-title">
            <?php if ($headline = get_field('start_cta_headline')): ?>
                <h2 id="cta-title"><?php echo esc_html($headline); ?></h2>
            <?php else: ?>
                <h2 id="cta-title">Bereit für dein Projekt?</h2>
            <?php endif; ?>
            
            <?php if ($description = get_field('start_cta_description')): ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            
            <div class="btn-group">
                <?php $button_p = get_field('start_cta_primary_button'); if ($button_p): ?>
                    <a href="<?php echo esc_url($button_p['url']); ?>" 
                       class="btn btn-primary" 
                       target="<?php echo esc_attr($button_p['target'] ?: '_self'); ?>"
                       <?php if($button_p['target'] === '_blank'): ?>
                           rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr($button_p['title']); ?> (öffnet in neuem Fenster)"
                       <?php endif; ?>>
                        <?php echo esc_html($button_p['title']); ?>
                    </a>
                <?php endif; ?>
                
                <?php $button_s = get_field('start_cta_secondary_button'); if ($button_s): ?>
                    <a href="<?php echo esc_url($button_s['url']); ?>" 
                       class="btn btn-secondary" 
                       target="<?php echo esc_attr($button_s['target'] ?: '_self'); ?>"
                       <?php if($button_s['target'] === '_blank'): ?>
                           rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr($button_s['title']); ?> (öffnet in neuem Fenster)"
                       <?php endif; ?>>
                        <?php echo esc_html($button_s['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </section>
    </main>
</div>

<script>
(function() {
    'use strict';
    
    // Performance-optimierte Funktionen
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Timeline Progress Animation
    function initTimelineProgress() {
        const timeline = document.querySelector('.timeline-progress');
        if (!timeline) return;
        
        const timelineWrapper = document.querySelector('.timeline-container');
        if (!timelineWrapper) return;
        
        const updateProgress = debounce(() => {
            const wrapperRect = timelineWrapper.getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            
            const start = wrapperRect.top;
            const end = wrapperRect.bottom;
            
            if (start < viewportHeight && end > 0) {
                const progress = (viewportHeight - start) / (viewportHeight + wrapperRect.height);
                const height = Math.min(100, Math.max(0, progress * 100));
                timeline.style.height = height + '%';
            }
        }, 16); // ~60fps
        
        window.addEventListener('scroll', updateProgress, { passive: true });
    }
    
    // Scroll Animations mit Intersection Observer
    function initScrollAnimations() {
        const animateElements = document.querySelectorAll('.animate-on-scroll');
        
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            animateElements.forEach(element => {
                observer.observe(element);
            });
        } else {
            // Fallback für ältere Browser
            animateElements.forEach(element => {
                element.classList.add('animated');
            });
        }
    }
    
    // Smooth Scrolling für Anchor Links
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);
                
                if (target) {
                    const offset = 140; // Angepasst an html scroll-padding-top
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL without jumping
                    if (history.pushState) {
                        history.pushState(null, null, targetId);
                    }
                    
                    // Focus management für Accessibility
                    setTimeout(() => {
                        target.focus();
                    }, 500);
                }
            });
        });
    }
    
    // Parallax Effekt für Hero (nur Desktop)
    function initParallax() {
        if (window.innerWidth < 768) return;
        
        const hero = document.querySelector('.hero-section');
        if (!hero) return;
        
        let ticking = false;
        
        function updateParallax() {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * -0.5;
                    hero.style.transform = `translateY(${rate}px)`;
                    ticking = false;
                });
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', updateParallax, { passive: true });
    }
    
    // Lazy Loading Fallback für ältere Browser
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) return;
        
        const images = document.querySelectorAll('img[loading="lazy"]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.src;
                    img.removeAttribute('loading');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
    
    // Keyboard Navigation Improvements
    function initKeyboardNavigation() {
        // Focus trap und bessere Tab-Navigation
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
    
    // Error Handling
    function handleErrors() {
        window.addEventListener('error', function(e) {
            console.warn('Startseite JS Error:', e.error);
        });
    }
    
    // Main Initialization
    function init() {
        initTimelineProgress();
        initScrollAnimations();
        initSmoothScrolling();
        initParallax();
        initLazyLoading();
        initKeyboardNavigation();
        handleErrors();
    }
    
    // DOM Ready Check
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Expose functions globally if needed
    window.StartseiteChampions = {
        init: init,
        initTimelineProgress: initTimelineProgress,
        initScrollAnimations: initScrollAnimations
    };
    
})();
</script>

<?php
// === ENDE DER STARTSEITE ===
// Zurück zu WordPress Theme
