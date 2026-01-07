# KB Redesign Sandbox

This repo is a personal sandbox for testing redesigns and content tweaks for the Cascade CMS knowledge base pages.

## What this is for
- Fast iteration on KB page layout, styling, and content experiments.
- Local-only testing before anything is moved into Cascade.

## Quick start
1. Open any HTML file at the repo root in your browser (double-click).
2. Edit CSS in `assets/css/` and refresh.
3. Keep assets relative (e.g., `./assets/css/...`) so files work from disk.

## File layout
- HTML pages live at the repo root.
- Shared CSS/JS/images live in `assets/`.
- `main-site/` contains source snapshots or reference assets from the public site.

## Conventions
- Prefer local asset paths over external links.
- Keep filenames human-readable; this repo mirrors KB page naming.
- Avoid production-only dependencies; this is a standalone sandbox.

## Notes
- The goal is quick iteration, not production readiness.
