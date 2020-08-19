# Simple RSS Reader
RSS för artiklar borde fungera bra att läsa

## Användning
 Parametrar:

 * URL:Obligatoriskt
 * Output:Frivilligt (Default: html) rss, html eller text
 * Sort:Frivilligt (Default: pubDate) pubDate eller title - Sorterar DESC


### Command line
För att använda RSS via Command line så används properties på följande sätt
`php index.php --url="https://www.hv71.se/artiklar.rss" --sort="title" --output="text"`
`php index.php --url="https://rss.aftonbladet.se/rss2/small/pages/sections/aftonbladet/" --sort="pubDate" --output="rss"`

### Webb
Via webben fungerar det på precis samma sätt
`http://localhost/?url=https://www.hv71.se/artiklar.rss&output=html&sort=title`
`http://localhost/?url=https://rss.aftonbladet.se/rss2/small/pages/sections/aftonbladet/&output=rss&sort=pubDate`