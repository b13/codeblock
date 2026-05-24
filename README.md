# Code Block

A TYPO3 content element for displaying source code with server-side syntax
highlighting via [highlight.php](https://github.com/scrivo/highlight.php).
The rendered output is cached with the content element, so no JavaScript runs
in the browser to colour the code.

We use this extension to render the code snippets on our own blog at
[b13.com](https://b13.com).

## Requirements

| Code Block | TYPO3      | PHP   |
| ---------- | ---------- | ----- |
| 3.x        | 13.4, 14.x | 8.2+  |
| 2.x        | 10.4 – 14  | 7.4 – 8.x |

Version 3 drops support for TYPO3 11 and 12 and is delivered as a Site Set.
If you are on an older TYPO3, stay on the 2.x branch.

## Installation

Install via Composer:

```
composer require b13/codeblock
```

Assign the **`b13/codeblock` Site Set** to your site configuration (Sites
module → Edit site → tab *Sets for this Site*). That registers the content
element, its wizard entry, and the TypoScript rendering. No `@import` of
TypoScript or PageTSconfig from your site extension is needed.

If you want to ship the Set automatically with your own site set, depend on
it from your site set's `config.yaml`:

```yaml
dependencies:
  - b13/codeblock
```

## Using your own Fluid template

Add a higher-priority template root path in your site set's TypoScript:

```typoscript
tt_content.codeblock.templateRootPaths.10 = EXT:your_site/Resources/Private/ContentElements/Codeblock/Templates
```

The template receives `bodytext_formatted.code`, `bodytext_formatted.language`,
and `bodytext_formatted.lines`.

### Heads up: whitespace and `<f:spaceless>`

`highlight.php` emits markup like `<span>foo</span> <span>bar</span>` where
the spaces between tags are part of the rendered code. If your `Default`
Fluid layout wraps everything in `<f:spaceless>`, those spaces collapse and
the output gets unreadable. Either drop `<f:spaceless>` for this element or
ship a dedicated Fluid layout for `codeblock`.

## Styles

The HTML classes match what highlight.js produces, so any
[highlight.js stylesheet](https://github.com/scrivo/highlight.php/tree/master/styles)
works. Include the stylesheet of your choice from your own site extension —
the extension itself ships no CSS. A minimal dark-on-dark example:

```css
.hljs              { display: block; overflow-x: auto; padding: 0.5em;
                     background: #2b2b2b; color: #bababa; }
.hljs-comment,
.hljs-deletion,
.hljs-meta         { color: #7f7f7f; }
.hljs-keyword,
.hljs-selector-tag { color: #cb7832; }
.hljs-string       { color: #6a8759; }
```

## License

GPL-2.0-or-later, in line with TYPO3 Core. See `LICENSE`.

## Background

`EXT:codeblock` was originally written by Andreas Hämmerl and David Steeb in
2019 for [b13, Stuttgart](https://b13.com). The walk-through of how this
extension is built — and why we still ship "core-near" content elements
instead of relying on third-party builders — is on our blog:

- [How to create custom content elements in TYPO3 (v14)](https://b13.com/blog) — *upcoming*
- [How to Create Custom Content Elements in TYPO3](https://b13.com/blog/how-to-create-custom-content-elements-in-typo3) — *2020, kept for reference*

[More TYPO3 extensions we maintain](https://b13.com/useful-typo3-extensions-from-b13-to-you).
