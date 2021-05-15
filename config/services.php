<?php

use App\Service\FileReader\FileReaderInterface;
use App\Service\FileReader\TextFileReader;
use App\Service\FileUploader\FileUploaderInterface;
use App\Service\FileUploader\TextFileUploader;
use App\Service\Storage\FileStorage;
use App\Service\Storage\FileStorageInterface;
use Psr\Container\ContainerInterface;


return [
    FileStorageInterface::class => function (ContainerInterface $container) {
        return new FileStorage($container);
    },
    FileUploaderInterface::class => function (ContainerInterface $container) {
        return new TextFileUploader($container);
    },
    FileReaderInterface::class => fn () => new TextFileReader(),
];