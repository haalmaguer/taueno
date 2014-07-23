<?php

namespace Prodi\SafetyBundle\Model;

interface AclManagerInterface
{

    public function addPermission($domainObject, $securityIdentity, $mask, $type = 'object', $installDefaults = true);
    
    public function revokePermission($domainObject, $securityIdentity, $mask, $type = 'object');
    
    public function deleteAclFor($domainObject);
}
