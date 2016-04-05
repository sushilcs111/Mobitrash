<?php

$adminConstants = [

    'adminView' => 'admin.pages',
    'adminSystemUsersView' => 'admin.pages.acl.system_users',
    'adminRoleView' => 'admin.pages.acl.roles',
    'adminCityView' => 'admin.pages.masters.cities',
    'adminFrequencyView' => 'admin.pages.masters.frequency',
    'adminTimeslotView' => 'admin.pages.masters.timeslot',
    'adminServicetypeView' => 'admin.pages.masters.servicetype',
    'adminWastetypeView' => 'admin.pages.masters.wastetype',
    'adminFueltypeView' => 'admin.pages.masters.fueltype',
    'adminAdditiveView' => 'admin.pages.masters.additive',
    'adminRecordtypeView' => 'admin.pages.masters.recordtype',
    'adminSubscriptionView' => 'admin.pages.subscription',
    'adminScheduleView' => 'admin.pages.schedule',
    'adminAssetView' => 'admin.pages.assets',
    'adminRecordView' => 'admin.pages.record',
    'paginateNo' => 20
];


$frontendConstants = [
    'frontendView' => 'Frontend.pages',
];


return array_merge($frontendConstants, $adminConstants);
?>