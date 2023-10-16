<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //parent::register();
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuData = json_decode($verticalMenuJson);
    $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    $horizontalMenuData = json_decode($horizontalMenuJson);

    // Filter the menu data based on user roles and permissions
//    $userRoles = Auth::user()->getRoleNames()->toArray();
//    $userPermissions = Auth::user()->getAllPermissions()->pluck('name')->toArray();
//
//    $verticalMenuData = $this->filterMenu($verticalMenuData, $userRoles, $userPermissions);
//    $horizontalMenuData = $this->filterMenu($horizontalMenuData, $userRoles, $userPermissions);


    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
  }

  // Define a function to filter the menu
  function filterMenu($menuData, $userRoles, $userPermissions)
  {
    $filteredMenu = [];

    foreach ($menuData['menu'] as $menuItem) {
      $submenu = [];
      foreach ($menuItem['submenu'] as $subitem) {
        // Check if the user has the required role or permission
        if (
          !isset($subitem['role']) || in_array($subitem['role'], $userRoles) ||
          (
            isset($subitem['permission']) && in_array($subitem['permission'], $userPermissions)
          )
        ) {
          $submenu[] = $subitem;
        }
      }

      // Include the main menu item if it has subitems after filtering
      if (!empty($submenu)) {
        $menuItem['submenu'] = $submenu;
        $filteredMenu[] = $menuItem;
      }
    }

    // Create a copy of the menu data with the filtered menu
    $filteredData = $menuData;
    $filteredData['menu'] = $filteredMenu;

    return $filteredData;
  }

}
