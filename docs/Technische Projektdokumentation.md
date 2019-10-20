# Technische Projektdokumentation

Projektarbeit M152 Congiusta &amp; Friedli

In diesem Dokument wird die technische Umsetzung der im Kompetenzenraster verlangten Kompetenzen beschrieben.

# Kompetenz B3

Bei dieser Kompetenz geht es um die dynamische Optimierung der Multimedia-Inhalte für unterschiedliche Geräte, Betriebssysteme und Browser.

## Umsetzung

Das Bild wird, nachdem es von der Kamera abgeschickt wird in 2 Verschiedene JPEG-Qualitäten gespeichert. Wir benutzen die beiden Qualitäten indem die schlechtere zuerst angezeigt wird, mit einem Loader und danach, sobald das Bild geladen wurde, wird das Bild mit der besseren Qualität angezeigt. Wenn wir das Originalbild hätten anzeigen wollen, so hätte das Laden vom Bild fast 6 Sekunden gebraucht. Um dies zu umgehen haben wir das Bild um n Pixel verkleinert. Hiermit wird das Bild in etwa 170 Millisekunden geladen.

# Kompetenz B4

Die Multimedia-Inhalte werden auf unterschiedlichen Bildschirmgrössen korrekt angezeigt. (Responsive Web Design)

## Umsetzung

Wir haben für unser Frontend vue.js mit Vuetify verwendet. Das Component Framework Vuetify verfügt über die Möglichkeit, Webseiten sowohl auf einem Desktop als auch auf einem Mobile anzuzeigen. Somit sind diese Responsive.

# Kompetenz C2

Bei dieser Kompetenz geht es darum, dass Multimedia-Inhalte dynamisch mithilfe geeigneter Geräten, Bibliotheken, APIs oder über ein Formular in die Applikation erstellt werden. Zusätzlich wird beim Upload die Filegrösse beachtet und möglicherweise können Dateiformate eingeschränkt werden.

## Umsetzung

Um die Bilder zu verkleinern haben wir die Bibliothek «GD-Library» verwendet. Durch Methoden in der Library haben wir das Bild von der Kamera verkleinert.

# Kompetenz C3

Die generierten oder hochgeladenen Multimedia-Inhalte werden weiter verarbeitet, indem die Inhalte dynamisch verändert, kombiniert oder analysiert werden.

## Umsetzung

Einerseits werden die Bilder aus der Kamera direkt bevor diese auf der Webseite angezeigt werden verändert, indem diese verkleinert werden. Danach haben wir eine Funktion implementiert, welche die Farben des Fotos verändert. Das Bild wird somit zu einem Schwarz-Weiss-Bild.

# Kompetenz C4

Bei dieser Kompetenz geht es darum, dass auf die Usability der Webseite geachtet wird. Somit werden benutzerdefinierte Suche oder Filterfunktionen angeboten, wie beispielsweise Filter, Pagination oder Suche. Der Benutzer wird mit sinnvollen Meldungen durch alle Prozesse geleitet und HTML und CSS sind validiert.

## Umsetzung

Der Benutzer wird mit Meldungen über die ganze Seite geleitet. Die Buttons wurden so benennt, dass der Benutzer die Funktionen herauslesen kann.
