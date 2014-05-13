Timber Sugar
============

Some bonus functionality for Timber. Install it in `wp-content/plugins` and activate via the WordPress admin. Featuring...

### `dummy`

Throw some dummy lorem ipsum where you need it...
```php
<h1>Some title</h1>
<div class="body">
	{{dummy(500)|wpautop}}
</div>
```
... this outputs 500 words of random lorem ipsum.

###### Use it as a filter
```php
<h1>{{post.title|dummy(15)}}</h1>
```
... this outputs 15 words of lorem ipsum _if_ post.title is empty

### `twitterify`

Take a string with @handles and #hashTags and make them links:

```php
<div class="my-tweet">
{{post.tweet|twitterify}}
</div>
```

Outputs...

```php
You should follow <a href="http://twitter.com/timberwp" target="_blank">@TimberWP</a>
if you love <a href="http://search.twitter.com/search?q=wordpress" target="_blank">#wordpress</a>
```