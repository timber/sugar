# Timber Sugar

[![Build Status](https://img.shields.io/travis/timber/sugar/master.svg?style=flat-square)](https://travis-ci.org/timber/sugar)
[![Coverage Status](https://img.shields.io/coveralls/timber/sugar.svg?style=flat-square)](https://coveralls.io/r/timber/sugar?branch=master)

Some bonus functionality for Timber. Install it in `wp-content/plugins` and activate via the WordPress admin. Featuring...

### `dummy`

Throw some dummy lorem ipsum where you need it...
```html+django
<h1>Some title</h1>
<div class="body">
	{{dummy(500)|wpautop}}
</div>
```
... this outputs 500 words of random lorem ipsum.

###### Use it as a filter
```html+django
<h1>{{post.title|dummy(15)}}</h1>
```
... this outputs 15 words of lorem ipsum _if_ post.title is empty

### `twitterify`

Take a string with @handles and #hashTags and make them links:

```html+django
<div class="my-tweet">
{{tweet.content|twitterify}}
</div>
```

Outputs...

```html
You should follow <a href="http://twitter.com/timberwp" target="_blank">@TimberWP</a>
if you love <a href="http://search.twitter.com/search?q=wordpress" target="_blank">#wordpress</a>
```
