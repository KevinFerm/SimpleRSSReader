<?php
require_once('Exceptions/InvalidArgumentsException.php');

class Request
{
    private $args;
    private $outputOptions = ["html", "rss", "text"];
    private $sortOptions = ["pubDate", "title"];

    public $url;
    public $output = "html";
    public $sort = "pubDate";

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $args = $this->getArgs();

        $this->setArgs();
    }

    /**
     * Grabs the arguments to be used
     * Can be either from a command line or GET parameters
     * @return void
     */
    private function getArgs()
    {
        if (php_sapi_name() == "cli") {
            $this->args = getopt("", ["url:", "output::", "sort::"]);
        } else {
            $this->args = $_GET; // Simple, with WWW we want to use GET args
        }
    }

    /**
     * Set arguments for easy getting and validate
     *
     * @return void
     */
    public function setArgs()
    {
        if (isset($this->args["url"]) && filter_var($this->args["url"], FILTER_VALIDATE_URL)) {
            $this->url = $this->args["url"];
        } else {
            throw new InvalidArgumentsException("URL is not valid or is not set", 1);
        }

        if (isset($this->args["output"]) && in_array($this->args["output"], $this->outputOptions)) {
            $this->output = $this->args["output"];
        }

        if (isset($this->args["sort"]) && in_array($this->args["sort"], $this->sortOptions)) {
            $this->sort = $this->args["sort"];
        }
    }
}
