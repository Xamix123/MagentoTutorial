<?php

namespace Learning\CarTutorial\Api\Data;

interface CarInterface
{

    /**
     * Constants for keys of data array.
     */
    const CAR_ID = 'car_id';
    const MANUFACTURER = 'manufacturer';
    const MODEL = 'model';

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Set id
     *
     * @param int $value
     * @return $this
     */
    public function setId(int $value): CarInterface;

    /**
     * Get title
     *
     * @return string|null
     */
    public function getManufacturer(): ?string;

    /**
     * Set title
     *
     * @param string $manufacturer
     * @return $this
     */
    public function setManufacturer(string $manufacturer): CarInterface;

    /**
     * Get content
     *
     * @return string|null
     */
    public function getModel(): ?string;

    /**
     * Set content
     *
     * @param string $model
     * @return $this
     */
    public function setModel(string $model): CarInterface;


    /**
     * @return void
     */
    public function showCarData(): void;
}
