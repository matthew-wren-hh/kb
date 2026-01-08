# Agent Instructions

Use this file as the primary style guide for edits in this repo. Keep changes aligned with these preferences.

## Writing Style
- Favor clarity and consistency over cleverness.
- Keep markup and styles easy to scan and maintain.
- Prefer small, purposeful edits over large rewrites.
- Accessibility is a top priority in every change.
- WCAG AA is the minimum; AAA is a nice-to-have when it does not add extra work.

## HTML
- Use semantic HTML elements where possible.
- Keep the structure clean and shallow; avoid unnecessary wrappers.
- Use minimal class names; avoid BEM-style naming.
- Avoid inline styles unless there is a strong reason.
- Keep IDs stable and predictable.
- Ensure proper headings, labels, focus order, keyboard access, and color contrast.

## CSS
- Favor CSS Grid over Flexbox when possible.
- Prefer a single clean CSS file for project styles.
- Remove unused selectors and consolidate duplicates.
- Avoid over-specific selectors and deep nesting.
- Keep class names short and descriptive.
- Prefer CSS variables for shared values (colors, spacing, type).
- Do not rely on CSS frameworks.
- Use CSS whenever possible before adding JavaScript.
- Prefer modern CSS (`:has()`, `:where()`, nesting) when support is solid across Chrome, Firefox, Safari, and mobile browsers; add a graceful fallback when needed.
- Keep styles consistent and clean.

## JavaScript
- Keep scripts minimal and scoped to the smallest necessary behavior.
- Avoid adding vendor-specific or third-party integrations unless requested.
- Do not rely on JavaScript frameworks.

## Vendor/Branding
- Do not add Cludo references or assets.
- Remove vendor artifacts if they are no longer used.

## Workflow Preferences
- If a change affects layout or structure, update only what is necessary.
- Ask before adding new dependencies or major refactors.
- If unsure about a preference, ask for clarification.
- Ensure `.gitignore` includes `.DS_Store` and CodeKit files.
- During development, keep each component in its own CSS file under a folder and use `@import url()` from the main stylesheet.
- For production/dist, combine and minify CSS assets.
