# Codeblock
## What does Codeblock do?
Codeblock is a TYPO3 extension. It adds a content element to display source code
processed using highlight.php to render code snippets with syntax highlighting.
The CSS-classes applied are identical to what highlight.js would render, but the
transformation takes place on the server (instead of the browser when using JS).

The rendered result is cached like any other content element with the page in 
TYPO3. Using this extension you can skip adding hightlight.js to your JS-build. 
This helps reduce the JavaScript-size for your website and also allows rendering 
of source code snippets for AMP pages for example.

## Code Languages
The extension supports all code language that highlight.php supports. These can 
either be specified by choosing a setting inside the content element or 
detected automatically.

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
