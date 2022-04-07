# IPA - BeeRes

## Ausgangssituation
Die Einsatzzentrale erhält jährlich fälschlicherweise mehrere Hundert Anrufe bezüglich Bienenschwarmentfernungen. Diese werden mit einem grossen manuellen Mehraufwand an lokale Imker übergeben. Es ist eine Applikation gewünscht, mit welcher sich Imker als freiwillige Helfer registrieren können. Bei einem künftigen Einsatz soll mit der Übermittlung der Geodatenlokalisation autonom die nächstgelegenen Imker ausfindig gemacht und aufgeboten werden via SMS.

## Umsetzung
Bei der Applikation handelt es sich um eine PHP-Webapplikation, welche das Framework Laravel verwendet. Als relationale Datenbank wurde MariaDB vom Programm XAMPP verwendet sowie dessen Apache Web Server. Das von Laravel verwendete ORM Eloquent dient als Schnittstelle zwischen den Models und der Datenbank. Das Projekt ist nach MVC gegliedert. Die Views werden von der Template-Engine Blade zusammengesetzt und fürs Frontend gerendert. Jegliche Kontrollstrukturen sowie Benutzereingaben werden in den entsprechenden Controllern gehandhabt und Daten an die Views übergeben. Die rollenbasierte Berechtigung wurde mittels mehrerer Middlewares umgesetzt in den Routes. Formulareingabefelder wurden mittels Components erstellt. Dadurch sind die Formulare sehr übersichtlich und jegliche HTML- und CSS Eigenschaften sowie die Fehleranzeige im Component ausgelagert. SMS-Notifikationen werden mittels Vonage dem Imker versendet. Notifikationen werden beim Erstellen einer Queue hinzugefügt, diese wird von einem Queue-Worker Parallel zur Applikation abarbeitet. Beim Google Maps Pin handelt es sich um eine URL, welche ein Pin an der Longitude und Latitude des Auftragsort setzt. Die gesuchte PLZ wird mittels der API von Nominatim aus der Geodatenlokalisation des Auftrags ausfindig gemacht.

## Ergebnis
Imker können sich mit ihren Kontaktinformationen Registrieren und ihre zuständigen Regionen auswählen. Die Mitarbeiter der Einsatzzentrale können einen neuen Auftrag erstellen. Dabei geben sie die Geolokalisation in Form von Latitude und Longitude an und allfällige Zusatz Informationen wie Kontaktangaben und Details zum Auftrag. Die Applikation ermittelt die repräsentative PLZ des Auftrags durch eine API-Abfrage von Nominatim. Sollte diese nicht funktioniert haben, wird der Mitarbeiter aufgefordert, die PLZ manuell anzugeben. Anschliessend werden Imker falls möglich, welche direkt zuständig sind für diese Region, ansonsten die Nächstgelegenen per SMS benachrichtigt mit der PLZ sowie einer URL zur Auftragsannahme. Dem Imker, welcher als erstes den Auftrag annimmt, erhält die zusätzlichen Infos in der Auftragsübersicht. Die zusätzlichen Infos sowie ein Google Maps Pin des genauen Auftragortes werden zusätzlich ihm per SMS übermittelt.

## Installation

### Installations voraussetzungen

- XAMPP mit php v7.4
- Composer v2
- git
- Nexmo Konto (Key & Secret) für das Versenden von SMS

### Konsole öffnen und folgende Befehle ausführen:

- `cd C:\xampp\htdocs`
- `git clone`
- `cd`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- Leere Db erstellen und .env ergänzen
  - DB_DATABASE=
  - NEXMO_KEY=
  - NEXMO_SECRET=
- `php artisan migrate:fresh --seed`

### Default Information
- Default S&R Login = admin@admin.ch
- Default Beekeeper = jon@doe.ch
- Passwort von allen = password

### Tipps und Bugs

Um die Datenbank zu leeren und die Migrations und den Seeder auszuführen:
- `php artisan migrate:fresh --seed`

Falls Seeder nicht erkannt werden hilft:
- `composer dump-autoload`
