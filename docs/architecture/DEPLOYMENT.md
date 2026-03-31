# Deployment

Stand: 2026-03-31.

Diese Doku beschreibt nur den repo-seitigen CI/CD-Vertrag fuer das WordPress-Child-Theme. Hostseitige Details auf Raidboxes oder anderen Hosts muessen ausserhalb des Repos bestaetigt werden.

## Workflows

- `.github/workflows/ci.yml`
  - laeuft bei Push und Pull Request auf repo-relevante Aenderungen an Theme, Workflows, Skripten und Build-Dateien
  - prueft GitHub-Workflow-YAML mit `actionlint`
  - fuehrt PHP-Syntaxchecks fuer alle versionierten PHP-Dateien unter `blocksy-child/` aus
  - setzt Node 20 auf, installiert die gepinnten Build-Tools via `npm ci` und baut ein deploybares Theme-Paket unter `.build/blocksy-child`
- `.github/workflows/deploy.yml`
  - deployed nur nach erfolgreichem `CI`-Run fuer einen `push` auf `main`
  - kann optional manuell per `workflow_dispatch` gestartet werden
  - baut das Theme erneut in ein Dist-Verzeichnis und deployed weiterhin nur `blocksy-child/`
  - prueft SSH-Port und Deploy-Pfad vorab, testet die SSH-Verbindung und stellt sicher, dass der Zielpfad existiert oder angelegt werden kann
  - unterstuetzt bei manuellem Start einen `dry_run`, um `rsync` ohne Schreibzugriff zu pruefen

## GitHub Secrets und Variables

Empfohlen fuer dieses Repo:

- Secret `SSH_PRIVATE_KEY`
  - privater SSH-Key fuer den Deploy-User
- Variable `SSH_HOST`
  - Hostname oder IP des Zielservers
  - aus Kompatibilitaetsgruenden funktioniert auch weiter `secrets.SSH_HOST`
- Variable `SSH_USER`
  - SSH-Benutzer mit Schreibrechten auf dem Theme-Zielpfad
  - aus Kompatibilitaetsgruenden funktioniert auch weiter `secrets.SSH_USER`
- Variable `SSH_PORT`
  - optional
  - Fallback: `22`
- Variable `DEPLOY_PATH`
  - optional, aber fuer saubere Host-Abstraktion ausdruecklich empfohlen
  - Fallback: `www/wp-content/themes/blocksy-child/`
  - dieser Fallback stammt aus dem bisherigen Repo-Setup und ist kein universeller Raidboxes- oder WordPress-Standard
- Secret `SSH_KNOWN_HOSTS`
  - optional, aber empfohlen
  - enthaelt den geprueften Host-Key fuer striktere Host-Authentifizierung
  - wenn nicht gesetzt, faellt der Workflow auf `ssh-keyscan` zur Laufzeit zurueck

Praktisch bedeutet das:

- `SSH_HOST`, `SSH_USER`, `SSH_PORT` und `DEPLOY_PATH` am einfachsten als Repository-Variables unter `Settings -> Secrets and variables -> Actions -> Variables`
- `SSH_PRIVATE_KEY` und optional `SSH_KNOWN_HOSTS` als Repository- oder Environment-Secrets
- das GitHub-Environment `production` kann weiter fuer spaetere Freigaben oder Reviewer-Regeln genutzt werden, ist fuer die vier Konfigurationsvariablen aber nicht zwingend noetig

## Hostseitige Anforderungen

Diese Punkte sind aus dem Repo nicht verlaesslich ableitbar und muessen manuell bestaetigt werden:

- der echte SSH-Host, der echte SSH-Port und der korrekte Zielpfad auf Raidboxes
- ob der Deploy-User `mkdir -p` und `rsync` im Zielpfad ausfuehren darf
- ob der Zielpfad bereits existiert oder bei Bedarf angelegt werden darf
- welcher Host-Key als vertrauenswuerdig in `SSH_KNOWN_HOSTS` hinterlegt werden soll
- ob es produktive Besonderheiten wie Chroot, abweichende Webroot-Strukturen oder alternative Staging-Pfade gibt

## Rsync-Sicherheitsrahmen

- Deployt wird nur das gebaute Child-Theme-Paket, nicht WordPress-Core, Uploads oder Datenbankinhalt.
- `DEPLOY_PATH` wird vor dem Deploy validiert und muss auf ein Verzeichnis enden, das `blocksy-child` heisst.
- `rsync` laeuft mit `--delete-delay`, damit veraltete Dateien nur innerhalb des validierten Theme-Zielpfads entfernt werden.
- Ein manueller Dry-Run zeigt geplante Datei-Aenderungen, ohne den Server zu veraendern.

## Staging-Vorbereitung

Das Setup ist bewusst schlank, aber staging-faehig vorbereitet:

- das Deploy-Job nutzt bereits das GitHub-Environment `production`
- Host, User, Port und Pfad sind ueber Variables/Secrets abstrahiert
- ein spaeteres `staging`-Environment kann denselben Workflow-Vertrag mit eigenen Werten wiederverwenden

Aktuell nimmt das Repo absichtlich keine ungesicherten Annahmen ueber eine vorhandene Raidboxes-Staging-Struktur vor.
