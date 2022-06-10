##Installation
```composer require twin-elements/crud-logger```

in `services` add
```
<service id="TwinElements\Component\CrudLogger\CrudLogger">
    <argument id="security.token_storage"/>
    <argument id="logger"/>
    <tag name="monolog.logger" channel="crud"/>
</service>

<service id="TwinElements\Component\CrudLogger\CrudLoggerInterface" alias="TwinElements\Component\CrudLogger\CrudLogger"/>
```

in config
```
monolog:
    channels: ['crud']
    handlers:
        crud:
            type: stream
            level: info
            path: '%kernel.logs_dir%/crud.log'
            channels: ['crud']
```

###Usage
```
$this->crudLogger->createLog(Entity::class, CrudLogger::CreateAction, ID);
```
