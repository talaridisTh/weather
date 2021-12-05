<?php

namespace App\Models;
class Weather {

    /**
     * @var string
     */
    protected $key = "b385aa7d4e568152288b3c9f5c2458a5";

    /**
     * @var string
     */
    protected $city = "Thessaloniki";

    /**
     * @param string $city
     */
    public function __construct($city = "Thessaloniki")
    {
        $this->city = trim($city);
    }

    /**
     * Get temperature
     * @return string
     */
    public function getTemperature()
    {
        $results = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=' . $this->city . '&appid=' . $this->key . '&units=metric');

        return json_decode($results, true)['main']['temp'] . "C";
    }

    /**
     * Show message for temperature
     * @param $temp
     * @param $maxTemp
     * @return string
     */
    public function showMessage($temp, $maxTemp)
    {
        $output = $temp > $maxTemp ? "more" : "less";

        return 'Your name and Temperature ' . $output . ' than 20C. ' . $temp;
    }

}