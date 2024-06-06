<?php
class Role extends Db {
    public function getAllRoles() {
        return $this->getTable("role");
    }
}
?>