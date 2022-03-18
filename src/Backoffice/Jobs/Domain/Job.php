<?php


namespace App\Backoffice\Jobs\Domain;


class Job
{

    private int $id;

    private ?string $name;

    private ?string $description;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Job
     */
    public function setName(?string $name): Job
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Job
     */
    public function setDescription(?string $description): Job
    {
        $this->description = $description;
        return $this;
    }


}