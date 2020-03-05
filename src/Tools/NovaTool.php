<?php

namespace SpaceCode\Maia\Tools;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use SpaceCode\Maia\ContactForm;
use SpaceCode\Maia\Page;
use SpaceCode\Maia\Permission;
use SpaceCode\Maia\Portfolio;
use SpaceCode\Maia\PortfolioCategory;
use SpaceCode\Maia\PortfolioTag;
use SpaceCode\Maia\Post;
use SpaceCode\Maia\PostCategory;
use SpaceCode\Maia\PostTag;
use SpaceCode\Maia\Role;

class NovaTool extends Tool
{
    public $roleResource = Role::class;
    public $permissionResource = Permission::class;
    public $pageResource = Page::class;
    public $postResource = Post::class;
    public $postCategoryResource = PostCategory::class;
    public $postTagResource = PostTag::class;
    public $portfolioResource = Portfolio::class;
    public $portfolioCategoryResource = PortfolioCategory::class;
    public $portfolioTagResource = PortfolioTag::class;
    public $contactFormResource = ContactForm::class;

    public function boot()
    {
        if(!isBlog()) {
            $this->postResource = null;
            $this->postCategoryResource = null;
            $this->postTagResource = null;
        }
        if(!isPortfolio()) {
            $this->portfolioResource = null;
            $this->portfolioCategoryResource = null;
            $this->portfolioTagResource = null;
        }
        Nova::resources(array_filter([
            $this->roleResource,
            $this->permissionResource,
            $this->pageResource,
            $this->postResource,
            $this->postCategoryResource,
            $this->postTagResource,
            $this->portfolioResource,
            $this->portfolioCategoryResource,
            $this->portfolioTagResource,
            $this->contactFormResource,
        ]));
    }

    /**
     * @param string $roleResource
     * @return $this
     */
    public function roleResource(string $roleResource)
    {
        $this->roleResource = $roleResource;
        return $this;
    }

    /**
     * @param string $permissionResource
     * @return $this
     */
    public function permissionResource(string $permissionResource)
    {
        $this->permissionResource = $permissionResource;
        return $this;
    }

    /**
     * @param string $pageResource
     * @return $this
     */
    public function pageResource(string $pageResource)
    {
        $this->pageResource = $pageResource;
        return $this;
    }

    /**
     * @param string $postResource
     * @return $this
     */
    public function postResource(string $postResource)
    {
        $this->postResource = $postResource;
        return $this;
    }

    /**
     * @param string $postCategoryResource
     * @return $this
     */
    public function postCategoryResource(string $postCategoryResource)
    {
        $this->postCategoryResource = $postCategoryResource;
        return $this;
    }

    /**
     * @param string $postTagResource
     * @return $this
     */
    public function postTagResource(string $postTagResource)
    {
        $this->postTagResource = $postTagResource;
        return $this;
    }

    /**
     * @param string $portfolioResource
     * @return $this
     */
    public function portfolioResource(string $portfolioResource)
    {
        $this->portfolioResource = $portfolioResource;
        return $this;
    }

    /**
     * @param string $portfolioCategoryResource
     * @return $this
     */
    public function portfolioCategoryResource(string $portfolioCategoryResource)
    {
        $this->portfolioCategoryResource = $portfolioCategoryResource;
        return $this;
    }

    /**
     * @param string $portfolioTagResource
     * @return $this
     */
    public function portfolioTagResource(string $portfolioTagResource)
    {
        $this->portfolioTagResource = $portfolioTagResource;
        return $this;
    }

    /**
     * @param string $contactFormResource
     * @return $this
     */
    public function contactFormResource(string $contactFormResource)
    {
        $this->contactFormResource = $contactFormResource;
        return $this;
    }
}