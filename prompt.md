Erstelle ein vollständiges, professionelles Reward- und Glücksrad-Websystem (Paysafecard-Portal) von Grund auf neu, das folgende Eigenschaften und Features besitzt:

**1. User-System & Backend:**
- Keine externe Registrierung nötig, Nutzer erhalten automatisch einen Referral-Code (Session-basiert, kann für Upgrades per E-Mail erweitert werden).
- Alle Coins und Referral-Klicks werden ausschließlich in einer MySQL-Datenbank persistiert.
- Referral-Tracking funktioniert robust (Fingerprint & IP, pro Tag nur ein Klick je Gerät/Person, kein mehrfaches Farmen möglich).
- Coins werden nur per Backend (AJAX) gutgeschrieben und immer aus der Datenbank geladen, nie aus localStorage.
- Jeder relevante "Gewinn" (Glücksrad, Daily Bonus, Referral, TikTok-Bonus etc.) wird per API/DB eingebucht.

**2. Glücksrad:**
- Visualisierung mit p5.js, modern und smooth animiert.
- Das Rad ist farbenfroh und hochwertig (Pastellfarben, Schatten, Glow, große Icons/Emojis).
- Felder: 100 Coins 💰, 300 Coins 💰, 500 Coins 💰, 1.000 Coins 💰, 50 PSC 🛍️, Überraschung 🎉, Gute Laune 😄 – alles mit passendem Emoji.
- Die Labels stehen **im Segment** (nicht am Rand), Icon und Text sind gut lesbar (auch mobil).
- Das Rad stoppt immer exakt auf einem Feld, nie zwischen zwei Feldern.
- Nach dem Dreh wird der Gewinn klar und schön angezeigt (Popup und unter dem Rad).
- Gewinne werden sofort in die Datenbank gebucht.
- Button ist disabled während des Drehens.

**3. Daily Bonus:**
- 1x pro Tag abholbar, Info und Button auf der Startseite, alles serverbasiert.

**4. Referral-System:**
- Nutzer können ihren Referral-Code/Link einfach teilen (Copy-Button).
- Jeder echte Klick bringt Coins, wird in DB gezählt und live angezeigt ("Dein Link wurde X mal geklickt!").
- Keine Farm-Betrugsanfälligkeit (Fingerprint/IP/Datum-Check).
- Kettenbonus: Wird angezeigt (wenn ein geworbener Freund selbst jemanden wirbt).
- Referral-Klick-Anzahl wird in Echtzeit aktualisiert, auch nach Neuladen.

**5. TikTok-Bonus:**
- Einreichung des TikTok-Links per Formular, Coins nach Prüfung automatisch oder manuell gutschreiben.
- Bonus wird im Nutzerkonto angezeigt.

**6. Angebote-Tab:**
- Fake-Angebote (App testen, Umfrage, Spiel, Newsletter) mit schöner Card-Darstellung, Button simuliert Bonus (Frontend-Only, Coins werden gutgeschrieben).

**7. Auszahlung:**
- Coins können gegen PSC eingelöst werden (10€, 25€, etc.), Button triggert Coins-Abzug, Info "Auszahlung beantragt" und Hinweis auf Support/Prüfung.
- Auszahlung per E-Mail (nur Muster, kein echter Versand).

**8. Frontend & Design:**
- Komplett responsives, modernes UI im Stil von Revolut oder N26 (viel Weiß, Pastellfarben, Cards, große Buttons, Soft-Shadows, Icons).
- Header zeigt Logo, "PSC Rewards", Coins-Live-Balance.
- Navigation als modernes Bottom-Tabbar-Menü (mobilfreundlich).
- Alle Meldungen erscheinen als schönes Popup mittig und sind immer gut sichtbar.
- Konfetti-Animation (nur bei echten Gewinnen, nie bei normalen Infos).
- Alles ist barrierearm und für Mobilgeräte optimiert (große Touch-Flächen, kein Scroll-Zoom nötig).

**9. Codequalität & Struktur:**
- Saubere Struktur: index.php als Main, separate Templates für Tabs (home.php, wheel.php, offers.php, referral.php, tiktok.php, redeem.php), alle Styles in app.css, alle JS in main.js und wheel.js.
- Datenbanktabellen: referrals, referral_clicks, (optional: tiktok_entries, redemptions).
- Trennung von Logik und Design.
- Frontend-Komponenten sind wiederverwendbar und nach BEM oder ähnlichem Schema benannt.
- Keine unnötigen globalen Variablen im JS.
- Moderne, sichere PHP (prepared statements).
- Keine veralteten Techniken (kein jQuery, kein inline JS außer in Templates).

**10. Zusätzliche Verbesserungen:**
- Live-User-Anzeige (randomisiert).
- Trust-Elemente (SSL, Bewertungen, Support-Link).
- Footer mit Kontakt und Copyright.
- Alle bisherigen Fehler (Popup-Design, Rad stoppt auf Linien, Coins nicht gespeichert, Referral nicht gezählt, etc.) sind behoben.

**11. Was du liefern sollst:**
- Alle PHP-, CSS-, JS- und Template-Dateien, bereit zum Upload.
- Ein install.sql für die Datenbanktabellen.
- Alles muss ohne weitere Anpassung funktionieren (nur DB-Zugangsdaten anpassen).
- Keine Platzhalter, alles sofort nutzbar!

---

**Hinweis:**  
Nutze keine veralteten Lösungen, sondern modernste Web-Standards.  
Der Fokus liegt auf einer süchtig machenden, schnellen, hübschen und robusten Nutzererfahrung.  
Alle bisherigen Wünsche und Fehlerberichte aus dem bisherigen Chatverlauf sind in diesem Prompt zu berücksichtigen!
