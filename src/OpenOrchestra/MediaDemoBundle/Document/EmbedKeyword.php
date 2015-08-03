<?php

namespace OpenOrchestra\MediaDemoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\ModelInterface\Model\EmbedKeywordInterface;
use OpenOrchestra\ModelInterface\Model\KeywordInterface;

/**
 * Class EmbedKeyword
 *
 * @ODM\EmbeddedDocument
 */
class EmbedKeyword implements EmbedKeywordInterface, KeywordInterface
{
    /**
     * @param KeywordInterface $keyword
     *
     * @return EmbedKeywordInterface
     */
    public static function createFromKeyword(KeywordInterface $keyword)
    {
        trigger_error('this method should not be used in the demo');

        $keyword = new EmbedKeyword();
        $keyword->setLabel($keyword->getLabel());

        return $keyword;
    }

    /**
     * @param string $label
     *
     * @return EmbedKeywordInterface
     */
    public static function createFromLabel($label)
    {
        $keyword = new EmbedKeyword();
        $keyword->setLabel($label);

        return $keyword;
    }

    /**
     * @ODM\Id()
     */
    protected $id;

    /**
     * @ODM\Field(type="string")
     */
    protected $label;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}
