# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Laravel 11 + Livewire 3 (Jetstream/Fortify) application for managing residential buildings ("stambene zajednice") — fault tickets, notices, bills and resident e-mailing. Domain language, DB columns, UI text and comments are Serbian; keep new code in the same language.

## Commands

```bash
php artisan serve                 # dev server (project also runs under Laragon at the local vhost)
npm run dev                       # vite dev server
npm run build                     # REQUIRED for new Tailwind classes; public/build is committed to git

php artisan migrate               # apply migrations
php artisan tinker --execute="…"  # fastest way to verify a query/model change against the dev DB

php artisan test                                    # full suite
php artisan test --filter=RegistrationTest          # single test class/method
vendor/bin/pint                                     # code style (available, not enforced in history)
```

Tests are only the stock Jetstream/Fortify auth tests — there is no project-specific test coverage, so verify domain changes with `tinker` or in the running app.

## Architecture

### Page = route → wrapper view → Livewire component

Every route in [routes/web.php](routes/web.php) is a closure returning a thin blade view in `resources/views/{korisnik,upravnik}/` whose only job is to embed one Livewire component (`app/Livewire/{Korisnik,Upravnik}/…` + `resources/views/livewire/…`). All logic lives in the Livewire component; there are practically no controllers (only image/attachment streaming).

Adding a page means four things: route, wrapper view, Livewire class, Livewire view — **plus a DB row** (see below).

### Authorization is data-driven, not code-driven

The `userpremisions` middleware ([EnsureUserRoleIsAllowedToAccess](app/Http/Middleware/EnsureUserRoleIsAllowedToAccess.php)) resolves the current **route name** against the `stranicas` table and checks `user_stranica_prikazs` for the user's `user_tipId`. A route with no matching rows aborts 403 for everyone. The same tables drive the navigation menu (`User::userPozicijeList()`), with `show_in_menu` / `menu_order`.

Roles are integers on `users.user_tipId`, compared inline throughout the code: **1 = stanar (resident), 2 = upravnik (manager)**.

### Selected-building session state

- Resident: `User::getMyZgradeStanove()` puts `stanovi` / `zgrade` id collections into the session; components read them for visibility checks.
- Manager: works on **one building at a time**, stored in `upravnik_izabrana_zgrada_id` / `_name`. Set by the [IzborZgrade](app/Livewire/Upravnik/Komponente/IzborZgrade.php) selector or by dashboard buttons, read via [IzabranaZgrada](app/Actions/Zgrada/IzabranaZgrada.php).
- Changing it dispatches the Livewire event `promenjenaZgrada`; manager components subscribe with `#[On('promenjenaZgrada')]` and re-render.

Some components are shared by both roles — e.g. `Korisnik\KvarPregled` serves `/kvar-pregled` for residents *and* managers, branching on a `$this->upravnik` flag. Check that flag before adding role-specific behaviour there.

### Data conventions

- Foreign keys are camelCase and untyped: `zgradaId`, `userId`, `kvar_tiketId`, `tiket_statusId`. Migrations use plain `integer()` columns without FK constraints.
- Many-to-many links are "index" tables: `upravnik_zgrada_indices`, `user_stan_indices`, `obavestenje_zgrada_indices`, `sz_obavestenje_zgrada_indices`.
- Read queries usually favour the query builder with explicit `leftJoin`s (often `DB::raw(auth()->user()->id)` inside the join) over Eloquent relations; follow the surrounding style rather than rewriting it.
- Ticket status: `1` open, `2` closed, `3` deleted — lists filter `tiket_statusId < 3`.
- Pagination sizes come from `config('global.paginate')`, with per-table page names (e.g. `'tik'`).

### "Unseen" counters pattern

Parent rows carry denormalized counters (`kvar_tikets.tiket_br_komentara`, `obavestenjas.ob_broj_komentara`, `kvar_tikets.broj_slika`), and per-user tables record what that user has already seen:

| table | tracks |
| --- | --- |
| `kvar_komentar_user_views` | comments seen per ticket (`broj_vidjenih`) |
| `obavestenja_komentar_user_viewds` | comments seen per notice |
| `kvar_tiket_upravnik_views` | whether a manager ever opened a ticket (`prvi_pregled`, `poslednji_pregled`, `broj_pregleda`) |

Badges are computed as `counter - broj_vidjenih` (or `prvi_pregled IS NULL`), joined per user in the list query and aggregated per building on the manager dashboard ([Upravnik/Pocetna.php](app/Livewire/Upravnik/Pocetna.php)). Writes happen in the component that displays the item, via `updateOrCreate` / a model helper.

### E-mail subsystem

[EmailStanarimaSender](app/Actions/Zgrada/EmailStanarimaSender.php) has `send()` (many recipients, by building) and `sendToSingleUser()`. Both take a `$tip_id` (`email_obavestenja_tips`) that decides **who receives it** — recipients are filtered by their per-type subscription in `email_obavestenja_users`, editable in the profile. Every send is logged to `email_obavestenja_logs` + `email_user_send_logs` / `email_zgrada_send_logs`, which the UI displays. Attachments live on the `mail_attachments` disk; the mailable is `App\Mail\ObavestenjeStanarima`.

### Modals and images

Modals use `wire-elements/modal`: `$this->dispatch('openModal', 'modals.potvrdi-akciju-modal', [...])`, with components in `app/Livewire/Modals/`. Confirmations come back as Livewire events handled by `#[On('…')]` in the calling component.

Image URLs switch on `env('IMAGE_MANIPILATION')`: `'local'` streams through the `image.displayImage` route, otherwise `/storage/…` is used directly.

## Frontend notes

Tailwind 3 + Vite, and `public/build/assets/*` is committed. The build lags behind the blade files, so **check that a class already exists in the built CSS** (`grep` it in `public/build/assets/app-*.css`) or expect to run `npm run build` and commit the regenerated assets. Class names built dynamically (e.g. `text-{{ $p->prioritet_txt_collor }}`) are kept alive by a hidden safelist `<div>` at the bottom of the blade file — extend it when adding new dynamic colors.

## Release workflow

Version lives in `config/global.php` (`'version' => 'V x.y.z.w'`) and is shown in the footer. Each release bumps it, adds a `CHANGELOG.md` entry, and is committed straight to `main` with the version as the commit subject (`V 1.6.0.4`).

Production is a cPanel deploy ([.cpanel.yml](.cpanel.yml)) that copies the repo; migrations and any one-off SQL backfills in `database/sql/` are run manually after deploying.
