<?php

namespace panel\components;

use panel\models\Auth;

class AccessRule extends \yii\filters\AccessRule {

    /**
     * @inheritdoc
     */
    protected function matchRole($username)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role == '?') {
                if ($username->getIsGuest()) {
                    return true;
                }
            } elseif ($role == Auth::LEVEL_USER) {
                if (!$username->getIsGuest()) {
                    return true;
                }
            // Check if the username is logged in, and the roles match
            } elseif (!$username->getIsGuest() && $role == $username->identity->level) {
                return true;
            }
        }

        return false;
    }
}
