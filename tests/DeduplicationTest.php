<?php

declare(strict_types=1);

namespace jms212004\test\Tests;

use jms212004\testmakefile\Deduplication;
use PHPUnit\Framework\TestCase;

class DeduplicationTest extends TestCase
{
    private array $peopleDontDuplicated = [
        ["name" => "John", "email" => "john@example.com"],
        ["name" => "Jane", "email" => "jane@example.com"],
        ["name" => "Bob", "email" => "bob@example.com"],
    ];

    private array $peopleDuplicated = [
        ["name" => "John", "email" => "john@example.com"],
        ["name" => "Jane", "email" => "jane@example.com"],
        ["name" => "John", "email" => "john@example.com"],
        ["name" => "Bob", "email" => "bob@example.com"],
        ["name" => "Jane", "email" => "jane@example.com"],
    ];

    public function testDeduplicationIsNotValid()
    {
        // Call function detectedDuplication
       $deduplicated = (new Deduplication)->detectedDuplication($this->peopleDuplicated);

        // verify that the number of people in the result array is not equal to the number of people in the
        // original array.
        $this->assertNotCount(count(array_unique($this->peopleDuplicated, SORT_REGULAR)), $deduplicated);


        // Verify that each person in the result array isn't present in the original array.
        foreach ($deduplicated as $person) {
            $this->assertContains($person, $this->peopleDuplicated,"doesn't  contains value as value");
        }
    }

    public function testDeduplicationIsValid()
    {
        // Call function detectedDuplication
        $deduplicated = (new Deduplication)->detectedDuplication($this->peopleDontDuplicated);

        // Verify that the number of people in the result array is equal to the number of unique people in the
        // original array.
        $this->assertCount(count(array_unique(array: $this->peopleDontDuplicated, flags: SORT_REGULAR)), $deduplicated);

        // Verify that each person in the result array is present in the original array.
        foreach ($deduplicated as $person) {
            $this->assertContains($person, $this->peopleDontDuplicated,"contains value as value");
        }
    }
}
