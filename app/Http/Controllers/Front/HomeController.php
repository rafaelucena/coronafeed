<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Language;
use App\Http\Models\Location;
use App\Http\Models\LocationSlug;
use App\Http\Services\HomeService;
use App\Http\Services\LocationService;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $form = new HomeService();
        return view('front.home.index', ['form' => $form]);
    }

    /**
     * @param Language $language
     * @param string $slug
     * @return View
     */
    public function location(Language $language, string $slug): View
    {
        $locationSlug = $this->getLocationSlug($language, $slug);
        $form = new LocationService($locationSlug);
        return view('front.home.index', ['form' => $form]);
    }

    /**
     * @param Language $language
     * @param string $slug
     * @return LocationSlug
     */
    private function getLocationSlug(Language $language, string $slug): LocationSlug
    {
        $qry = app('em')->createQueryBuilder();
        $qry->select('losl')
            ->from(LocationSlug::class, 'losl')
            ->join(Language::class, 'la', 'WITH', 'la = losl.language AND la = :language')
            ->where('losl.slug = :slug');

        $qry->setParameters(array(
            'language' => $language,
            'slug' => $slug,
        ));

        $locationSlugs = $qry->getQuery()->getResult();

        return current($locationSlugs);
    }
}
