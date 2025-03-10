<?php

namespace LaravelSEO\Seo\Helpers;

use LaravelSEO\Seo\Enums\HookTarget;

class Hook
{
    /**
     * Struct attribute to modify, defined in the
     * \LaravelSEO\Seo\Enums\HookTarget enum.
     *
     * @var int
     */
    protected $target;

    /**
     * If HookTarget::ATTRIBUTE is used as target, this defines
     * the attribute to be modified.
     *
     * @var mixed|null
     */
    protected $targetAttribute;

    /**
     * Filter the structs by certain attributes and values.
     *
     * @var array<string, mixed>
     */
    protected $filterAttributes = [];

    /**
     * Callback to be applied on the target.
     *
     * @var callable
     */
    protected $callback;

    /**
     * Weather the current hook callback has been executed.
     *
     * @var bool
     */
    protected $executed = false;

    /**
     * Create new Hook instance.
     *
     * @return self
     */
    public static function make(): self
    {
        return new self();
    }

    /*
     *--------------------------------------------------------------------------
     * Getters
     *--------------------------------------------------------------------------
     */

    /**
     * Get the specified hook target defined in \LaravelSEO\Seo\Enums\HookTarget.
     *
     * @return int \LaravelSEO\Seo\Enums\HookTarget enum value
     */
    public function getTarget(): int
    {
        return $this->target;
    }

    /**
     * Get the specified hook target enum (attribute, attributes, body).
     *
     * @return mixed
     */
    public function getTargetAttribute()
    {
        return $this->targetAttribute;
    }

    /**
     * Get specified attribute to filter for the hook.
     *
     * @return array<string, mixed>
     */
    public function getFilterAttributes(): array
    {
        return $this->filterAttributes;
    }

    /**
     * Get the callback to be applied.
     *
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /*
     *--------------------------------------------------------------------------
     * Setters
     *--------------------------------------------------------------------------
     */

    /**
     * Set hook target to body.
     *
     * @return $this
     */
    public function onBody(): self
    {
        $this->target = HookTarget::BODY;

        return $this;
    }

    /**
     * Set hook target on attributes.
     *
     * @return $this
     */
    public function onAttributes(): self
    {
        $this->target = HookTarget::ATTRIBUTES;

        return $this;
    }

    /**
     * Set hook target on specified attribute.
     *
     * @param string $attribute Struct attribute
     *
     * @return $this
     */
    public function onAttribute(string $attribute): self
    {
        $this->target = HookTarget::ATTRIBUTE;

        $this->targetAttribute = $attribute;

        return $this;
    }

    /**
     * Add a hook attribute filter.
     *
     * @param string $attribute Attribute to search for
     * @param mixed $value Attribute value to search for
     *
     * @return $this
     */
    public function whereAttribute(string $attribute, $value): self
    {
        $this->filterAttributes[$attribute] = $value;

        return $this;
    }

    /**
     * Set the callback to be applied.
     *
     * @param callable $callback Callback
     *
     * @return $this
     */
    public function callback(callable $callback): self
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Set executed state.
     *
     * @param bool $status State
     *
     * @return \LaravelSEO\Seo\Helpers\Hook
     */
    public function setExecuted(bool $status): self
    {
        $this->executed = $status;

        return $this;
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    /**
     * Modify the data that will be handed over to the
     * hook callback as parameter.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function translateCallbackData($data)
    {
        switch ($this->target) {
            case HookTarget::BODY:
                return $data->data();

            case HookTarget::ATTRIBUTE:
                return array_values($data)[0]->data();

            case HookTarget::ATTRIBUTES:
                return array_map(static function ($value) {
                    return $value->data();
                }, $data);
        }

        return null;
    }
}
