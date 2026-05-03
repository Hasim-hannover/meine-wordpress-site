const steps = [
  'Betrieb',
  'Region',
  'Angebot',
  'Budget',
  'Website',
  'Tracking',
  'Anfrageprozess',
  'Marktbild',
];

const checks = [
  'Keine Admin-Zugänge',
  'Keine Endkundendaten',
  'Leadkosten nur als Korridor',
  'E-Mail erst mit separater Zustimmung',
];

export function App() {
  return (
    <main className="readiness-shell" aria-labelledby="readiness-title">
      <section className="readiness-hero">
        <div className="readiness-kicker">Anfrage-System-Analyse</div>
        <h1 id="readiness-title">Prüfen, ob ein eigenes Anfrage-System wirtschaftlich Sinn macht.</h1>
        <p>
          Evidenzbasierter Fit-Check für passende Solar-, SHK- und Wärmepumpenbetriebe:
          Marktbild, Anfragepfad, Leadkosten-Korridor und klare Empfehlung für oder gegen die Umsetzung.
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
          <p>Route, Build und Tracking-Hooks stehen. Formularlogik, Consent und Submit folgen erst, wenn das Analyse-Angebot final formuliert ist.</p>
          <button type="button" disabled data-track-action="request_analysis_submit_disabled" data-track-category="lead_funnel" data-track-funnel-stage="request_analysis_submit_disabled">
            Analyse-Submit noch deaktiviert
          </button>
        </div>
      </section>
    </main>
  );
}
