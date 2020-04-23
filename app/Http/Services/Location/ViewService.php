<?php

namespace App\Http\Services\Location;

use App\Http\Models\Language;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ViewService
{
    /** @var array **/
    private $menu;

    /** @var EntityManager */
    private $em;

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

        // \Debugbar::info($language->getName());
        $this->menu = [];
        foreach ($constants as $constant) {
            $this->menu[$constant->getConstant()] = [
                'id' => $constant->getConstant(),
                'label' => $constant->getValue(),
            ];
        }
        // \Debugbar::info($this->menu);
    }

    /**
     * @return array
     */
    public function getMenu(): array
    {
        return $this->menu;
    }
}
