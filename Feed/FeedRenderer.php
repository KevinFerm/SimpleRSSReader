<?php

//require('head.php');
class FeedRenderer
{
    public $title;
    public $desc;
    public $items;

    /**
     * Constructor
     *
     * @param String $title
     * @param String $desc
     * @param Array $items
     */
    function __construct($title, $desc, $items)
    {
        $this->title = $title;
        $this->desc = $desc;
        $this->items = $items;
    }

    /**
     * Take XML and present it as RSS
     *
     * @param XML $rss
     * @return void
     */
    public function printRSS($rss)
    {
        header('Content-Type: text/xml; charset=utf-8');
        echo $rss;
    }

    /**
     * Loop through our feed-items and present them as html
     *
     * @return void
     */
    public function printHTML()
    {
        include('Src/views/head.php');
        echo '<h1>' . $this->title . '</h1>';
        echo '<h2>' . $this->desc . '</h2>';
        echo '<br><br>';

        foreach ($this->items as $key => $item) {
            echo "<article>";
            echo "<h4><a href='" . (isset($item["link"]) ? (string) $item["link"] : "") . "' target='_blank'>" . (isset($item["title"]) ? (string) $item["title"] : "") . "</a></h4>";
            echo "<p><i>" . (isset($item["pubDate"]) ? $item["pubDate"] : "") . "</i></p>";
            echo "<p>" . (isset($item["description"]) ? $item["description"] : "") . "</p>";
            echo "</article>";
        }
        include('Src/views/footer.php');
    }

    /**
     * Loop through our feed-items and present them as text
     *
     * @return void
     */
    public function printText()
    {

        echo $this->title . "\n";
        echo $this->desc . "\n";
        echo "\n\n\n";

        $items = isset($this->items) ? $this->items : [];

        foreach ($items as $key => $item) {
            echo isset($item["title"]) ? $item["title"] . "\n" : "\n";
            echo isset($item["pubDate"]) ? $item["pubDate"] . "\n" : "";
            echo isset($item["description"]) ? $item["description"] . "\n" : "";
            echo isset($item["link"]) ? $item["link"] . "\n" : "";
            echo "\n";
        }
    }
}

//require('footer.php');
