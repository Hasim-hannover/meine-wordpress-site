const steps = [
  'Betrieb',
  'Region',
  'Budget',
  'Website',
  'Tracking',
  'CRM',
  'Anfragen',
  'Befund',
];

const checks = [
  'Keine Admin-Zugänge',
  'Kein Klarname im Default-Pfad',
  'Keine Telefonnummer im Default-Pfad',
  'E-Mail erst mit separater Zustimmung',
];

export function App() {
  return (
    <main className="readiness-shell" aria-labelledby="readiness-title">
      <section className="readiness-hero">
        <div className="readiness-kicker">Readiness-Diagnose</div>
        <h1 id="readiness-title">Der bezahlte Einstieg in Ihr Anfrage-System.</h1>
        <p>
          14 Tage, formulargetrieben, ohne Admin-Zugänge. Am Ende steht ein schriftlicher Befund mit Ampel und klarer Empfehlung.
        </p>
      </section>

      <section className="readiness-panel" aria-labelledby="readiness-steps-title">
        <div className="readiness-panel__head">
          <h2 id="readiness-steps-title">Formularstruktur</h2>
          <span>8 Schritte</span>
        </div>

        <ol className="readiness-steps">
          {steps.map((step, index) => (
            <li key={step}>
              <span>{String(index + 1).padStart(2, '0')}</span>
              {step}
            </li>
          ))}
        </ol>
      </section>

      <section className="readiness-grid" aria-label="Datenschutz und Status">
        <div className="readiness-card">
          <h2>Privacy-Default</h2>
          <ul>
            {checks.map((check) => (
              <li key={check}>{check}</li>
            ))}
          </ul>
        </div>

        <div className="readiness-card readiness-card--accent">
          <h2>Stub-Status</h2>
          <p>Route, Build und Tracking-Hooks stehen. Formularlogik, Consent und Submit folgen im nächsten Block.</p>
          <button type="button" disabled data-track-action="readiness_submit_disabled" data-track-category="lead_funnel" data-track-funnel-stage="readiness_submit_disabled">
            Submit noch deaktiviert
          </button>
        </div>
      </section>
    </main>
  );
}
