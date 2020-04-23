<?php

namespace App\Http\Services\Location;

use App\Http\Models\Language;
use App\Http\Models\Location;
use App\Http\Models\LocationSlug;
use App\Http\Models\LocationType;
use LaravelDoctrine\ORM\Facades\EntityManager;

class MenuService
{
    /** @var array **/
    private $list;

    /** @var EntityManager */
    private $em;

    /** @var Language */
    private $language;

    /**
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->em = app('em');
        $this->setLanguage($language);
        $this->setList();
    }

    /**
     * @param Language $language
     * @return void
     */
    private function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    /**
     * @return void
     */
    public function setList(): void
    {
        $locationsList = $this->getLocationsListFromLanguage();
        $this->list = [];
        foreach ($locationsList as $locationItem) {
            $this->list[] = [
                'id' => $locationItem->getSlug(),
                'label' => $locationItem->getName(),
            ];
        }
    }

    /**
     * @return array
     */
    private function getLocationsListFromLanguage(): array
    {
        $locationType = $this->em->getRepository(LocationType::class)->findOneBy([
            'slug' => 'pais',
        ]);
        $qry = $this->em->createQueryBuilder();
        $qry->select('losl')
            ->from(LocationSlug::class, 'losl')
            ->join(Language::class, 'la', 'WITH', 'la = losl.language AND la = :language')
            ->join(Location::class, 'lo', 'WITH', 'lo = losl.location AND lo.locationType = :locationType')
            ->orderBy('losl.name', 'ASC');

        $qry->setParameters(array(
            'language' => $this->language,
            'locationType' => $locationType,
        ));

        return $qry->getQuery()->getResult();
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
