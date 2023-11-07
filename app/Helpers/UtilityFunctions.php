<?php

use Composer\Semver\Intervals;
use Composer\Semver\VersionParser;

function isValidVersionConstraint($constraintString): bool
{
    $versionParser = new VersionParser();

    try {
        $constraint = $versionParser->parseConstraints($constraintString);
        Intervals::get($constraint);

        return true;
    } catch (\Exception $e) {
        return false;
    }
}
