SmsApi
==================
Bardzo prosty interfejs do wysyłania wiadomości tekstowych

Bilbioteka obsługuje 
- wysyłanie widomości SMS
 
Obsługiwani dostawcy
- TODO SMSapi.pl

###I. Instalacja

```
composer require solvenfinance/smsapi
```

###II. API
####1. Konfiguracja adaptera 

```php
use SmsApi\SmsApi;

SmsApi::setAdapter(new SmsApiAdapter([
 // ... config in here
]));

```

####2. Wysłanie SMS


```php
use SmsApi\SmsApi;
use SmsApi\Message\TextMessage;
use SmsApi\ValueObject\PhoneNumber;
use SmsApi\ValueObject\StringValue;

SmsApi::send(
    new TextMessage(
        PhoneNumber::fromNative(600700800),
        StringValue::fromNative("Hello, recipient. How are you?"),
        StringValue::fromNative("Solven.pl"),
    );
);
```

Copyright: Solven Finance sp z o. o.
