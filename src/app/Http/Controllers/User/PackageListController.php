<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\PackageListRepository;
use App\Http\Requests\Admin\PackageListStoreRequest;
use App\Http\Requests\Admin\PackageListUpdateRequest;
use App\Models\Country;
use App\Models\PackageList;
use App\Models\PackageService;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PackageListController extends Controller
{
    /**
     * constract a method
     */
    public $packageListRepository;
    public function __construct(PackageListRepository $packageListRepository)
    {
        $this->packageListRepository = $packageListRepository;
    }


    /**
     * List of all category
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pages.package_list.index', [
            'packageLists' => $this->packageListRepository->index(),
            'countries'    => Country::active()->latest()->get(),
            'categories'   => ServiceCategory::active()->latest()->get(),
        ]);
    }


    /**
     * get service by country
     */
    public function service(Request $request, $type)
    {
        if($type == 'country'){
            $data = Service::where('country_id', $request->id)->active()->latest()->get();
        }else{
            $data = Service::where('service_category_id', $request->id)->active()->latest()->get();
        }
        return json_encode([
            'data' => $data
        ]);

    }

    /**
     * get service by country
     */
    public function ServiceList($id)
    {
        $service_id = PackageService::where('service_id', $id)->pluck('id')->toArray();
        $data = PackageList::with(['packageService.package'])->whereIn('package_service_id', $service_id)->active()->latest()->get();
        return view('user.pages.package_list.index', [
            'packageLists' => $data,
            'countries'    => Country::active()->latest()->get(),
            'categories'   => ServiceCategory::active()->latest()->get(),
        ]);

    }




}