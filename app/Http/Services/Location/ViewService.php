<?php

namespace App\Http\Services\Location;

use App\Http\Models\Language;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ViewService
{
    /** @var EntityManager */
    private $em;

    /** @var array **/
    private $menu;

    /** @var array **/
    private $numbers;

    /**
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->em = app('em');
        $this->setData($language);
    }

    /**
     * @param Language $language
     * @return void
     */
    public function setData(Language $language)
    {
        $constants = $language->getLocationLanguageViews();

        $this->menu = [];
        $this->numbers = [];
        foreach ($constants as $constant) {
            $key = $constant->getConstant();
            switch ($key) {
                case (preg_match('/^LOCATION_MENU/', $key) ? true : false):
                    $this->menu[$constant->getConstant()] = $constant->getValue();
                    break;
                case (preg_match('/^LOCATION_NUMBERS/', $key) ? true : false):
                    $this->numbers[$constant->getConstant()] = $constant->getValue();
                    break;
            }
        }
    }

    /**
     * @return array
     */
    public function getMenu(): array
    {
        return $this->menu;
    }

    /**
     * @return array
     */
    public function getNumbers(): array
    {
        return $this->numbers;
    }
}
