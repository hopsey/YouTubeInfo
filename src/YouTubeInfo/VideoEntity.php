<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 21/10/16
 * Time: 22:15
 */

namespace YouTubeInfo;

use GuzzleHttp\Tests\Psr7\Str;
use YouTubeInfo\ValueObject\DateInterval;
use YouTubeInfo\ValueObject\DateTime;
use YouTubeInfo\ValueObject\IntegerNumber;
use YouTubeInfo\ValueObject\StringValue;

class VideoEntity
{
    /**
     * @var StringValue
     */
    private $id;

    /**
     * @var StringValue
     */
    private $channelId;

    /**
     * @var StringValue
     */
    private $title;

    /**
     * @var IntegerNumber
     */
    private $views;

    /**
     * @var IntegerNumber
     */
    private $comments;

    /**
     * @var IntegerNumber
     */
    private $likes;

    /**
     * @var IntegerNumber
     */
    private $dislikes;

    /**
     * @var DateTime
     */
    private $publishDate;

    /**
     * @var StringValue
     */
    private $description;

    /**
     * @var DateInterval
     */
    private $duration;

    /**
     * VideoEntity constructor.
     * @param StringValue $id
     * @param StringValue $channelId
     * @param StringValue $title
     * @param IntegerNumber $views
     * @param IntegerNumber $comments
     * @param IntegerNumber $likes
     * @param IntegerNumber $dislikes
     * @param DateTime $publishDate
     * @param StringValue $description
     * @param DateInterval $duration
     */
    public function __construct(StringValue $id, StringValue $channelId, StringValue $title, IntegerNumber $views, IntegerNumber $comments,
            IntegerNumber $likes, IntegerNumber $dislikes, DateTime $publishDate, StringValue $description,
            DateInterval $duration)
    {
        $this->id = $id;
        $this->channelId = $channelId;
        $this->title = $title;
        $this->views = $views;
        $this->comments = $comments;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->publishDate = $publishDate;
        $this->description = $description;
        $this->duration = $duration;
    }


}