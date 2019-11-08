# Codeblock

## What does this extension do?

Codeblock is a TYPO3 extension. It adds a content type to display source code
processed using `highlight.php` to render code snippets with syntax highlighting.
The CSS-classes applied are identical to what highlight.js would render, but the
transformation takes place on the server (instead of the browser when using JS).

The rendered result is cached like any other content element with the page in 
TYPO3. Using this extension you can skip adding highlight.js to your JS-build. 
This helps reduce the JavaScript size for your website and also allows rendering 
of source code snippets for AMP pages for example.

## Code Languages

The extension supports all code languages that highlight.php supports. These can 
either be specified by choosing a setting inside the content element or 
detected automatically.

## Installation

Add this extension to your TYPO3 setup. Install using composer: `composer req b13/codeblock`.

Add the TypoScript to your site extensions setup:

`@import 'EXT:codeblock/Configuration/TypoScript/setup.typoscript'`

Add the PageTS (for adding the element to the New Content Element Wizard):

`@import 'EXT:codeblock/Configuration/PageTs/PageTs.tsconfig'`

If you want to use your own Fluid Template, add the Template Root Path to the setup like this:

`tt_content.codeblock.templateRootPaths.10 = EXT:your_site_extension/Resources/Private/Contenttypes/Templates`

### A note for Integrators:
If your Fluid Layout "Default" uses `<f:spaceless>` you should use a custom content type Fluid Template to avoid having
your frontend tabs/spaces missing for some parts. `Spacelesse` removes spaces between tags, and `highlight.php` can add
a series of `<span>foo</span> <span>bar</span>` strings that need the spaces between the tags to be readable and make
sense.

## Styles

CSS styling needs to be included manually. The classes added to the HTML output 
are generated automatically. Their styling need to be specified in a CSS file 
in order to add a custom styling. E.g. for JetBrain's darcula theme:

```
.hljs {
  display: block;
  overflow-x: auto;
  padding: 0.5em;
  background: #2b2b2b;
}

.hljs {
  color: #bababa;
}

.hljs-strong,
.hljs-emphasis {
  color: #a8a8a2;
}

.hljs-bullet,
.hljs-quote,
.hljs-link,
.hljs-number,
.hljs-regexp,
.hljs-literal {
  color: #6896ba;
}

.hljs-code,
.hljs-selector-class {
  color: #a6e22e;
}

.hljs-emphasis {
  font-style: italic;
}

.hljs-keyword,
.hljs-selector-tag,
.hljs-section,
.hljs-attribute,
.hljs-name,
.hljs-variable {
  color: #cb7832;
}

.hljs-params {
  color: #b9b9b9;
}

.hljs-string {
  color: #6a8759;
}

.hljs-subst,
.hljs-type,
.hljs-built_in,
.hljs-builtin-name,
.hljs-symbol,
.hljs-selector-id,
.hljs-selector-attr,
.hljs-selector-pseudo,
.hljs-template-tag,
.hljs-template-variable,
.hljs-addition {
  color: #e0c46c;
}

.hljs-comment,
.hljs-deletion,
.hljs-meta {
  color: #7f7f7f;
}
```

This extension uses `highlight.php` (see https://github.com/scrivo/highlight.php). 
This package includes [a lot of different CSS style themes](https://github.com/scrivo/highlight.php/tree/master/styles) you can use.
 
## License

As TYPO3 Core, _codeblock_ is licensed under GPL2 or later. See the LICENSE file for more details.

## Background, Authors & Further Maintenance

TYPO3 is highly configurable and it is easy to add custom content types to the system using a few lines of TCA 
configuration, a simple PageTS configuration to add the type to the list of elements in the New Content Element Wizard,
and a few lines of TypoScript and a Fluid Template. 
This extension adds a content type in the same way we create custom content types for our TYPO3 projects at 
[b13](https://b13.com).

`codeblock` was initially created by Andreas Hämmerl and David Steeb in 2019 for [b13, Stuttgart](https://b13.com). We 
use it to display source code in our blog on [b13.com](https://b13.com), where we have a full-AMP website and do not
include non-AMP JavaScript files.
