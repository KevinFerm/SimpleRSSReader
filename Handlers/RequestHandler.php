<?php

class RequestHandler
{
    private $request;
    public $feed;

    /**
     * Constructor
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->feed = new Feed($request->sort);
    }

    /**
     * Fetch feed from external source
     *
     * @return void
     */
    public function getFeedData()
    {
        $this->feed->getFeed($this->request->url);
    }

    /**
     * The "controller" - returns result as the proper format
     *
     * @return void
     */
    public function handleRequest()
    {
        $renderer = new FeedRenderer($this->feed->getTitle(), $this->feed->getDesc(), $this->feed->getItems());
        switch ($this->request->output) {
            case 'html':
                $renderer->printHTML();
                break;
            case 'rss':
                $renderer->printRSS($this->feed->feed->asXML());
                break;
            case 'text':
                $renderer->printText();
                break;
            default:
                break;
        }
    }
}
