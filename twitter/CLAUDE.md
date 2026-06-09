# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

TwITter is the **Abschlussprojekt** (final project) of ÜK M295 — a Laravel 13 REST API (PHP 8.4+, runs on 8.5). It ships as a near-empty skeleton: only the `User` model exists. **The tests in `tests/Feature/` are the spec.** Each test file is named after a task code from the course (C1, C2, D1–D3, E1–E4, F1–F6, G1–G6, H1, I1). Implementation work means making those tests pass; do not edit the tests to fit the code.

## Commands

```bash
php artisan test                          # run the whole spec
php artisan test --filter=G4Test          # run one task's tests
php artisan test tests/Feature/E2Test.php # run one file
php artisan migrate:fresh --seed          # rebuild SQLite DB + seed
./vendor/bin/pint                         # format (Laravel Pint)
php artisan serve                         # local API server
```

Every test uses `RefreshDatabase` with `protected $seed = true`, so **`DatabaseSeeder` must populate the DB** (currently empty — seeding Users + Tweets via factories is part of task D). Tests run on in-memory SQLite (`phpunit.xml`); the local app uses the `database/database.sqlite` file.

## API surface the spec requires

Routes go in `routes/api.php` (auto-prefixed `/api`, registered via `bootstrap/app.php`). Auth is Laravel Sanctum (token-based, `auth:sanctum` middleware).

Public:
- `GET /api/tweets` — paginated, **max 100**, newest first, **no N+1** (E2 asserts exactly 3 queries, or 4 if a `User::likedTweets()` relation exists). Each item exposes only `id, text, likes, created_at` + nested `user{id,name,email,created_at}`; `user_id`/`updated_at`/`email_verified_at` must be hidden. `created_at` must be ISO-8601 (`toIso8601String()`).
- `GET /api/users/{id}` — UserResource: `id, name, email, created_at, is_verified`.
- `GET /api/users/{id}/tweets` — paginated, **max 10**, only that user's tweets.
- `POST /api/login` — returns `{ "token": "<plaintext>" }`; `422` on invalid credentials.

Sanctum-protected (`401` without token):
- `GET /api/auth` and `GET /api/me` — current user resource.
- `POST /api/logout` — returns `{ "message": ... }`, revokes token.
- `POST /api/tweets` — creates a tweet for the authed user; text validation **2–160 chars** (G2).
- `PUT /api/me` — update name/email/password; password must be hashed; invalid email → `422`.
- `DELETE /api/me` — deletes the user and **cascades their tweets** (G6 → `onDelete('cascade')` on the FK).
- `POST /api/tweets/{id}/like` — increments `likes` by 1.

`is_verified` (I1) is a computed UserResource attribute: `true` when the user's tweet likes cross the threshold — the test treats **80001 → true, 79999 → false**.

## Things to know

- Use API Resources (`app/Http/Resources/`) for all JSON shaping — tests assert exact structure and assert *absence* of leaked fields. `G3Test` compares against `UserResource::make(...)->resolve()` directly.
- `routes/web.php` has a fallback that returns JSON `404` for `/api/*` paths and serves `public/index.html` otherwise (SPA-style).
- This is a fresh prepared base (Laravel 13 / PHP 8.4) with no PHP 8.5 deprecation workarounds and no Telescope — it's a clean skeleton, so a baseline `php artisan test` passes only 3 tests; the rest fail as "not implemented" until you build the models, controllers, routes, and resources.

The broader course context lives in the parent repo's `../CLAUDE.md` and `../UEK.md`.
