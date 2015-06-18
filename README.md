# php-mojo-helpdesk
PHP Implementation of the Mojo Helpdesk API

Include the autoload file. 

```php
include('autoload.php
```

Tickets Methods:

Get List of Tickets

```php
$tickets = new Tickets($key,$url);
$allTickets = $tickets->ListAllTickets();
```