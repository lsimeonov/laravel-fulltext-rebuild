## About
This is a simple library for laravel that helps you rebuild INNODB fulltext indexes for MySQL. 
This is useful when you change `innodb_ft_min_token_size` property. 
You can find more info about MySQL fulltext index length [here](https://dev.mysql.com/doc/refman/5.7/en/fulltext-fine-tuning.html#fulltext-word-length)

**Always backup your database before doing manipulations to it.**

## Usage
You must include the library service provider inside `config/app.php`
```php
$providers = [
    ...
    Ucaka\FullTextRebuild\Providers\FullTextRebuildProvider::class,
]
```

The only thing that a service provider will do for you is register a command.
If you prefer you can skip the provider and directly add the command 
`\Ucaka\FullTextRebuild\Console\Commands\FullTextRebuild` inside your `app/Console/Kernel.php`

After you installed the command just run it
```bash
php artisan mysql:fulltext:rebuild
```

If it's needed you can specify custom database connection with `--connection` or `-c` option

```bash
php artisan mysql:fulltext:rebuild -c "custom_connection"
```