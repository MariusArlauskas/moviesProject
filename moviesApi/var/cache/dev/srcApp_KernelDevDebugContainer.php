<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerJFR5tzj\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerJFR5tzj/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerJFR5tzj.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerJFR5tzj\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerJFR5tzj\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'JFR5tzj',
    'container.build_id' => 'b897a797',
    'container.build_time' => 1587583451,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerJFR5tzj');
