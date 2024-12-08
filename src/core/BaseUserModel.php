<?php

namespace app\core;

abstract class BaseUserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}