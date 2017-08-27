<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 27/08/2017
 * Time: 16:07
 */

namespace DBM\News\Block;


use Braintree\Exception;
use DBM\News\Model\News;
use Magento\Framework\DomDocument\DomDocumentFactory;
use Magento\Framework\View\Element\Template\Context;

class NewsList extends \Magento\Framework\View\Element\Template
{
    private static $newsCollectionUrl = 'http://www.debussac.net/blog/';

    public function __construct(Context $context, array $data = array())
    {
        parent::__construct($context, $data);
        $this->setData('news', []);

        $this->loadNews();
    }

    private function loadNews()
    {
        $newsList = [];
        $domDocumentFactory = new DomDocumentFactory();
        $domDocument = $domDocumentFactory->create();
        try {
            $urlContents = file_get_contents(self::$newsCollectionUrl);
            libxml_use_internal_errors(true);
            $domDocument->loadHTML($urlContents);
            libxml_clear_errors();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $xpath = new \DOMXPath($domDocument);
        $newsHtml = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' post ')]");

        foreach ($newsHtml as $news) {
            $newsId = $news->getAttribute("data-post_id");

            $titleNode = $xpath->query("//div[@id='post-" . $newsId . "']/*/a[@class='postTitle']/h2");
            $newsTitle = $titleNode[0]->nodeValue;

            $urlNode = $xpath->query("//div[@id='post-" . $newsId . "']/*/a[@class='postTitle']");
            $newsUrl = $urlNode[0]->getAttribute("href");

            $dateNode = $xpath->query("//div[@id='post-" . $newsId . "']/*/*/*/span[@class='meta-date']");
            $newsDate = $dateNode[0]->nodeValue;

            $likeNode = $xpath->query("//div[@id='post-" . $newsId . "']/*/*/*/a[contains(concat(' ', normalize-space(@class), ' '), ' heart ')]");
            $newsLike = $likeNode[0]->nodeValue;

            $newsList[] = new News($newsId, $newsTitle, $newsDate, $newsLike, $newsUrl);
        }
        $this->setData('news', $newsList);
    }
}