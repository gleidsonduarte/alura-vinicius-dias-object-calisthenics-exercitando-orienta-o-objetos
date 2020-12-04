<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Video\Video;
use Countable;
use DateTimeImmutable;
use DateTimeInterface;

class WatchedVideos implements Countable
{
    private Map $videos;

    public function __construct()
    {
        $this->videos = new Map();
    }
    
    public function add(Video $video, DateTimeInterface $date): void
    {
        $this->videos->pull($video, $date);
    }

    public function count(): int
    {
        return $this->videos->count();
    }

    public function dateOfFirstVideo(): DateTimeImmutable
    {
        $this->videos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
        return $this->videos->first()->value;
    }
}
