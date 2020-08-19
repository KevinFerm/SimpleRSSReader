<?php


class Feed
{
    public $feed;
    public $sort;
    public $json;

    /**
     * Constructor
     *
     * @param string $sort
     */
    public function __construct($sort = "published")
    {
        // Which property should we sort by?
        $this->sort = $sort;
    }

    /**
     * Loads external url, checks if valid XML
     *
     * @param [type] $url
     * @return void
     */
    public function getFeed($url)
    {
        if (!($x = simplexml_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA))) {
            renderError();
        }

        $this->feed = $x;
        $this->json = $this->getJson();
    }

    /**
     * Tries to convert the xml to json to work with it easier
     * Todo: Probably should have done this straight from XML to save some parsing time
     * @return void
     */
    public function getJson()
    {
        if ($feed = json_encode($this->feed)) {
            return json_decode($feed, TRUE);
        } else {
            renderError();
        }
    }

    /**
     * Returns the title property for this feed
     *
     * @return void
     */
    public function getTitle()
    {
        $f = $this->json;
        $channel = $f["channel"];
        return isset($channel["title"]) ? (string) $channel["title"] : "";
    }

    /**
     * Returns the description property for this feed
     *
     * @return void
     */
    public function getDesc()
    {
        $f = $this->json;
        $channel = $f["channel"];
        return isset($channel["description"]) ? (string) $channel["description"] : "";
    }

    /**
     * Returns the item property for this feed
     *
     * @return void
     */
    public function getItems()
    {
        $f = $this->json;
        $channel = $f["channel"];
        $items = isset($channel["item"]) ? $channel["item"] : [];
        array_multisort(array_column($items, $this->sort), SORT_DESC, $items);
        return $items;
    }
}
