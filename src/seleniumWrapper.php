<?php

namespace Tricky\BestBot;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class seleniumWrapper
{
    private $driver;
    private $first = true;
    public function __construct() {
        echo "Waiting 5 seconds to ensure selenium is started correctly\n";
        sleep(5);
        echo "Starting Selenium browser\n";
        $serverUrl = "http://selenium:4444";
        $this->driver = RemoteWebDriver::create($serverUrl, DesiredCapabilities::chrome());
        echo "Started Selenium Browser!\n";
    }

    public function getPage($url) {
        $this->driver->get($url);

        if ($this->first) {
            $acceptButton = $this->driver->findElement(
                WebDriverBy::cssSelector('#yDmH0d > c-wiz > div > div > div > div.NIoIEf > div.G4njw > div.AIC7ge > form > div > div > button > span')
            );
            $acceptButton->click();
            sleep(2);
            $this->first = false;
        }
    }

    public function translate($text) {
        $inputField = $this->driver->findElement(
            WebDriverBy::cssSelector('#yDmH0d > c-wiz > div > div.WFnNle > c-wiz > div.OlSOob > c-wiz > div.ccvoYb > div.AxqVh > div.OPPzxe > c-wiz.rm1UF.UnxENd > span > span > div > textarea')
        );
        $inputField->sendKeys($text);
        sleep(1);
        $this->driver->wait()->until(function() {
           $elements = $this->driver->findElements(WebDriverBy::cssSelector(".J0lOec"));
               return count($elements) > 0;
        });
        $outputField = $this->driver->findElement(
            WebDriverBy::cssSelector(".J0lOec")
        );
        return $outputField->getText();
    }
}