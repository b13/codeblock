# Changelog

## 3.0.0 — Cleanup release for TYPO3 v13 and v14

### Breaking

- **Drops support for TYPO3 10, 11, and 12.** Minimum is now TYPO3 13.4.
- **Requires PHP 8.2 or newer.**
- **Delivery is now a Site Set.** Assign `b13/codeblock` to your site
  (Sites module → tab *Sets for this Site*) instead of `@import`-ing
  `EXT:codeblock/Configuration/TypoScript/setup.typoscript` and
  `EXT:codeblock/Configuration/PageTs/PageTs.tsconfig`. The legacy file
  paths no longer exist.

### Removed

- `ext_tables.sql` — the `code_language` column is now auto-created from
  the TCA definition (TYPO3 v13+ feature).
- `ext_localconf.php` — the pre-v12 `tt_content_drawItem` hook and the
  manual `IconRegistry` registration are gone. The icon is registered via
  `Configuration/Icons.php`.
- `Classes/Hooks/CodeblockPreviewRenderer.php` — relied on the
  `PageLayoutViewDrawItemHookInterface`, which was removed in TYPO3 v12.
- `Classes/Listener/PageContentPreviewRendering.php` — preview truncation
  now happens inside `ContentPreviewRenderer::renderPageModulePreviewContent()`,
  so the separate event listener is no longer needed.
- `Configuration/PageTs/PageTs.tsconfig` and
  `Configuration/TypoScript/setup.typoscript` — moved into the Site Set.

### Changed

- `HighlightProcessor` and `CodeLanguages` now get their `Highlighter`
  instance via constructor injection (autowired through `Services.yaml`).
- `HighlightProcessor` fixes the auto-detect default for the
  `code_language` field. The previous `?? true` default unintentionally
  skipped auto-detection when the field was unset.
- `ContentPreviewRenderer` truncates the bodytext for the page-module
  preview with `mb_strimwidth()` instead of the deprecated
  `GeneralUtility::fixed_lgd_cs()`.
- TCA `CType` registration now includes a `description` and `group`, so
  the New Content Element Wizard picks it up correctly under the
  *default* group on TYPO3 13 and 14.
- GitHub Actions workflow refreshed: `ubuntu-latest`, `actions/checkout@v4`,
  PHP 8.2, `$GITHUB_OUTPUT` syntax.

## 2.1.0 and earlier

See git history.
