# Testspezifikation

| **Projekt:** | FotiBox |
| --- | --- |
| **Modul:** | 152 |
| **Autor:** | Simon Friedli, Vincenzo Congiusta |
| **Version:** | 1.1 |
| **Letzte Änderung:** | 21.10.2019 |



# Testbeschreibung

Für unsere Applikation werden in der Testspezifikation sowohl funktionale als auch nicht-funktionale Testfälle beschrieben. Durch diese Tests können Schwachstellen im Programmcode ermittelt und dieser überarbeitet werden, falls die Ergebnisse nicht den Erwartungen entsprechen.

# Funktionale Tests (1.n)

Es werden Programmfunktionen getestet, welche relevant für die Funktionalität der Applikation sind.

## Testfall 1:

| **ID** | 1.1 |
| --- | --- |
| **Testziel** | Bild kann geschossen werden |
| **Vorbedingungen** | Eine Kamera ist am Rapsberry angeschlossen |
| **Beschreibung** | Die Kamera soll über einen Button Klick ein Bild schiessen können. |
| **Erwartetes Ergebnis** | Das Bild ist in der Gallery sichtbar und ein Eintrag in der Datenbank ist ersichtlich |

## Testfall 2:

| **ID** | 1.2 |
| --- | --- |
| **Testziel** | Gallery zeigt alle Bilder und Bild kann einzeln angezeigt werden um es zu bearbeiten |
| **Vorbedingungen** | Es wurden bereits Bilder geschossen. |
| **Beschreibung** | Beim Klicken auf einem Bild erscheint ein Overlay mit einem Button, um den Schwarz/Weiss-Filter zu setzen. |
| **Erwartetes Ergebnis** | Overlay öffnet sich, Bild wird einzeln angezeigt und Button um Filter zu setzen steht zur Verfügung. |

## Testfall 3:

| **ID** | 1.3 |
| --- | --- |
| **Testziel** | Wenn Kamera offline ist, oder keine angeschlossen ist, funktioniert Schuss-Button nicht und es erscheint eine Meldung |
| **Vorbedingungen** | - |
| **Beschreibung** | Auf der Maske, bei der ein Foto ausgelöst werden kann wird eine Meldung angezeigt, welche erklärt, dass keine Kamera angeschlossen ist. |
| **Erwartetes Ergebnis** | Es kann kein Bild geschossen werden, weil der Button disabled ist. Eine Meldung mit einer Erklärung wird angezeigt. |

## Testfall 4:

| **ID** | 1.4 |
| --- | --- |
| **Testziel** | Bild kann verändert werden mit Schwarz/Weiss Filter |
| **Vorbedingungen** | Es wurde bereits ein Bild geschossen, man befindet sich in der Gallery. |
| **Beschreibung** | Mit einem Klick auf dem Bild erscheint ein Button welcher ermöglicht, dass ein Schwarz/Weiss-Filter gesetzt wird |
| **Erwartetes Ergebnis** | Nach dem Klick auf dem Button wird das Bild in Schwarz/Weiss-Töne gespeichert. |

## Testfall 5:

| **ID** | 1.5 |
| --- | --- |
| **Testziel** | Es kann nach Bild gefiltert werden |
| **Vorbedingungen** | Es gibt mehrere Bilder in der Gallery und diese sollen sowohl farbig als auch monoton sein. Einige sind schwarz/weiss und andere farbig. |
| **Beschreibung** | TODO |
| **Erwartetes Ergebnis** | Die Bilder werden nach ihrer Farbtöne gefiltert. Sprich wenn der Filter auf schwarz/weiss gesetzt ist, so werden nur die Bilder angezeigt, welche nur diese zwei Farben zeigen. |



# Nicht-Funktionale Tests (2.n)

Es werden sowohl Usability als auch Konsistenz der Daten getestet. Ebenfalls wird geprüft, ob die Applikation auf verschiedenen Plattformen laufen kann (Plattformunabhängigkeit). Grundsätzlich entsprechen die nicht-funktionalen Tests den nicht-funktionalen Anforderungen des Benutzers. Wir haben uns für folgende Testfälle entschieden:

## Testfall 1:

| **ID** | 2.1 |
| --- | --- |
| **Testziel** | Ein Benutzer findet sich einfach zurecht auf der Website. |
| **Vorbedingungen** | - |
| **Beschreibung** | Hier wird die Usability geprüft. Ein Benutzer (Kein Entwickler der Webapplikation) soll sich ohne Anleitung auf der Webseite zurechtfinden und die funktionalen Tests eigenhändig durchführen können. |
| **Erwartetes Ergebnis** | Der Benutzer findet sich von allein zurecht. |

## Testfall 2:

| **ID** | 2.2 |
| --- | --- |
| **Testziel** | Die Werte in der Datenbank stimmen mit den Werten der Webapplikation überein. |
| **Vorbedingungen** | - |
| **Beschreibung** | Auf der Webseite werden ohne Ausnahme dieselben Werte dargestellt, wie sie in der Datenbank stehen. |
| **Erwartetes Ergebnis** | Die Werte auf der Webseite stimmen mit diesen aus der DB überein. |

## Testfall 3:

| **ID** | 2.3 |
| --- | --- |
| **Testziel** | Die Webapplikation kann über alle Webbrowser gestartet werden. |
| **Vorbedingungen** | Der Anwender muss mindestens einen Webbrowser installiert haben. |
| **Beschreibung** | Ein Anwender kann die Webapplikation mit jedem Webbrowser starten. |
| **Erwartetes Ergebnis** | Die Webseite wird mit jedem Webbrowser korrekt dargestellt. |

## Testfall 4:

| **ID** | 2.4 |
| --- | --- |
| **Testziel** | Die Webapplikation kann über alle Webbrowser angewendet werden. |
| **Vorbedingungen** | Der Anwender muss mindestens einen Webbrowser installiert haben. |
| **Beschreibung** | Der Anwender kann sämtliche funktionalen Tests mit jedem beliebigen Webbrowser fehlerfrei durchführen. |
| **Erwartetes Ergebnis** | Die funktionalen Anforderungen werden unabhängig von der Wahl des Webbrowsers korrekt ausgeführt. |
