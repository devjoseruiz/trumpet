<?php

namespace app\core;

abstract class Migration
{
    abstract public function up();
    abstract public function down();
}