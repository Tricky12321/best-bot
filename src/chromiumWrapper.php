<?php

namespace Tricky\BestBot;

use HeadlessChromium\Browser;
use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;


class chromiumWrapper
{
    private BrowserFactory $browserFactory;
    private Browser $browser;
    private Page $page;
    public function __construct() {
        $this->browserFactory = new BrowserFactory("chromium");
        $this->browser = $this->browserFactory->createBrowser(["noSandbox" => true]);
    }

    public function getPage($url) {
        $this->page = $this->browser->createPage();
        $this->page->navigate($url)->waitForNavigation();
    }

    public function translate($text) {
        $this->page->keyboard()->typeText($text);
        $this->page->waitUntilContainsElement(".J0lOec");
        $outputField = $this->page->evaluate('document.querySelector("#yDmH0d > c-wiz > div > div.WFnNle > c-wiz > div.OlSOob > c-wiz > div.ccvoYb.EjH7wc > div.AxqVh > div.OPPzxe > c-wiz.P6w8m.BDJ8fb > div.dePhmb > div > div.J0lOec").innerText')->getReturnValue();
        return $outputField;
    }
}