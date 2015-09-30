<?php

namespace OpenOrchestra\MediaDemoBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\Media\Model\MediaInterface;
use OpenOrchestra\MediaDemoBundle\Document\EmbedKeyword;
use OpenOrchestra\MediaDemoBundle\Document\TranslatedValue;
use OpenOrchestra\MediaModelBundle\Document\Media;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadMediaData
 */
class LoadMediaData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $rootImage = $this->generateImage(
            'logo-orchestra.png',
            'logo Open-Orchestra',
            'image/png',
            'mediaFolder-rootImages',
            array('Lorem'),
            array(
                'en' => array('alt' => 'logo', 'title' => 'logo image'),
                'fr' => array('alt' => 'thème', 'title' => 'thème./ image')
            )
        );
        $manager->persist($rootImage);

        for ($i = 1; $i < 5; $i++) {
            $image0{$i} = $this->generateImage(
                '0' . $i . '.jpg',
                'Image 0' . $i,
                'image/jpg',
                'mediaFolder-rootImages',
                array('Lorem', 'Dolor'),
                array(
                    'en' => array('alt' => 'image 0' . $i, 'title' => 'image 0' . $i),
                    'fr' => array('alt' => 'image 0' . $i, 'title' => 'image 0' . $i)
                )
            );
            $manager->persist($image0{$i});
        }

        $manager->flush();
    }

    /**
     * Generate a Media (image format)
     *
     * @param string $filename
     * @param string $name
     * @param string $mimeType
     * @param string $folderRefence
     * @param array  $keywordReferencesArray
     * @param array  $languagesArray
     *
     * @return Media
     */
    protected function generateImage($filename, $name, $mimeType, $folderRefence, $keywordReferencesArray, $languagesArray)
    {
        $image = new Media();
        $image->setName($name);
        $image->setFilesystemName($filename);
        $image->setThumbnail($filename);
        $image->setMimeType($mimeType);
        $image->setMediaFolder($this->getReference($folderRefence));
        foreach ($keywordReferencesArray as $keywordReference) {
            $keyword = EmbedKeyword::createFromLabel($keywordReference);
            $image->addKeyword($keyword);
        }
        foreach ($languagesArray as $language => $labels) {
            $image->addAlt($this->generatedValue($language, $labels['alt']));
            $image->addTitle($this->generatedValue($language, $labels['title']));
        }
        $this->copyFile($image);

        return $image;
    }

    /**
     * Copy the file physically and generate the thumbnails
     *
     * @param MediaInterface $media
     */
    protected function copyFile(MediaInterface $media)
    {
        $file = './vendor/open-orchestra/open-orchestra-media-bundle/OpenOrchestra/MediaModelBundle/DataFixtures/Images/' . $media->getFilesystemName();
        $gaufretteManager = $this->container->get('open_orchestra_media.manager.gaufrette');
        $imageResizerManager = $this->container->get('open_orchestra_media.manager.image_resizer');

        $gaufretteManager->uploadContent($media->getFilesystemName(), fopen($file, 'r'));

        copy($file, $this->container->getParameter('open_orchestra_media.tmp_dir') . '/'. $media->getFilesystemName());

        $imageResizerManager->generateAllThumbnails($media);;
    }

    /**
     * @param string $language
     * @param string $value
     *
     * @return TranslatedValue
     */
    public function generatedValue($language, $value)
    {
        $label = new TranslatedValue();
        $label->setLanguage($language);
        $label->setValue($value);

        return $label;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 410;
    }
}
