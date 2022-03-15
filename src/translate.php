<?php
require "../vendor/autoload.php";
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
sleep(10);
echo "Starting Selenium browser\n";
$serverUrl = "http://selenium:4444";

$driver = RemoteWebDriver::create($serverUrl, DesiredCapabilities::chrome());
$driver->get("https://translate.google.com/?sl=auto&tl=en&op=translate");
sleep(5);
$acceptButotn = $driver->findElement(
    WebDriverBy::cssSelector('#yDmH0d > c-wiz > div > div > div > div.NIoIEf > div.G4njw > div.AIC7ge > form > div > div > button > span')
);
$acceptButotn->click();
sleep(10);
$inputField = $driver->findElement(
    WebDriverBy::cssSelector('#yDmH0d > c-wiz > div > div.WFnNle > c-wiz > div.OlSOob > c-wiz > div.ccvoYb > div.AxqVh > div.OPPzxe > c-wiz.rm1UF.UnxENd > span > span > div > textarea')
);
$text = "RWC - лучший альянс во всем SOS";
echo "translating text: '$text'\n";
$inputField->sendKeys($text);
sleep(10);
$outputField = $driver->findElement(
    WebDriverBy::cssSelector(".J0lOec")
);
$outputText = $outputField->getText();
echo "Output: '$outputText'\n";
sleep(10);
$driver->close();
echo "Closing Browser";