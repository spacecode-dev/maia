<?php

namespace SpaceCode\Maia\Contracts;

interface PostTag
{
    /**
     * @param string $title
     * @param $guardName
     * @return static
     */
    public static function findByTitle(string $title, $guardName): self;

    /**
     * @param string $slug
     * @param $guardName
     * @return static
     */
    public static function findBySlug(string $slug, $guardName): self;

    /**
     * @param int $id
     * @param $guardName
     * @return static
     */
    public static function findById(int $id, $guardName): self;
}
