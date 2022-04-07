## IPA - BeeRes 
### Christopher O'Connor

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
