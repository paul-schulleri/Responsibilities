# Responsibilities Handler

This package can be used for tasks like handling multiple storage or caches.

You can find examples  in `src/Examples`. Each class will executed until one is found that can properly handle the call.

#### Example usage
```php
$assembler = new Assembler(
    new HandlerBuilder(), new HandlerList()
);

$assembler->run(
    'yourKey', 'ACME\\Responsibilities')
)
```
