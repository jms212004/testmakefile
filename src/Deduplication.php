<?php

namespace jms212004\testmakefile;

class Deduplication
{
    public function detectedDuplication($people): array
    {

        $deduplicated = [];

        foreach ($people as $person) {
            $hash = sha1($person["name"] . $person["email"]);
            if (!in_array($hash, $deduplicated)) {
                $deduplicated[] = $person;
            }
        }

        return $deduplicated;
    }
}
