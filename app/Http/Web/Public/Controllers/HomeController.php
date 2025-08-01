<?php

namespace App\Http\Web\Public\Controllers;

use App\Modules\Licences\Enums\LicencePlanStatusEnum;
use App\Modules\Licences\LicencePlanModule;
use App\Modules\Licences\Requests\Plan\LicencePlanFilteringRequestDto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RaifuCore\Support\Services\Layout\Layout;

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request): View
    {
        // Items
        self::$vars['plans'] = LicencePlanModule::getFilteringList(
            (new LicencePlanFilteringRequestDto())->setStatus(LicencePlanStatusEnum::ACTIVE)
        )->getItems();

        Layout::page()->setTitle('DentiLab');

        return $this->_view('public.main');
    }
}
