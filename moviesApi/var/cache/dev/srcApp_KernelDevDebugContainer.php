<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerCAZmL9g\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerCAZmL9g/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerCAZmL9g.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerCAZmL9g\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerCAZmL9g\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'CAZmL9g',
    'container.build_id' => '11715bf5',
    'container.build_time' => 1584908054,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerCAZmL9g');
