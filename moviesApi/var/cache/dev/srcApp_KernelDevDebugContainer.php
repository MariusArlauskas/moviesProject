<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPgyXxRa\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPgyXxRa/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPgyXxRa.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPgyXxRa\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerPgyXxRa\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'PgyXxRa',
    'container.build_id' => '749490e7',
    'container.build_time' => 1586100433,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPgyXxRa');
