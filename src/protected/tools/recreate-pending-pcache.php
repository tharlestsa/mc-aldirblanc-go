<?php
set_time_limit(0);
ini_set('memory_limit', '2048M');
unset($_ENV['LOG_HOOK']);
require __DIR__ . '/../application/bootstrap.php';

echo "\nCRIANDO OS CACHES DE PERMISSÃO PENDENTES\n";

MapasCulturais\App::i()->recreatePermissionsCache();
MapasCulturais\App::i()->em->getConnection()->close();