<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_debugbar/open' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.openhandler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/stylesheets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.css',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/javascript' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.js',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/queries/explain' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.queries.explain',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/token' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.token',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/authorize' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.authorize',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.approve',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.deny',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/token/refresh' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.token.refresh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/tokens' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.tokens.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/clients' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/scopes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.scopes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/personal-access-tokens' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qQ7L4S96o0foyLeE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AL93HcJkXmdtf9MH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hmqnMyzhO9n7f9Hg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/verify-phone' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7D5bMCUKNtRbdRKD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::doSZwZ94HWiYbXHq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vVPlCkEQt42hJzTp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/config/place-api-autocomplete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FJxuqurOIC0hNV5P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/config/place-api-details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lJIFU9xKT7fqIDhj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/config/get-zone-id' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pppmF9oWcURXlFWV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/config/geocode-api' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::84INSGyDDvbA1R8b',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JkvSrHoAHpHrGZFn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/zones' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EC8zH8oVFaUhXLgM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/zones/get-regions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YRzJ69WW6xEwLBXr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/zones/get-city-by-zoneId' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8RKUVVyCDu26dQ6t',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/get-services' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y5wOELYXrVmaXziM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qBSWsbJm44VSUfkS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/package-views' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SgIIB1lil6LyfI2d',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/package-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FrKLGqNrgVa2GL14',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/get-properties' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aPRhbNyDXAuoWTGS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/market-plan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BYhWIlxXHOwZzfta',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/get-facilities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N1rVGoEsNLTVqK9Q',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/get-advantages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rBrZz5WGtg8nf9Xw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/agent-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N5zQW9lp3WhUfv49',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/near_by' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CZgMdAILXu4WIV7g',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BQrah2EuQjjWhmch',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/upload-video' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xVy089AHHjLXfdG4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/upload-sky-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TovZ6zjJVreMIKTu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/create-report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u22fYSJB35v05rtI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/advantages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zCezqJCGJ1irgvpl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/existing-advantages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vBTBdwYV9XOiSHHa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/validate-advertisement' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::37bCMaVB2tNxFqmT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/platform-compliance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oa2nCCi0hnOSBxzq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/check-license' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BEhoKRoYYmJIBHe0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/categories-by-type' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cRMHzHPWJmBy66DY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::13jiUguX4NU0p7TA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estate/search-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0HpFDGhKCtv8elb4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::km5ZZPRhOmQglPtu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/update-profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jnbkcivsYgamoosk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::n3ji4NGg9s9uRSy2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/complete-agent' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UgRlnwY8fWa3E3yM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/cm-firebase-token' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y1Um1ZPnqnH0AleG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/my-estate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jTVZgUNtO24TIQKh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VQjTNza44tQjNzgs',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/nafath-validation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::69Vv33KkiUbFddV6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/customer/check-request-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o9a2eay8bExzlQIN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/message/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aVyU2NFnwLlqakSJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/message/search-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hPdYC7XKjXHihpWD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/message/details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::F3v755XClAznQOiz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/message/send' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9he2dJwzPFQsK4kV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/message/chat-image' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hXZyP8JMCxsfVb17',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/wish-list/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tkbNUve5JJx4fOIQ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/wish-list/remove' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zZtJpObWRdqPo6tm',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/wish-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::h3MzSuGyVUyflq2o',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/wallet/transactions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::S0ssbD6ygDIFxO4Q',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/provider-subscriptions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9kHVLean0xZNP54R',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/provider-subscriptions/offer-setup-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2DNIidnlxtY8xBCG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/provider-subscriptions/calculate-price' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rMDxbdtmjBaxGJIH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/provider-subscriptions/store-offer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hAAF3X1RiT3RCaAi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/service-provider/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::75XXUflHTaWtnkpk',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/service-provider/offer-setup-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tOdUcKUIYP64lAp9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/service-provider/store-offer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2aWneCWJWpRQmUrU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/service-provider/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HggWtrYDPZxaU5rz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/manage-permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y2qZ2AWATpNsNFaB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/banners' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NgF1yBJQ7vWAudNx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/banners/advertisement/validate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Nj1LSUjYDlRLEDoH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/services' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Kl7M9uUn0iT1aCH3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MMRDQo1jzHUXhQqb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/services/filters' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::08QQnsTOyYZIRDoG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/services/my-services' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YEypH7TDiOQiJpgK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/service-plans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nArzW93u0wT6jQ2T',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yxUXavFKcCLQeedZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/estates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Wmha1HVkVt9fSq7Q',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/reports/provider/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9C8gWSijMRANjybU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/reports/global/overview' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::91geFjkYI8mHlouQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/reports/global/estates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kdvstPySIPUkUSQ3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/reports/global/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kz1AQLv8NnUjbQR8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/reports/global/charts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qt973BiyGOzXpzqf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'showLogin',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agent/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role.showLogin',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'role.login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agent/auth/otp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role.otp.form',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'role.otp.verify',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agent/auth/otp/resend' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'role.otp.resend',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/estates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estates.index2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zones-main',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'map',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Brokerage/PushNotification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nDhSwbrheXoh3lpJ',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout-details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout-details',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout-shipping' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout-shipping',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout-payment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout-payment',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout-review' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout-review',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout-complete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout-complete',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/offline-payment-checkout-complete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offline-payment-checkout-complete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order-placed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'order-placed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/shop-cart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'shop-cart',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order_note' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'order_note',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/digital-product-download-otp-verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'digital-product-download-otp-verify',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/digital-product-download-otp-reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'digital-product-download-otp-reset',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pay-offline-method-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pay-offline-method-list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/checkout-complete-wallet' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout-complete-wallet',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/subscription' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'subscription',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search-shop' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'search-shop',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/brands' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'brands',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/vendors' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'vendors',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/website-offers/step-one' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.step-one',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.step-one.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/website-offers/step-two' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.step-two',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.step-two.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/website-offers/step-three' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.step-three',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.step-three.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/website-offers/preview' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.preview',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/website-offers/website-offers/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'website.offers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/get-login-modal-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.get-login-modal-data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/sign-up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.sign-up',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.sign-up.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/sign-up3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.sign-up3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/sign-provider' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.sign-provider',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/provider' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.provider',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/about-provider' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.about-provider',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.verify',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/ajax-verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.ajax_verify',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/resend-otp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.resend_otp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/recover-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.recover-password',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.forgot-password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/otp-verification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.otp-verification',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.generated::1ce77uUjUKGkT5Ph',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.reset-password',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.generated::kPgEKDueKHr5n5IH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/auth/resend-otp-reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.resend-otp-reset-password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/track-order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'track-order.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/track-order/result-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'track-order.result-view',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/track-order/last' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'track-order.last',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/track-order/result' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'track-order.result',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/track-order/order-wise-result-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'track-order.order-wise-result-view',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'messages',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Jkpi5zaPCWyVZJYm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user-profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user-account' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-account',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user-account-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user-account-picture' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-picture',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-address-add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-address-add',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-address' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-address',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-address-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'address-store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-address-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'address-delete',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-address-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'address-update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-payment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-payment',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-estate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-estate',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-order-details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-order-details',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-order-details-vendor-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-order-details-vendor-info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-order-details-delivery-man-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-order-details-delivery-man-info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-order-details-reviews' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-order-details-reviews',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-wishlist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-wishlist',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refund-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'refund-store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account-tickets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-tickets',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ticket-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ticket-submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refer-earn' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'refer-earn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user-coupons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-coupons',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nafath-validation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nafath-validation',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/add-license' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'add-license',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/check-license' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'check-license',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/support-ticket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'support-ticket',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/check-request-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'check-request-status',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'report',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/about-us' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'about-us',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/contacts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'contacts',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/helpTopic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'helpTopic',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refund-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'refund-policy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/return-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'return-policy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/privacy-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'privacy-policy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancellation-policy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cancellation-policy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/terms-and-condition' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'terms',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create-estate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'create-estate',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/store-estate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store-estate',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/categories/filter' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.filter',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wishlist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wishlist',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getfv' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'getfv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/upload-videos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'upload-videos',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/view-wishlist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'view-wishlist',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/delete-wishlist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete-wishlist',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/estate/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/estate/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/estate/success' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estate.success',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/video' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'video.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/video/video-upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'store.video',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/video/success' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'video.success',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8mk2mTguSPUstldG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agent/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agent.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getEmployees' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'getEmployees',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/advertisement/validate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3qxJri7s0qaBCCmf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/admins' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admins.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/admins/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admins.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/admins/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admins.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/roles/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'permissions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/permissions/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'permissions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/categories/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/categories/sub' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.sub-categories',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/properties' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'properties.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/properties/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'properties.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/territories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'territories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/territories/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'territories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/zones' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zones.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/zones/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zones.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/zones/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zones.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/provinces' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'provinces.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/provinces/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'provinces.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-providers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-providers.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-providers/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-providers.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-providers/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-providers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/agents' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/agents/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/agents/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/agents/real-estate-offices' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.real-estate-offices',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/agents/real-estate-companies' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.real-estate-companies',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/agents/individuals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.individuals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-types' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-types.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-types/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/offers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offers.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/offers/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offers.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/offers/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/offers/sent' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offers.sent',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/notification/add-new' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'notification.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/notification/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'notification.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/banners' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'banners.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/banners/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'banners.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/packages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'packages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/packages/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'packages.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/packages/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'packages.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/message/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'message.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/estate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estate.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/estate/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estate.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/estate/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estate.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/business-settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'business-settings.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/business-settings/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'business-settings.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/business-settings/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'business-settings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-plans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-plans.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-plans/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-plans.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service-plans/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-plans.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reports' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reports/estates/chart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.estates.chart',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reports/users/chart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.users.chart',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reports/estates/breakdown' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.estates.breakdown',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reports/users/breakdown' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.users.breakdown',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agents/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agentOk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agents/estates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estates.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/agents/estates/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estates.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/providers/profile/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'providers.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/dashboard/change-language' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.change-language',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/offers/map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.offers.pending',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/offers/accept' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.offers.accept',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/offers/owner/pending' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.owner.offers.pending',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/offers/owner/accept' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.owner.offers.accept',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/offers/create-offer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.create-offer',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/offers/store-offer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.store-offer',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/profile/index' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.profile.dispaly',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/service-providers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|lockwork/([^/]++)(*:39)|ache/([^/]++)(?:/([^/]++))?(*:73))|/o(?|auth/(?|tokens/([^/]++)(*:109)|clients/([^/]++)(?|(*:136))|personal\\-access\\-tokens/([^/]++)(*:178))|rder\\-cancel/([^/]++)(*:208))|/a(?|pi/v1/(?|zones/get\\-(?|cities\\-by\\-regions/([^/]++)(*:273)|districts\\-by\\-cities/([^/]++)(*:311))|estate(?|/(?|get\\-estate/([^/]++)(*:353)|list/([^/]++)(*:374)|map\\-list/([^/]++)(*:400)|de(?|tails/([^/]++)(*:427)|lete\\-(?|image/([^/]++)/([^/]++)(*:467)|planned/([^/]++)/([^/]++)(*:500)))|video(?|/(?|([^/]++)(*:530)|path(*:542))|\\-delete/([^/]++)(*:568))|etch\\-existing\\-(?|images/([^/]++)(*:611)|planned/([^/]++)(*:635))|upload\\-(?|images/([^/]++)(*:670)|planned/([^/]++)(*:694)))|s/([^/]++)(*:714))|provider\\-subscriptions/([^/]++)/status(*:762)|manage\\-permissions/([^/]++)/(?|assign(*:808)|revoke(*:822)|sync(*:834))|service(?|s/([^/]++)(?|/toggle\\-status(*:881)|(*:889))|\\-plans/([^/]++)(?|(*:917))))|ccount\\-(?|address\\-edit/([^/]++)(*:961)|delete/([^/]++)(*:984))|dmin/(?|se(?|ttings/(?|admins/(?|edit/([^/]++)(*:1039)|update/([^/]++)(*:1063))|roles/(?|edit/([^/]++)(*:1095)|update/([^/]++)(*:1119))|permissions/(?|edit/([^/]++)(*:1157)|update/([^/]++)(*:1181))|change\\-status/([^/]++)(*:1214))|rvice\\-(?|p(?|roviders/(?|edit/([^/]++)(*:1263)|update/([^/]++)(*:1287)|service\\-provider/offers/([^/]++)/toggle\\-status(*:1344))|lans/(?|edit/([^/]++)(*:1375)|update/([^/]++)(*:1399)|delete/([^/]++)(*:1423)))|types/(?|edit/([^/]++)(*:1456)|update/([^/]++)(*:1480))))|categories/(?|edit/([^/]++)(*:1519)|update/([^/]++)(*:1543))|p(?|ro(?|perties/(?|edit/([^/]++)(*:1586)|update/([^/]++)(*:1610))|vinces/(?|edit/([^/]++)(*:1643)|update/([^/]++)(*:1667)))|ackages/(?|edit/([^/]++)(*:1702)|update/([^/]++)(*:1726)))|territories/(?|edit/([^/]++)(*:1765)|update/([^/]++)(*:1789))|zones/(?|edit/([^/]++)(*:1821)|update/([^/]++)(*:1845))|agents/(?|edit/([^/]++)(*:1878)|update/([^/]++)(*:1902))|offers/(?|edit/([^/]++)(*:1935)|update/([^/]++)(*:1959)|([^/]++)/send\\-offer(?|(*:1991)))|b(?|anners/delete/([^/]++)(*:2028)|usiness\\-settings/(?|edit/([^/]++)(*:2071)|update/([^/]++)(*:2095)))|message/(?|store/([^/]++)(*:2131)|view/([^/]++)/([^/]++)(*:2162))|estate/(?|edit/([^/]++)(*:2195)|update/([^/]++)(*:2219))))|/zone/get\\-coordinates/([^/]++)(*:2262)|/estates/([^/]++)(?|/(?|edit(*:2299)|transfer\\-identity(*:2326))|(*:2336))|/properties/(?|zone/([^/]++)(*:2374)|([^/]++)/(?|images(?|(*:2404)|/([^/]++)(*:2422))|planned(?|(*:2442)|/([^/]++)(*:2460))|upload\\-(?|images(*:2487)|planned(*:2503))))|/d(?|igital\\-product\\-download/([^/]++)(*:2554)|e(?|lete\\-estate/([^/]++)(*:2588)|tails/([^/]++)(*:2611)))|/c(?|ategory\\-ajax/([^/]++)(*:2649)|ustomer/auth/(?|c(?|ode/captcha/([^/]++)(*:2698)|heck\\-register/([^/]++)(*:2730))|verify\\-register/([^/]++)(*:2765)|resend\\-register/([^/]++)(*:2799)|update\\-phone/([^/]++)(?|(*:2833))|login/([^/]++)(?|(*:2860)|/callback(*:2878)))|hat/([^/]++)(*:2901))|/s(?|e(?|ller\\-profile/([^/]++)(*:2942)|rvice\\-providers/(?|offers/(?|shop/([^/]++)(*:2994)|([^/]++)/(?|display(*:3022)|status\\-accept(*:3045))|edit\\-offer/([^/]++)(*:3075)|delete\\-offer/([^/]++)(*:3106)|update\\-offer/([^/]++)(*:3137)|payment/([^/]++)(*:3162))|profile/update(?|/([^/]++)(?|(*:3201)|(*:3210))|\\-bank\\-info/([^/]++)(?|(*:3244)))))|upport\\-ticket/(?|([^/]++)(?|(*:3286))|delete/([^/]++)(*:3311)|close/([^/]++)(*:3334)))|/flash\\-deals/([^/]++)(*:3367)|/ge(?|nerate\\-invoice/([^/]++)(*:3406)|t\\-(?|cities/([^/]++)(*:3436)|districts/([^/]++)(*:3463)))|/refund\\-(?|request/([^/]++)(*:3502)|details/([^/]++)(*:3527))|/update/([^/]++)(*:3553))/?$}sDu',
    ),
    3 => 
    array (
      39 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.clockwork',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      73 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.cache.delete',
            'tags' => NULL,
          ),
          1 => 
          array (
            0 => 'key',
            1 => 'tags',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      109 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.tokens.destroy',
          ),
          1 => 
          array (
            0 => 'token_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      136 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.update',
          ),
          1 => 
          array (
            0 => 'client_id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.destroy',
          ),
          1 => 
          array (
            0 => 'client_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      178 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.destroy',
          ),
          1 => 
          array (
            0 => 'token_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      208 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'order-cancel',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      273 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hTsfa0tFWwFs5uY0',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4kDSlN9fmcQf0EXa',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      353 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2jqEKskbIzLuKv6C',
          ),
          1 => 
          array (
            0 => 'filter_data',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      374 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GBrkexbfDgJtVC3T',
          ),
          1 => 
          array (
            0 => 'filter_data',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      400 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fSa6YpPxDswPIXBS',
          ),
          1 => 
          array (
            0 => 'filter_data',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      427 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2hW1LFrgbu35eNXp',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      467 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Rwfa2iMRED97wP6f',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'imageUrl',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      500 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eOg2u5AZBQpJQUAJ',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'imageUrl',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      530 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fwUuQ0nsybWlTqwz',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      542 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LeEbOE3Pk2u5vZ9g',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      568 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::agFBhJc1N8lhLjrh',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      611 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3EK3d0A6x85dbCM0',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      635 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MVp4dLo939R2fnVh',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      670 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RjD96bEkCMyXhcsk',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      694 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Fl6bud8FSBWr1TyA',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      714 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sG5hKVSbe7FBZYR4',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      762 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eusyVrkWyqCrvCj8',
          ),
          1 => 
          array (
            0 => 'subscription_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      808 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1xNuyMie4RtV9diX',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      822 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mBKtIPfezrbqstSq',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      834 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::v3MTGq05OyytMPDn',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      881 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LtPdkMi7iXasW4Jf',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      889 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gnS0l9vgFKKIDEtu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pMsAswt6O0yMK6YO',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VOLbAfDp3KK1xVWv',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      917 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7iB7pjTH8gdAGznP',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UHa5KciLgxRKWM5K',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZGMnJlacMOuY35cv',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      961 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'address-edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      984 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'account-delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1039 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admins.edit',
          ),
          1 => 
          array (
            0 => 'admin',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1063 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admins.update',
          ),
          1 => 
          array (
            0 => 'admin',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1095 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.edit',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1119 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.update',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1157 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'permissions.edit',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1181 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'permissions.update',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1214 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change-status',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1263 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-providers.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1287 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-providers.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1344 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.offers.toggle-status',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-plans.edit',
          ),
          1 => 
          array (
            0 => 'servicePlan',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1399 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-plans.update',
          ),
          1 => 
          array (
            0 => 'servicePlan',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1423 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-plans.delete',
          ),
          1 => 
          array (
            0 => 'servicePlan',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1456 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-types.edit',
          ),
          1 => 
          array (
            0 => 'serviceType',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1480 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-types.update',
          ),
          1 => 
          array (
            0 => 'serviceType',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1519 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.edit',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1543 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.update',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1586 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'properties.edit',
          ),
          1 => 
          array (
            0 => 'property',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1610 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'properties.update',
          ),
          1 => 
          array (
            0 => 'property',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1643 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'provinces.edit',
          ),
          1 => 
          array (
            0 => 'province',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1667 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'provinces.update',
          ),
          1 => 
          array (
            0 => 'province',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1702 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'packages.edit',
          ),
          1 => 
          array (
            0 => 'package',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1726 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'packages.update',
          ),
          1 => 
          array (
            0 => 'package',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1765 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'territories.edit',
          ),
          1 => 
          array (
            0 => 'territory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1789 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'territories.update',
          ),
          1 => 
          array (
            0 => 'territory',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1821 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zones.edit',
          ),
          1 => 
          array (
            0 => 'zone',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1845 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zones.update',
          ),
          1 => 
          array (
            0 => 'zone',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1878 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1902 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'agents.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1935 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offers.edit',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1959 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'offers.update',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1991 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'send.offer.page',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'send.offer.page.post',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2028 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'banners.delete',
          ),
          1 => 
          array (
            0 => 'banner',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2071 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'business-settings.edit',
          ),
          1 => 
          array (
            0 => 'package',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2095 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'business-settings.update',
          ),
          1 => 
          array (
            0 => 'package',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2131 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'message.store',
          ),
          1 => 
          array (
            0 => 'user_id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2162 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'message.view',
          ),
          1 => 
          array (
            0 => 'conversation_id',
            1 => 'user_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2195 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estate.edit',
          ),
          1 => 
          array (
            0 => 'package',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2219 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estate.update',
          ),
          1 => 
          array (
            0 => 'package',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2262 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'zone.get-coordinates',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2299 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estates.edit',
          ),
          1 => 
          array (
            0 => 'estate',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2326 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estates.transferIdentity',
          ),
          1 => 
          array (
            0 => 'estate',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2336 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'estates.update',
          ),
          1 => 
          array (
            0 => 'estate',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2374 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'byZone',
          ),
          1 => 
          array (
            0 => 'zone_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2404 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'getImages',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2422 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete-property-image',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'image',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2442 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'getPlanned',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2460 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete-property-planned',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'image',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2487 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::idmembon0Mt4iyqS',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2503 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EXUbwNm234TN7W8F',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2554 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'digital-product-download',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2588 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete-estate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2611 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'details',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2649 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category-ajax',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2698 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.default-captcha',
          ),
          1 => 
          array (
            0 => 'tmp',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2730 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.check',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2765 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.verify-register',
          ),
          1 => 
          array (
            0 => 'user_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2799 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.resend-register',
          ),
          1 => 
          array (
            0 => 'user_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2833 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.update-phone',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.generated::ER4AOj7sM9F5e147',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2860 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.service-login',
          ),
          1 => 
          array (
            0 => 'service',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2878 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer.auth.service-callback',
          ),
          1 => 
          array (
            0 => 'service',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2901 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'chat',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2942 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'seller-profile',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2994 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'shop',
          ),
          1 => 
          array (
            0 => 'shop',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3022 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.offers.display',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3045 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.offers.status.accept',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3075 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.edit-offer',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3106 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.delete-offer',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3137 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.update-offer',
          ),
          1 => 
          array (
            0 => 'offer',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3162 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.estaes.payment',
          ),
          1 => 
          array (
            0 => 'offer_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3201 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'profile.',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'profile.generated::MALVPX9dv6h146BH',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3210 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'service-provider.profile.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3244 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.update-bank-info',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'profile.generated::tNYWgP4cVoEh2uzT',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3286 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'support-ticket.index',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'support-ticket.comment',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'support-ticket.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3334 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'support-ticket.close',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3367 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'flash-deals',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3406 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generate-invoice',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3436 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::M5F1c3qvgpmCeD7V',
          ),
          1 => 
          array (
            0 => 'zone_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3463 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jhy7jPTJUSTEOC8S',
          ),
          1 => 
          array (
            0 => 'cityId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3502 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'refund-request',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3527 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'refund-details',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3553 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'provider.profile.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'debugbar.openhandler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/open',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'as' => 'debugbar.openhandler',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.clockwork' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/clockwork/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'as' => 'debugbar.clockwork',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.css' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/stylesheets',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'as' => 'debugbar.assets.css',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.js' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/javascript',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'as' => 'debugbar.assets.js',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.cache.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => '_debugbar/cache/{key}/{tags?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'as' => 'debugbar.cache.delete',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.queries.explain' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_debugbar/queries/explain',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'as' => 'debugbar.queries.explain',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.token' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/token',
      'action' => 
      array (
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        'as' => 'passport.token',
        'middleware' => 'throttle',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.authorize' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
        'as' => 'passport.authorizations.authorize',
        'middleware' => 'web',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.token.refresh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/token/refresh',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
        'as' => 'passport.token.refresh',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.approve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
        'as' => 'passport.authorizations.approve',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.deny' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
        'as' => 'passport.authorizations.deny',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.tokens.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
        'as' => 'passport.tokens.index',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.tokens.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/tokens/{token_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
        'as' => 'passport.tokens.destroy',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
        'as' => 'passport.clients.index',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@store',
        'as' => 'passport.clients.store',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@store',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'oauth/clients/{client_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@update',
        'as' => 'passport.clients.update',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@update',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/clients/{client_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
        'as' => 'passport.clients.destroy',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.scopes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/scopes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
        'as' => 'passport.scopes.index',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/personal-access-tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
        'as' => 'passport.personal.tokens.index',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/personal-access-tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
        'as' => 'passport.personal.tokens.store',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/personal-access-tokens/{token_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
        'as' => 'passport.personal.tokens.destroy',
        'controller' => 'Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
        'namespace' => 'Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qQ7L4S96o0foyLeE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:297:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:79:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000068f0000000000000000";}";s:4:"hash";s:44:"ubphQtjYRtxLi8/CoAvNaWwd7YTguEdw/wAYGsgKCcQ=";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::qQ7L4S96o0foyLeE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AL93HcJkXmdtf9MH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@register',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@register',
        'namespace' => 'api\\v1\\auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::AL93HcJkXmdtf9MH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hmqnMyzhO9n7f9Hg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@login',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@login',
        'namespace' => 'api\\v1\\auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::hmqnMyzhO9n7f9Hg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7D5bMCUKNtRbdRKD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/verify-phone',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@verify_phone',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@verify_phone',
        'namespace' => 'api\\v1\\auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::7D5bMCUKNtRbdRKD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::doSZwZ94HWiYbXHq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/auth/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@all_code',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\auth\\CustomerAuthController@all_code',
        'namespace' => 'api\\v1\\auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::doSZwZ94HWiYbXHq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vVPlCkEQt42hJzTp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@configuration',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@configuration',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/config',
        'where' => 
        array (
        ),
        'as' => 'generated::vVPlCkEQt42hJzTp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FJxuqurOIC0hNV5P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/config/place-api-autocomplete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@place_api_autocomplete',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@place_api_autocomplete',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/config',
        'where' => 
        array (
        ),
        'as' => 'generated::FJxuqurOIC0hNV5P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lJIFU9xKT7fqIDhj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/config/place-api-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@place_api_details',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@place_api_details',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/config',
        'where' => 
        array (
        ),
        'as' => 'generated::lJIFU9xKT7fqIDhj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pppmF9oWcURXlFWV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/config/get-zone-id',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@get_zone',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@get_zone',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/config',
        'where' => 
        array (
        ),
        'as' => 'generated::pppmF9oWcURXlFWV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::84INSGyDDvbA1R8b' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/config/geocode-api',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@geocode_api',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConfigController@geocode_api',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/config',
        'where' => 
        array (
        ),
        'as' => 'generated::84INSGyDDvbA1R8b',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JkvSrHoAHpHrGZFn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CategoryController@get_categories',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CategoryController@get_categories',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/categories',
        'where' => 
        array (
        ),
        'as' => 'generated::JkvSrHoAHpHrGZFn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EC8zH8oVFaUhXLgM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/zones',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@all',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@all',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/zones',
        'where' => 
        array (
        ),
        'as' => 'generated::EC8zH8oVFaUhXLgM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YRzJ69WW6xEwLBXr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/zones/get-regions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@get_regions',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@get_regions',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/zones',
        'where' => 
        array (
        ),
        'as' => 'generated::YRzJ69WW6xEwLBXr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8RKUVVyCDu26dQ6t' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/zones/get-city-by-zoneId',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@cities_by_zoneId',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@cities_by_zoneId',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/zones',
        'where' => 
        array (
        ),
        'as' => 'generated::8RKUVVyCDu26dQ6t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hTsfa0tFWwFs5uY0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/zones/get-cities-by-regions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@get_cities_by_regions',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@get_cities_by_regions',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/zones',
        'where' => 
        array (
        ),
        'as' => 'generated::hTsfa0tFWwFs5uY0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4kDSlN9fmcQf0EXa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/zones/get-districts-by-cities/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@get_districts_by_cities',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ZonAndCityController@get_districts_by_cities',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/zones',
        'where' => 
        array (
        ),
        'as' => 'generated::4kDSlN9fmcQf0EXa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2jqEKskbIzLuKv6C' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/get-estate/{filter_data}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_estate',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_estate',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::2jqEKskbIzLuKv6C',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y5wOELYXrVmaXziM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/get-services',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_services',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_services',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::Y5wOELYXrVmaXziM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GBrkexbfDgJtVC3T' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/list/{filter_data}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@list',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@list',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::GBrkexbfDgJtVC3T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fSa6YpPxDswPIXBS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/map-list/{filter_data}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@mapList',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@mapList',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::fSa6YpPxDswPIXBS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qBSWsbJm44VSUfkS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@create',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@create',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::qBSWsbJm44VSUfkS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2hW1LFrgbu35eNXp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_details',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_details',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::2hW1LFrgbu35eNXp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SgIIB1lil6LyfI2d' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/package-views',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@package',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@package',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::SgIIB1lil6LyfI2d',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FrKLGqNrgVa2GL14' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/package-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@package',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@package',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::FrKLGqNrgVa2GL14',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aPRhbNyDXAuoWTGS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/get-properties',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_properties',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_properties',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::aPRhbNyDXAuoWTGS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BYhWIlxXHOwZzfta' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/market-plan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@market_plan',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@market_plan',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::BYhWIlxXHOwZzfta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N1rVGoEsNLTVqK9Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/get-facilities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_facilities',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_facilities',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::N1rVGoEsNLTVqK9Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rBrZz5WGtg8nf9Xw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/get-advantages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_advantages',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@get_advantages',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::rBrZz5WGtg8nf9Xw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N5zQW9lp3WhUfv49' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/agent-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@info_by_id',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@info_by_id',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::N5zQW9lp3WhUfv49',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CZgMdAILXu4WIV7g' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/near_by',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@near_by',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@near_by',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::CZgMdAILXu4WIV7g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BQrah2EuQjjWhmch' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@update',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@update',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::BQrah2EuQjjWhmch',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xVy089AHHjLXfdG4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/upload-video',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadVideo',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadVideo',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::xVy089AHHjLXfdG4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TovZ6zjJVreMIKTu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/upload-sky-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadSkyView',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadSkyView',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::TovZ6zjJVreMIKTu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fwUuQ0nsybWlTqwz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/video/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@showVideo',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@showVideo',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::fwUuQ0nsybWlTqwz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LeEbOE3Pk2u5vZ9g' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/estate/video/path',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@updatePath',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@updatePath',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::LeEbOE3Pk2u5vZ9g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::agFBhJc1N8lhLjrh' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/estate/video-delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@destroyVideo',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@destroyVideo',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::agFBhJc1N8lhLjrh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3EK3d0A6x85dbCM0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/etch-existing-images/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@fetchExistingImages',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@fetchExistingImages',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::3EK3d0A6x85dbCM0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RjD96bEkCMyXhcsk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/upload-images/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadImages',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadImages',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::RjD96bEkCMyXhcsk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Rwfa2iMRED97wP6f' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/estate/delete-image/{id}/{imageUrl}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@deleteImage',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@deleteImage',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::Rwfa2iMRED97wP6f',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MVp4dLo939R2fnVh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/etch-existing-planned/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@fetchExistingPlanned',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@fetchExistingPlanned',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::MVp4dLo939R2fnVh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Fl6bud8FSBWr1TyA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/upload-planned/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadPlanned',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@uploadPlanned',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::Fl6bud8FSBWr1TyA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eOg2u5AZBQpJQUAJ' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/estate/delete-planned/{id}/{imageUrl}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@deletePlanned',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@deletePlanned',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::eOg2u5AZBQpJQUAJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u22fYSJB35v05rtI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/create-report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@createReport',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@createReport',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::u22fYSJB35v05rtI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zCezqJCGJ1irgvpl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/advantages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@advantage',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@advantage',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::zCezqJCGJ1irgvpl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vBTBdwYV9XOiSHHa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/existing-advantages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@getExistingAdvantages',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@getExistingAdvantages',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::vBTBdwYV9XOiSHHa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::37bCMaVB2tNxFqmT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/validate-advertisement',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@validateAdvertisement',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@validateAdvertisement',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::37bCMaVB2tNxFqmT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oa2nCCi0hnOSBxzq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/platform-compliance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@sendComplianceData',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@sendComplianceData',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::oa2nCCi0hnOSBxzq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BEhoKRoYYmJIBHe0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/estate/check-license',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@check_license',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@check_license',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::BEhoKRoYYmJIBHe0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cRMHzHPWJmBy66DY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/categories-by-type',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@getCategoriesByType',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@getCategoriesByType',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::cRMHzHPWJmBy66DY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::13jiUguX4NU0p7TA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@search',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@search',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::13jiUguX4NU0p7TA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0HpFDGhKCtv8elb4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estate/search-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@get_searched_conversations',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@get_searched_conversations',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estate',
        'where' => 
        array (
        ),
        'as' => 'generated::0HpFDGhKCtv8elb4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::km5ZZPRhOmQglPtu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/customer/notifications',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\NotificationController@get_notifications',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\NotificationController@get_notifications',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::km5ZZPRhOmQglPtu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jnbkcivsYgamoosk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/customer/update-profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@update_profile',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@update_profile',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::jnbkcivsYgamoosk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::n3ji4NGg9s9uRSy2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/customer/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@info',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@info',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::n3ji4NGg9s9uRSy2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UgRlnwY8fWa3E3yM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/customer/complete-agent',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\AgentController@complete_agent',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\AgentController@complete_agent',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::UgRlnwY8fWa3E3yM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::y1Um1ZPnqnH0AleG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/customer/cm-firebase-token',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@update_cm_firebase_token',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@update_cm_firebase_token',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::y1Um1ZPnqnH0AleG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jTVZgUNtO24TIQKh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/customer/my-estate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@info_by_id',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@info_by_id',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::jTVZgUNtO24TIQKh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VQjTNza44tQjNzgs' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/customer/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@delete',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@delete',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::VQjTNza44tQjNzgs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::69Vv33KkiUbFddV6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/customer/nafath-validation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@sendRequest',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@sendRequest',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::69Vv33KkiUbFddV6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o9a2eay8bExzlQIN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/customer/check-request-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@checkRequestStatus',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@checkRequestStatus',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::o9a2eay8bExzlQIN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aVyU2NFnwLlqakSJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/message/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@conversations',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@conversations',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/message',
        'where' => 
        array (
        ),
        'as' => 'generated::aVyU2NFnwLlqakSJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hPdYC7XKjXHihpWD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/message/search-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@get_searched_conversations',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@get_searched_conversations',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/message',
        'where' => 
        array (
        ),
        'as' => 'generated::hPdYC7XKjXHihpWD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F3v755XClAznQOiz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/message/details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@messages',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@messages',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/message',
        'where' => 
        array (
        ),
        'as' => 'generated::F3v755XClAznQOiz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9he2dJwzPFQsK4kV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/message/send',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@messages_store',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@messages_store',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/message',
        'where' => 
        array (
        ),
        'as' => 'generated::9he2dJwzPFQsK4kV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hXZyP8JMCxsfVb17' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/message/chat-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@chat_image',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ConversationController@chat_image',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/message',
        'where' => 
        array (
        ),
        'as' => 'generated::hXZyP8JMCxsfVb17',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tkbNUve5JJx4fOIQ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/wish-list/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\WishlistController@add_to_wishlist',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\WishlistController@add_to_wishlist',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/wish-list',
        'where' => 
        array (
        ),
        'as' => 'generated::tkbNUve5JJx4fOIQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zZtJpObWRdqPo6tm' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/wish-list/remove',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\WishlistController@remove_from_wishlist',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\WishlistController@remove_from_wishlist',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/wish-list',
        'where' => 
        array (
        ),
        'as' => 'generated::zZtJpObWRdqPo6tm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::h3MzSuGyVUyflq2o' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/wish-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\WishlistController@wish_list',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\WishlistController@wish_list',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/wish-list',
        'where' => 
        array (
        ),
        'as' => 'generated::h3MzSuGyVUyflq2o',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::S0ssbD6ygDIFxO4Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/wallet/transactions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\WalletController@transactions',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\WalletController@transactions',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/wallet',
        'where' => 
        array (
        ),
        'as' => 'generated::S0ssbD6ygDIFxO4Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9kHVLean0xZNP54R' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/provider-subscriptions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@index',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@index',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/provider-subscriptions',
        'where' => 
        array (
        ),
        'as' => 'generated::9kHVLean0xZNP54R',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2DNIidnlxtY8xBCG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/provider-subscriptions/offer-setup-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@getOfferSetupData',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@getOfferSetupData',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/provider-subscriptions',
        'where' => 
        array (
        ),
        'as' => 'generated::2DNIidnlxtY8xBCG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rMDxbdtmjBaxGJIH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/provider-subscriptions/calculate-price',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@calculatePrice',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@calculatePrice',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/provider-subscriptions',
        'where' => 
        array (
        ),
        'as' => 'generated::rMDxbdtmjBaxGJIH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hAAF3X1RiT3RCaAi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/provider-subscriptions/store-offer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@storeOfferAPI',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@storeOfferAPI',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/provider-subscriptions',
        'where' => 
        array (
        ),
        'as' => 'generated::hAAF3X1RiT3RCaAi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eusyVrkWyqCrvCj8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/provider-subscriptions/{subscription_number}/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@getSubscriptionStatus',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@getSubscriptionStatus',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/provider-subscriptions',
        'where' => 
        array (
        ),
        'as' => 'generated::eusyVrkWyqCrvCj8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::75XXUflHTaWtnkpk' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/service-provider/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@update',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@update',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-provider',
        'where' => 
        array (
        ),
        'as' => 'generated::75XXUflHTaWtnkpk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tOdUcKUIYP64lAp9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/service-provider/offer-setup-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@getOfferSetupData',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@getOfferSetupData',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-provider',
        'where' => 
        array (
        ),
        'as' => 'generated::tOdUcKUIYP64lAp9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2aWneCWJWpRQmUrU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/service-provider/store-offer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@storeOfferAPI',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceProvidertController@storeOfferAPI',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-provider',
        'where' => 
        array (
        ),
        'as' => 'generated::2aWneCWJWpRQmUrU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HggWtrYDPZxaU5rz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/service-provider/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ProviderPermissionController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ProviderPermissionController@index',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-provider',
        'where' => 
        array (
        ),
        'as' => 'generated::HggWtrYDPZxaU5rz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::y2qZ2AWATpNsNFaB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/manage-permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@allPermissions',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@allPermissions',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/manage-permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::y2qZ2AWATpNsNFaB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1xNuyMie4RtV9diX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/manage-permissions/{id}/assign',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@assign',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@assign',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/manage-permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::1xNuyMie4RtV9diX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mBKtIPfezrbqstSq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/manage-permissions/{id}/revoke',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@revoke',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@revoke',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/manage-permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::mBKtIPfezrbqstSq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::v3MTGq05OyytMPDn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/manage-permissions/{id}/sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@sync',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\UserPermissionController@sync',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/manage-permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::v3MTGq05OyytMPDn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NgF1yBJQ7vWAudNx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/banners',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\BannerController@banners',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\BannerController@banners',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::NgF1yBJQ7vWAudNx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Nj1LSUjYDlRLEDoH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/banners/advertisement/validate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\EstateController@validate2',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\EstateController@validate2',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::Nj1LSUjYDlRLEDoH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Kl7M9uUn0iT1aCH3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/services',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@index',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@index',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::Kl7M9uUn0iT1aCH3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::08QQnsTOyYZIRDoG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/services/filters',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@filtersData',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@filtersData',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::08QQnsTOyYZIRDoG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YEypH7TDiOQiJpgK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/services/my-services',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:services.view',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@myServices',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@myServices',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::YEypH7TDiOQiJpgK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LtPdkMi7iXasW4Jf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/services/{id}/toggle-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:services.toggle-status',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@toggleStatus',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::LtPdkMi7iXasW4Jf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MMRDQo1jzHUXhQqb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/services',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:services.create',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServiceManagementController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServiceManagementController@store',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::MMRDQo1jzHUXhQqb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gnS0l9vgFKKIDEtu' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/services/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:services.update',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServiceManagementController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServiceManagementController@update',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::gnS0l9vgFKKIDEtu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pMsAswt6O0yMK6YO' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/services/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:services.delete',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServiceManagementController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServiceManagementController@destroy',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::pMsAswt6O0yMK6YO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VOLbAfDp3KK1xVWv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/services/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@show',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\ServiceCatalogController@show',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/services',
        'where' => 
        array (
        ),
        'as' => 'generated::VOLbAfDp3KK1xVWv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nArzW93u0wT6jQ2T' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/service-plans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:plans.manage-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@index',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-plans',
        'where' => 
        array (
        ),
        'as' => 'generated::nArzW93u0wT6jQ2T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7iB7pjTH8gdAGznP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/service-plans/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:plans.manage-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@show',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-plans',
        'where' => 
        array (
        ),
        'as' => 'generated::7iB7pjTH8gdAGznP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yxUXavFKcCLQeedZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/service-plans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:plans.manage-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@store',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-plans',
        'where' => 
        array (
        ),
        'as' => 'generated::yxUXavFKcCLQeedZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UHa5KciLgxRKWM5K' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/service-plans/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:plans.manage-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@update',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-plans',
        'where' => 
        array (
        ),
        'as' => 'generated::UHa5KciLgxRKWM5K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZGMnJlacMOuY35cv' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/service-plans/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:plans.manage-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ServicePlanManagementController@destroy',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/service-plans',
        'where' => 
        array (
        ),
        'as' => 'generated::ZGMnJlacMOuY35cv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Wmha1HVkVt9fSq7Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\EstateSearchController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\EstateSearchController@index',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estates',
        'where' => 
        array (
        ),
        'as' => 'generated::Wmha1HVkVt9fSq7Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sG5hKVSbe7FBZYR4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/estates/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\EstateSearchController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\EstateSearchController@show',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/estates',
        'where' => 
        array (
        ),
        'as' => 'generated::sG5hKVSbe7FBZYR4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9C8gWSijMRANjybU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/reports/provider/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:reports.view-own',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@providerDashboard',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@providerDashboard',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/reports',
        'where' => 
        array (
        ),
        'as' => 'generated::9C8gWSijMRANjybU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::91geFjkYI8mHlouQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/reports/global/overview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:reports.view-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalOverview',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalOverview',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/reports/global',
        'where' => 
        array (
        ),
        'as' => 'generated::91geFjkYI8mHlouQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kdvstPySIPUkUSQ3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/reports/global/estates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:reports.view-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalEstates',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalEstates',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/reports/global',
        'where' => 
        array (
        ),
        'as' => 'generated::kdvstPySIPUkUSQ3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kz1AQLv8NnUjbQR8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/reports/global/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:reports.view-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalUsers',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalUsers',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/reports/global',
        'where' => 
        array (
        ),
        'as' => 'generated::kz1AQLv8NnUjbQR8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qt973BiyGOzXpzqf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/reports/global/charts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'provider.api',
          3 => 'provider.permission:reports.view-global',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalCharts',
        'controller' => 'App\\Http\\Controllers\\Api\\v1\\ReportController@globalCharts',
        'namespace' => 'api\\v1',
        'prefix' => 'api/v1/reports/global',
        'where' => 
        array (
        ),
        'as' => 'generated::qt973BiyGOzXpzqf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'change',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\LanguageController@change',
        'controller' => 'App\\Http\\Controllers\\LanguageController@change',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'change',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'showLogin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\LoginController@loginForm',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\LoginController@loginForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'showLogin',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\LoginController@login',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role.showLogin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'agent/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@loginForm',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@loginForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'role.showLogin',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role.login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'agent/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@login',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@login',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'role.login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role.otp.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'agent/auth/otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@otpForm',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@otpForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'role.otp.form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role.otp.verify' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'agent/auth/otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@verifyOtp',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@verifyOtp',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'role.otp.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'role.otp.resend' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'agent/auth/otp/resend',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@resendOtp',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\auth\\RoleLoginController@resendOtp',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'role.otp.resend',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zone.get-coordinates' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'zone/get-coordinates/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@getCoordinates',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@getCoordinates',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'zone.get-coordinates',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estates.index2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'estates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@estates',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@estates',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'estates.index2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estates.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'estates/{estate}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@editEstate',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@editEstate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'estates.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estates.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'estates/{estate}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@updateEstate',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@updateEstate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'estates.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estates.transferIdentity' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'estates/{estate}/transfer-identity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@transferIdentity',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@transferIdentity',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'estates.transferIdentity',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zones-main' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@zones',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@zones',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'zones-main',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@index',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'map' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'map',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@map',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@map',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'map',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nDhSwbrheXoh3lpJ' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Brokerage/PushNotification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@handle',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@handle',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::nDhSwbrheXoh3lpJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'byZone' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'properties/zone/{zone_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\HomeController@getPropertiesByZone',
        'controller' => 'App\\Http\\Controllers\\Web\\HomeController@getPropertiesByZone',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'byZone',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout-details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_details',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_details',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout-details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout-shipping' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout-shipping',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_shipping',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_shipping',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout-shipping',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout-payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout-payment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_payment',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_payment',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout-payment',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout-review' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout-review',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_review',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_review',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout-review',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout-complete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout-complete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getCashOnDeliveryCheckoutComplete',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getCashOnDeliveryCheckoutComplete',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout-complete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offline-payment-checkout-complete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'offline-payment-checkout-complete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getOfflinePaymentCheckoutComplete',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getOfflinePaymentCheckoutComplete',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'offline-payment-checkout-complete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'order-placed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order-placed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@order_placed',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@order_placed',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'order-placed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'shop-cart' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'shop-cart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@shop_cart',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@shop_cart',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'shop-cart',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'order_note' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'order_note',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@order_note',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@order_note',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'order_note',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'digital-product-download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'digital-product-download/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getDigitalProductDownload',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getDigitalProductDownload',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'digital-product-download',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'digital-product-download-otp-verify' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'digital-product-download-otp-verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getDigitalProductDownloadOtpVerify',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getDigitalProductDownloadOtpVerify',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'digital-product-download-otp-verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'digital-product-download-otp-reset' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'digital-product-download-otp-reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getDigitalProductDownloadOtpReset',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getDigitalProductDownloadOtpReset',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'digital-product-download-otp-reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pay-offline-method-list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pay-offline-method-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
          2 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@pay_offline_method_list',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@pay_offline_method_list',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pay-offline-method-list',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout-complete-wallet' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'checkout-complete-wallet',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_complete_wallet',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@checkout_complete_wallet',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout-complete-wallet',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'subscription' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'subscription',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@subscription',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@subscription',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'subscription',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'search-shop' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search-shop',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@search_shop',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@search_shop',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'search-shop',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getAllCategoriesView',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getAllCategoriesView',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'categories',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category-ajax' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'category-ajax/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@categories_by_category',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@categories_by_category',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'category-ajax',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'brands' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'brands',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getAllBrandsView',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getAllBrandsView',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'brands',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'vendors' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'vendors',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getAllVendorsView',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getAllVendorsView',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'vendors',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'seller-profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'seller-profile/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@seller_profile',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@seller_profile',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'seller-profile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'flash-deals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'flash-deals/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getFlashDealsView',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\WebController@getFlashDealsView',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'flash-deals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.step-one' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'website-offers/step-one',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@stepOne',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@stepOne',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.step-one',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.step-one.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'website-offers/step-one',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@stepOneStore',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@stepOneStore',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.step-one.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.step-two' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'website-offers/step-two',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@stepTwo',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@stepTwo',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.step-two',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.step-two.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'website-offers/step-two',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@stepTwoStore',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@stepTwoStore',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.step-two.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.step-three' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'website-offers/step-three',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@stepThree',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@stepThree',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.step-three',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.step-three.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'website-offers/step-three',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@stepThreeStore',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@stepThreeStore',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.step-three.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.preview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'website-offers/preview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@preview',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@preview',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.preview',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'website.offers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'website-offers/website-offers/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\OfferWizardController@store',
        'controller' => 'App\\Http\\Controllers\\OfferWizardController@store',
        'namespace' => 'Web',
        'prefix' => '/website-offers',
        'where' => 
        array (
        ),
        'as' => 'website.offers.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.default-captcha' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/code/captcha/{tmp}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\LoginController@captcha',
        'controller' => 'App\\Http\\Controllers\\LoginController@captcha',
        'as' => 'customer.auth.default-captcha',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@login',
        'as' => 'customer.auth.login',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@submit',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@submit',
        'as' => 'customer.auth.',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@logout',
        'as' => 'customer.auth.logout',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.get-login-modal-data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/get-login-modal-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@get_login_modal_data',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\LoginController@get_login_modal_data',
        'as' => 'customer.auth.get-login-modal-data',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.sign-up' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/sign-up',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@register',
        'as' => 'customer.auth.sign-up',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.sign-up.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/sign-up',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@submit',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@submit',
        'as' => 'customer.auth.sign-up.submit',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.sign-up3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/sign-up3',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@submit',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@submit',
        'as' => 'customer.auth.sign-up3',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.sign-provider' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/sign-provider',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@submit_provider',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@submit_provider',
        'as' => 'customer.auth.sign-provider',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.provider' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/provider',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@provider',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@provider',
        'as' => 'customer.auth.provider',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.about-provider' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/about-provider',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@about_provider',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@about_provider',
        'as' => 'customer.auth.about-provider',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.verify-register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/verify-register/{user_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@showVerificationForm',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@showVerificationForm',
        'as' => 'customer.auth.verify-register',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.resend-register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/resend-register/{user_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@resendOtp',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@resendOtp',
        'as' => 'customer.auth.resend-register',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.check' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/check-register/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@check',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@check',
        'as' => 'customer.auth.check',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.verify' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@verify',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@verify',
        'as' => 'customer.auth.verify',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.ajax_verify' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/ajax-verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@@jax_verify',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@@jax_verify',
        'as' => 'customer.auth.ajax_verify',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.resend_otp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/resend-otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@resend_otp',
        'controller' => 'App\\Http\\Controllers\\Customer\\Auth\\RegisterController@resend_otp',
        'as' => 'customer.auth.resend_otp',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.update-phone' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/update-phone/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\SocialAuthController@editPhone',
        'controller' => 'Web\\Customer\\Auth\\SocialAuthController@editPhone',
        'as' => 'customer.auth.update-phone',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.generated::ER4AOj7sM9F5e147' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/update-phone/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\SocialAuthController@updatePhone',
        'controller' => 'Web\\Customer\\Auth\\SocialAuthController@updatePhone',
        'as' => 'customer.auth.generated::ER4AOj7sM9F5e147',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.service-login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/login/{service}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\SocialAuthController@redirectToProvider',
        'controller' => 'Web\\Customer\\Auth\\SocialAuthController@redirectToProvider',
        'as' => 'customer.auth.service-login',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.service-callback' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/login/{service}/callback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\SocialAuthController@handleProviderCallback',
        'controller' => 'Web\\Customer\\Auth\\SocialAuthController@handleProviderCallback',
        'as' => 'customer.auth.service-callback',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.recover-password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/recover-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password',
        'as' => 'customer.auth.recover-password',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.forgot-password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password_request',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password_request',
        'as' => 'customer.auth.forgot-password',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.otp-verification' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/otp-verification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@otp_verification',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@otp_verification',
        'as' => 'customer.auth.otp-verification',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.generated::1ce77uUjUKGkT5Ph' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/otp-verification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@otp_verification_submit',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@otp_verification_submit',
        'as' => 'customer.auth.generated::1ce77uUjUKGkT5Ph',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.reset-password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/auth/reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password_index',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password_index',
        'as' => 'customer.auth.reset-password',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.generated::kPgEKDueKHr5n5IH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password_submit',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@reset_password_submit',
        'as' => 'customer.auth.generated::kPgEKDueKHr5n5IH',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customer.auth.resend-otp-reset-password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/auth/resend-otp-reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\Customer\\Auth\\ForgotPasswordController@ajax_resend_otp',
        'controller' => 'Web\\Customer\\Auth\\ForgotPasswordController@ajax_resend_otp',
        'as' => 'customer.auth.resend-otp-reset-password',
        'namespace' => 'Web\\Customer\\Auth',
        'prefix' => 'customer/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'support-ticket.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'support-ticket/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@single_ticket',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@single_ticket',
        'as' => 'support-ticket.index',
        'namespace' => 'Web',
        'prefix' => '/support-ticket',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'support-ticket.comment' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'support-ticket/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@comment_submit',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@comment_submit',
        'as' => 'support-ticket.comment',
        'namespace' => 'Web',
        'prefix' => '/support-ticket',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'support-ticket.delete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'support-ticket/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@support_ticket_delete',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@support_ticket_delete',
        'as' => 'support-ticket.delete',
        'namespace' => 'Web',
        'prefix' => '/support-ticket',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'support-ticket.close' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'support-ticket/close/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@support_ticket_close',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@support_ticket_close',
        'as' => 'support-ticket.close',
        'namespace' => 'Web',
        'prefix' => '/support-ticket',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'track-order.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'track-order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order',
        'as' => 'track-order.index',
        'namespace' => 'Web',
        'prefix' => '/track-order',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'track-order.result-view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'track-order/result-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order_result',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order_result',
        'as' => 'track-order.result-view',
        'namespace' => 'Web',
        'prefix' => '/track-order',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'track-order.last' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'track-order/last',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_last_order',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_last_order',
        'as' => 'track-order.last',
        'namespace' => 'Web',
        'prefix' => '/track-order',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'track-order.result' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'track-order/result',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order_result',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order_result',
        'as' => 'track-order.result',
        'namespace' => 'Web',
        'prefix' => '/track-order',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'track-order.order-wise-result-view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'track-order/order-wise-result-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order_wise_result',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\UserProfileController@track_order_wise_result',
        'as' => 'track-order.order-wise-result-view',
        'namespace' => 'Web',
        'prefix' => '/track-order',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'chat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'chat/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
          2 => 'customer',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\ChattingController@index',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\ChattingController@index',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'chat',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'messages' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\ChattingController@getMessageByUser',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\ChattingController@getMessageByUser',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'messages',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jkpi5zaPCWyVZJYm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guestCheck',
        ),
        'uses' => 'Web\\App\\Http\\Controllers\\Web\\ChattingController@addMessage',
        'controller' => 'Web\\App\\Http\\Controllers\\Web\\ChattingController@addMessage',
        'namespace' => 'Web',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Jkpi5zaPCWyVZJYm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user-profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_profile',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_profile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-profile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-account' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user-account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_account',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_account',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-account',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user-account-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getUserProfileUpdate',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getUserProfileUpdate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-picture' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user-account-picture',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_picture',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_picture',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-picture',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-address-add' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-address-add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_address_add',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_address_add',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-address-add',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-address' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-address',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_address',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_address',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-address',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'address-store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account-address-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_store',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'address-store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'address-delete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-address-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_delete',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_delete',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'address-delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'address-edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-address-edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_edit',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'address-edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'address-update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account-address-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_update',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@address_update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'address-update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-payment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_payment',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_payment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-payment',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-estate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-estate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_estate',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_estate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-estate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-order-details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-order-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_order_details',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_order_details',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-order-details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-order-details-vendor-info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-order-details-vendor-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_order_details_seller_info',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_order_details_seller_info',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-order-details-vendor-info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-order-details-delivery-man-info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-order-details-delivery-man-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_order_details_delivery_man_info',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_order_details_delivery_man_info',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-order-details-delivery-man-info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-order-details-reviews' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-order-details-reviews',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getAccountOrderDetailsReviewsView',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getAccountOrderDetailsReviewsView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-order-details-reviews',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generate-invoice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'generate-invoice/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@generate_invoice',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@generate_invoice',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generate-invoice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-wishlist' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-wishlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_wishlist',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_wishlist',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-wishlist',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'refund-request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refund-request/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@refund_request',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@refund_request',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'refund-request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'refund-details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refund-details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@refund_details',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@refund_details',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'refund-details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'refund-store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'refund-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@store_refund',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@store_refund',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'refund-store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-tickets' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-tickets',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_tickets',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_tickets',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-tickets',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'order-cancel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'order-cancel/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@order_cancel',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@order_cancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'order-cancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ticket-submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ticket-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@submitSupportTicket',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@submitSupportTicket',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ticket-submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'account-delete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account-delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_delete',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@account_delete',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'account-delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'refer-earn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refer-earn',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@refer_earn',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@refer_earn',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'refer-earn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-coupons' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user-coupons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_coupons',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@user_coupons',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-coupons',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete-estate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'delete-estate/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@delete_estate',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@delete_estate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'delete-estate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'nafath-validation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nafath-validation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@sendRequestWeb',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@sendRequestWeb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'nafath-validation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'add-license' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'add-license',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@add_license',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@add_license',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'add-license',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'check-license' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'check-license',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@check_license',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@check_license',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'check-license',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'support-ticket' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'support-ticket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@store_ticket',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@store_ticket',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'support-ticket',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'check-request-status' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'check-request-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@checkRequestStatusWeb',
        'controller' => 'App\\Http\\Controllers\\api\\v1\\CustomerController@checkRequestStatusWeb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'check-request-status',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::M5F1c3qvgpmCeD7V' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get-cities/{zone_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@getCities',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@getCities',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::M5F1c3qvgpmCeD7V',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jhy7jPTJUSTEOC8S' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get-districts/{cityId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@getDistricts',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@getDistricts',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jhy7jPTJUSTEOC8S',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'getImages' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'properties/{id}/images',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getImages',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getImages',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'getImages',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'getPlanned' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'properties/{id}/planned',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getPlanned',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@getPlanned',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'getPlanned',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete-property-image' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'properties/{id}/images/{image}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@deleteImage',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@deleteImage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'delete-property-image',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete-property-planned' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'properties/{id}/planned/{image}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@deletePlanned',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@deletePlanned',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'delete-property-planned',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::idmembon0Mt4iyqS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'properties/{id}/upload-images',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@uploadImages',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@uploadImages',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::idmembon0Mt4iyqS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EXUbwNm234TN7W8F' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'properties/{id}/upload-planned',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@uploadPlanned',
        'controller' => 'App\\Http\\Controllers\\Web\\Customer\\UserProfileController@uploadPlanned',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::EXUbwNm234TN7W8F',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'report' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@report',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@report',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'report',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'about-us' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'about-us',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getAboutUsView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getAboutUsView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'about-us',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'contacts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contacts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getContactView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getContactView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'contacts',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'helpTopic' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'helpTopic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getHelpTopicView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getHelpTopicView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'helpTopic',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'refund-policy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refund-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getRefundPolicyView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getRefundPolicyView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'refund-policy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'return-policy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'return-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getReturnPolicyView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getReturnPolicyView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'return-policy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'privacy-policy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'privacy-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getPrivacyPolicyView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getPrivacyPolicyView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'privacy-policy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cancellation-policy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cancellation-policy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getCancellationPolicyView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getCancellationPolicyView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cancellation-policy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'terms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'terms-and-condition',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\PageController@getTermsAndConditionView',
        'controller' => 'App\\Http\\Controllers\\Web\\PageController@getTermsAndConditionView',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'terms',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'create-estate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'create-estate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@create_estate',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@create_estate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'create-estate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store-estate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'store-estate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'customer',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@store_estate',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@store_estate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'store-estate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.filter' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categories/filter',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@filterCategories',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@filterCategories',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'categories.filter',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@get_details',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@get_details',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@search',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@search',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'search',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wishlist' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wishlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@wishlist',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@wishlist',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'wishlist',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'getfv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getfv',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@getfv',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@getfv',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'getfv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'upload-videos' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'upload-videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\EstateController@uploadVideosWeb',
        'controller' => 'App\\Http\\Controllers\\Web\\EstateController@uploadVideosWeb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'upload-videos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'view-wishlist' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'view-wishlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\WishlistController@viewWishlist',
        'controller' => 'App\\Http\\Controllers\\Web\\WishlistController@viewWishlist',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'view-wishlist',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete-wishlist' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'delete-wishlist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Web\\WishlistController@deleteWishlist',
        'controller' => 'App\\Http\\Controllers\\Web\\WishlistController@deleteWishlist',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'delete-wishlist',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'estate/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\EstateContrller@create',
        'controller' => 'App\\Http\\Controllers\\EstateContrller@create',
        'namespace' => NULL,
        'prefix' => '/estate',
        'where' => 
        array (
        ),
        'as' => 'home.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'estate/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\EstateContrller@store',
        'controller' => 'App\\Http\\Controllers\\EstateContrller@store',
        'namespace' => NULL,
        'prefix' => '/estate',
        'where' => 
        array (
        ),
        'as' => 'home.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estate.success' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'estate/success',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\EstateContrller@success',
        'controller' => 'App\\Http\\Controllers\\EstateContrller@success',
        'namespace' => NULL,
        'prefix' => '/estate',
        'where' => 
        array (
        ),
        'as' => 'estate.success',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'video.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoController@create',
        'controller' => 'App\\Http\\Controllers\\VideoController@create',
        'namespace' => NULL,
        'prefix' => '/video',
        'where' => 
        array (
        ),
        'as' => 'video.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'store.video' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'video/video-upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoController@uploadVideo',
        'controller' => 'App\\Http\\Controllers\\VideoController@uploadVideo',
        'namespace' => NULL,
        'prefix' => '/video',
        'where' => 
        array (
        ),
        'as' => 'store.video',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'video.success' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video/success',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\EstateContrller@success',
        'controller' => 'App\\Http\\Controllers\\EstateContrller@success',
        'namespace' => NULL,
        'prefix' => '/video',
        'where' => 
        array (
        ),
        'as' => 'video.success',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8mk2mTguSPUstldG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:558:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:339:"function () {
    // for($i = 0; $i <=12;$i++) {

    //     $image = new EstateImage();

    //     $image->image = \'service-providers/NdFiwmmuVf3gj4gXWjJd6NbEMekNMATjxVWAjTGz.png\';
    //     $image->estate_id = 1;
    //     $image->save();

    // }
    // return Offer::all();

    \\dd(\\auth()->guard(\'user\')->check());
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007050000000000000000";}";s:4:"hash";s:44:"4aNa9oBn48qBuCI7ir1iZ9x4b94B/N5tEE75sV7RRYI=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::8mk2mTguSPUstldG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:338:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:119:"function () {
    \\Illuminate\\Support\\Facades\\Auth::guard(\'admin\')->logout();

    return \\to_route(\'showLogin\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007940000000000000000";}";s:4:"hash";s:44:"YK9n8Boeg+13oPcGBCf0XyfbwMzVFX/ZFsmwiRsy8Os=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'admin.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agent.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'agent/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:342:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:123:"function () {
    \\Illuminate\\Support\\Facades\\Auth::guard(\'user\')->logout();

    return \\to_route(\'role.showLogin\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007960000000000000000";}";s:4:"hash";s:44:"KdhyWAWaDWnMowre1qqsh/hRlRFdHnNhJFLDp6sdrmI=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'agent.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'getEmployees' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'getEmployees',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@getUser',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@getUser',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'getEmployees',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3qxJri7s0qaBCCmf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'advertisement/validate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@validateAdvertisement',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@validateAdvertisement',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'csrf',
        ),
        'as' => 'generated::3qxJri7s0qaBCCmf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admins.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/admins',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AdminController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AdminController@index',
        'namespace' => NULL,
        'prefix' => 'admin/settings/admins',
        'where' => 
        array (
        ),
        'as' => 'admins.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admins.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/admins/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AdminController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AdminController@create',
        'namespace' => NULL,
        'prefix' => 'admin/settings/admins',
        'where' => 
        array (
        ),
        'as' => 'admins.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admins.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/admins/edit/{admin}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AdminController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AdminController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/settings/admins',
        'where' => 
        array (
        ),
        'as' => 'admins.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admins.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings/admins/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AdminController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AdminController@store',
        'namespace' => NULL,
        'prefix' => 'admin/settings/admins',
        'where' => 
        array (
        ),
        'as' => 'admins.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admins.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/settings/admins/update/{admin}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AdminController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AdminController@update',
        'namespace' => NULL,
        'prefix' => 'admin/settings/admins',
        'where' => 
        array (
        ),
        'as' => 'admins.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@index',
        'namespace' => NULL,
        'prefix' => 'admin/settings/roles',
        'where' => 
        array (
        ),
        'as' => 'roles.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/roles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@create',
        'namespace' => NULL,
        'prefix' => 'admin/settings/roles',
        'where' => 
        array (
        ),
        'as' => 'roles.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/roles/edit/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/settings/roles',
        'where' => 
        array (
        ),
        'as' => 'roles.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings/roles/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@store',
        'namespace' => NULL,
        'prefix' => 'admin/settings/roles',
        'where' => 
        array (
        ),
        'as' => 'roles.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/settings/roles/update/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\RoleController@update',
        'namespace' => NULL,
        'prefix' => 'admin/settings/roles',
        'where' => 
        array (
        ),
        'as' => 'roles.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'permissions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@index',
        'namespace' => NULL,
        'prefix' => 'admin/settings/permissions',
        'where' => 
        array (
        ),
        'as' => 'permissions.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'permissions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/permissions/edit/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/settings/permissions',
        'where' => 
        array (
        ),
        'as' => 'permissions.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'permissions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings/permissions/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@store',
        'namespace' => NULL,
        'prefix' => 'admin/settings/permissions',
        'where' => 
        array (
        ),
        'as' => 'permissions.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'permissions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/settings/permissions/update/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\PermissionController@update',
        'namespace' => NULL,
        'prefix' => 'admin/settings/permissions',
        'where' => 
        array (
        ),
        'as' => 'permissions.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change-status' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/change-status/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\setting\\StatusController@changeStatus',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\setting\\StatusController@changeStatus',
        'namespace' => NULL,
        'prefix' => 'admin/settings',
        'where' => 
        array (
        ),
        'as' => 'change-status',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@index',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
        'as' => 'categories.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/categories/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@store',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
        'as' => 'categories.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories/edit/{category}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
        'as' => 'categories.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/categories/update/{category}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@update',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
        'as' => 'categories.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.sub-categories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories/sub',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@indexSubCategories',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\CategoryController@indexSubCategories',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
        'as' => 'categories.sub-categories',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'properties.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/properties',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@index',
        'namespace' => NULL,
        'prefix' => 'admin/properties',
        'where' => 
        array (
        ),
        'as' => 'properties.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'properties.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/properties/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@store',
        'namespace' => NULL,
        'prefix' => 'admin/properties',
        'where' => 
        array (
        ),
        'as' => 'properties.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'properties.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/properties/edit/{property}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/properties',
        'where' => 
        array (
        ),
        'as' => 'properties.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'properties.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/properties/update/{property}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PropertyController@update',
        'namespace' => NULL,
        'prefix' => 'admin/properties',
        'where' => 
        array (
        ),
        'as' => 'properties.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'territories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/territories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@index',
        'namespace' => NULL,
        'prefix' => 'admin/territories',
        'where' => 
        array (
        ),
        'as' => 'territories.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'territories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/territories/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@store',
        'namespace' => NULL,
        'prefix' => 'admin/territories',
        'where' => 
        array (
        ),
        'as' => 'territories.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'territories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/territories/edit/{territory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/territories',
        'where' => 
        array (
        ),
        'as' => 'territories.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'territories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/territories/update/{territory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\TerritoryController@update',
        'namespace' => NULL,
        'prefix' => 'admin/territories',
        'where' => 
        array (
        ),
        'as' => 'territories.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zones.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/zones',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@index',
        'namespace' => NULL,
        'prefix' => 'admin/zones',
        'where' => 
        array (
        ),
        'as' => 'zones.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zones.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/zones/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@create',
        'namespace' => NULL,
        'prefix' => 'admin/zones',
        'where' => 
        array (
        ),
        'as' => 'zones.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zones.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/zones/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@store',
        'namespace' => NULL,
        'prefix' => 'admin/zones',
        'where' => 
        array (
        ),
        'as' => 'zones.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zones.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/zones/edit/{zone}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/zones',
        'where' => 
        array (
        ),
        'as' => 'zones.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'zones.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/zones/update/{zone}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ZoneController@update',
        'namespace' => NULL,
        'prefix' => 'admin/zones',
        'where' => 
        array (
        ),
        'as' => 'zones.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'provinces.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/provinces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@index',
        'namespace' => NULL,
        'prefix' => 'admin/provinces',
        'where' => 
        array (
        ),
        'as' => 'provinces.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'provinces.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/provinces/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@store',
        'namespace' => NULL,
        'prefix' => 'admin/provinces',
        'where' => 
        array (
        ),
        'as' => 'provinces.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'provinces.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/provinces/edit/{province}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/provinces',
        'where' => 
        array (
        ),
        'as' => 'provinces.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'provinces.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/provinces/update/{province}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ProvinceController@update',
        'namespace' => NULL,
        'prefix' => 'admin/provinces',
        'where' => 
        array (
        ),
        'as' => 'provinces.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-providers.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-providers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@index',
        'namespace' => NULL,
        'prefix' => 'admin/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-providers.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-providers.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-providers/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@create',
        'namespace' => NULL,
        'prefix' => 'admin/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-providers.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-providers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/service-providers/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@store',
        'namespace' => NULL,
        'prefix' => 'admin/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-providers.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-providers.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-providers/edit/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-providers.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-providers.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/service-providers/update/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceProviderController@update',
        'namespace' => NULL,
        'prefix' => 'admin/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-providers.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.offers.toggle-status' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/service-providers/service-provider/offers/{offer}/toggle-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferController@toggleStatus',
        'namespace' => NULL,
        'prefix' => 'admin/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.offers.toggle-status',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/agents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@index',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/agents/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@create',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/agents/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@store',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/agents/edit/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/agents/update/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@update',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.real-estate-offices' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/agents/real-estate-offices',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@getRealEstateOfficesAgents',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@getRealEstateOfficesAgents',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.real-estate-offices',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.real-estate-companies' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/agents/real-estate-companies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@getRealEstateCompaniesAgents',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@getRealEstateCompaniesAgents',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.real-estate-companies',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agents.individuals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/agents/individuals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\AgentController@getIndividualsAgents',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\AgentController@getIndividualsAgents',
        'namespace' => NULL,
        'prefix' => 'admin/agents',
        'where' => 
        array (
        ),
        'as' => 'agents.individuals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-types.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-types',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@index',
        'namespace' => NULL,
        'prefix' => 'admin/service-types',
        'where' => 
        array (
        ),
        'as' => 'service-types.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/service-types/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@store',
        'namespace' => NULL,
        'prefix' => 'admin/service-types',
        'where' => 
        array (
        ),
        'as' => 'service-types.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-types.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-types/edit/{serviceType}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/service-types',
        'where' => 
        array (
        ),
        'as' => 'service-types.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-types.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/service-types/update/{serviceType}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServiceTypeController@update',
        'namespace' => NULL,
        'prefix' => 'admin/service-types',
        'where' => 
        array (
        ),
        'as' => 'service-types.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offers.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/offers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferController@index',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'offers.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offers.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/offers/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferController@create',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'offers.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/offers/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferController@store',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'offers.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offers.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/offers/edit/{offer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'offers.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offers.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/offers/update/{offer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferController@update',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'offers.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'send.offer.page' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/offers/{offer}/send-offer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferOperationController@sendOfferPage',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferOperationController@sendOfferPage',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'send.offer.page',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'send.offer.page.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/offers/{offer}/send-offer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferOperationController@sendedOffer',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferOperationController@sendedOffer',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'send.offer.page.post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'offers.sent' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/offers/sent',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\OfferOperationController@getOffersSent',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\OfferOperationController@getOffersSent',
        'namespace' => NULL,
        'prefix' => 'admin/offers',
        'where' => 
        array (
        ),
        'as' => 'offers.sent',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'notification.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/notification/add-new',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\NotificationController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\NotificationController@index',
        'namespace' => NULL,
        'prefix' => 'admin/notification',
        'where' => 
        array (
        ),
        'as' => 'notification.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'notification.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/notification/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\NotificationController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\NotificationController@store',
        'namespace' => NULL,
        'prefix' => 'admin/notification',
        'where' => 
        array (
        ),
        'as' => 'notification.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'banners.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/banners',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BannerController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BannerController@index',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
        'as' => 'banners.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'banners.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/banners/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BannerController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BannerController@store',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
        'as' => 'banners.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'banners.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/banners/delete/{banner}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BannerController@delete',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BannerController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
        'as' => 'banners.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'packages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/packages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PackageController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PackageController@index',
        'namespace' => NULL,
        'prefix' => 'admin/packages',
        'where' => 
        array (
        ),
        'as' => 'packages.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'packages.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/packages/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PackageController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PackageController@create',
        'namespace' => NULL,
        'prefix' => 'admin/packages',
        'where' => 
        array (
        ),
        'as' => 'packages.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'packages.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/packages/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PackageController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PackageController@store',
        'namespace' => NULL,
        'prefix' => 'admin/packages',
        'where' => 
        array (
        ),
        'as' => 'packages.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'packages.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/packages/edit/{package}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PackageController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PackageController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/packages',
        'where' => 
        array (
        ),
        'as' => 'packages.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'packages.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/packages/update/{package}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PackageController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PackageController@update',
        'namespace' => NULL,
        'prefix' => 'admin/packages',
        'where' => 
        array (
        ),
        'as' => 'packages.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'message.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/message/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ConversationController@list',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ConversationController@list',
        'namespace' => NULL,
        'prefix' => 'admin/message',
        'where' => 
        array (
        ),
        'as' => 'message.list',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'message.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/message/store/{user_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ConversationController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ConversationController@store',
        'namespace' => NULL,
        'prefix' => 'admin/message',
        'where' => 
        array (
        ),
        'as' => 'message.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'message.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/message/view/{conversation_id}/{user_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ConversationController@view',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ConversationController@view',
        'namespace' => NULL,
        'prefix' => 'admin/message',
        'where' => 
        array (
        ),
        'as' => 'message.view',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estate.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/estate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@index',
        'namespace' => NULL,
        'prefix' => 'admin/estate',
        'where' => 
        array (
        ),
        'as' => 'estate.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estate.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/estate/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@create',
        'namespace' => NULL,
        'prefix' => 'admin/estate',
        'where' => 
        array (
        ),
        'as' => 'estate.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estate.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/estate/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@store',
        'namespace' => NULL,
        'prefix' => 'admin/estate',
        'where' => 
        array (
        ),
        'as' => 'estate.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estate.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/estate/edit/{package}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/estate',
        'where' => 
        array (
        ),
        'as' => 'estate.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estate.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/estate/update/{package}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@update',
        'namespace' => NULL,
        'prefix' => 'admin/estate',
        'where' => 
        array (
        ),
        'as' => 'estate.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'business-settings.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/business-settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@index',
        'namespace' => NULL,
        'prefix' => 'admin/business-settings',
        'where' => 
        array (
        ),
        'as' => 'business-settings.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'business-settings.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/business-settings/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@create',
        'namespace' => NULL,
        'prefix' => 'admin/business-settings',
        'where' => 
        array (
        ),
        'as' => 'business-settings.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'business-settings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/business-settings/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@store',
        'namespace' => NULL,
        'prefix' => 'admin/business-settings',
        'where' => 
        array (
        ),
        'as' => 'business-settings.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'business-settings.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/business-settings/edit/{package}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/business-settings',
        'where' => 
        array (
        ),
        'as' => 'business-settings.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'business-settings.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/business-settings/update/{package}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EstateController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EstateController@update',
        'namespace' => NULL,
        'prefix' => 'admin/business-settings',
        'where' => 
        array (
        ),
        'as' => 'business-settings.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-plans.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-plans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@index',
        'namespace' => NULL,
        'prefix' => 'admin/service-plans',
        'where' => 
        array (
        ),
        'as' => 'service-plans.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-plans.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-plans/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@create',
        'namespace' => NULL,
        'prefix' => 'admin/service-plans',
        'where' => 
        array (
        ),
        'as' => 'service-plans.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-plans.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/service-plans/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@store',
        'namespace' => NULL,
        'prefix' => 'admin/service-plans',
        'where' => 
        array (
        ),
        'as' => 'service-plans.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-plans.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service-plans/edit/{servicePlan}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/service-plans',
        'where' => 
        array (
        ),
        'as' => 'service-plans.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-plans.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/service-plans/update/{servicePlan}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@update',
        'namespace' => NULL,
        'prefix' => 'admin/service-plans',
        'where' => 
        array (
        ),
        'as' => 'service-plans.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-plans.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/service-plans/delete/{servicePlan}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ServicePlanController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/service-plans',
        'where' => 
        array (
        ),
        'as' => 'service-plans.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reports',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ReportController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ReportController@index',
        'namespace' => NULL,
        'prefix' => 'admin/reports',
        'where' => 
        array (
        ),
        'as' => 'reports.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.estates.chart' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reports/estates/chart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ReportController@estatesChartData',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ReportController@estatesChartData',
        'namespace' => NULL,
        'prefix' => 'admin/reports',
        'where' => 
        array (
        ),
        'as' => 'reports.estates.chart',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.users.chart' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reports/users/chart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ReportController@usersChartData',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ReportController@usersChartData',
        'namespace' => NULL,
        'prefix' => 'admin/reports',
        'where' => 
        array (
        ),
        'as' => 'reports.users.chart',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.estates.breakdown' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reports/estates/breakdown',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ReportController@estatesBreakdown',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ReportController@estatesBreakdown',
        'namespace' => NULL,
        'prefix' => 'admin/reports',
        'where' => 
        array (
        ),
        'as' => 'reports.estates.breakdown',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.users.breakdown' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reports/users/breakdown',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ReportController@usersBreakdown',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ReportController@usersBreakdown',
        'namespace' => NULL,
        'prefix' => 'admin/reports',
        'where' => 
        array (
        ),
        'as' => 'reports.users.breakdown',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'agentOk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'agents/test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'agent',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:267:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:49:"function () {
        // dd("iam agent");
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000079d0000000000000000";}";s:4:"hash";s:44:"LckqSv3+dut7+9qqi6YRS7BP72gfDWNYGC5J2m7ZUt4=";}}',
        'namespace' => NULL,
        'prefix' => '/agents',
        'where' => 
        array (
        ),
        'as' => 'agentOk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estates.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'agents/estates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'agent',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\agent\\EstateController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\agent\\EstateController@index',
        'namespace' => NULL,
        'prefix' => '/agents',
        'where' => 
        array (
        ),
        'as' => 'estates.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'estates.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'agents/estates/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'agent',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\agent\\EstateController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\agent\\EstateController@create',
        'namespace' => NULL,
        'prefix' => '/agents',
        'where' => 
        array (
        ),
        'as' => 'estates.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'provider.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'provider.profile.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'providers.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'providers/profile/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'providers.profile.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\DashboardController@dashboard',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\DashboardController@dashboard',
        'namespace' => NULL,
        'prefix' => 'service-providers/dashboard',
        'where' => 
        array (
        ),
        'as' => 'service-provider.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.change-language' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'service-providers/dashboard/change-language',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\DashboardController@changeLanguage',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\DashboardController@changeLanguage',
        'namespace' => NULL,
        'prefix' => 'service-providers/dashboard',
        'where' => 
        array (
        ),
        'as' => 'service-provider.change-language',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'shop' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/shop/{shop}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@show',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'shop',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.offers.pending' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/map',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@index',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.offers.pending',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.offers.display' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/{offer}/display',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@dispalyOffer',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@dispalyOffer',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.offers.display',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.offers.status.accept' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/{offer}/status-accept',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@changeStatusAccpetOffer',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@changeStatusAccpetOffer',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.offers.status.accept',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.offers.accept' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/accept',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@acceptOffers',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@acceptOffers',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.offers.accept',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.owner.offers.pending' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/owner/pending',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@peindingOwnerOffers',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@peindingOwnerOffers',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.owner.offers.pending',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.owner.offers.accept' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/owner/accept',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@acceptOwnerOffers',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@acceptOwnerOffers',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.owner.offers.accept',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.create-offer' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/create-offer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@createOffer',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@createOffer',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.create-offer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.edit-offer' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/edit-offer/{offer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@edit',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.edit-offer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.delete-offer' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/delete-offer/{offer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@delete',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@delete',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.delete-offer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.update-offer' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'service-providers/offers/update-offer/{offer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@update',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.update-offer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.store-offer' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'service-providers/offers/store-offer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@storeOffer',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@storeOffer',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.store-offer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/offers/payment/{offer_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@payment',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\OfferController@payment',
        'namespace' => NULL,
        'prefix' => 'service-providers/offers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.payment',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/profile/index',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@index',
        'as' => 'profile.index',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/profile/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@getUpdateView',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@getUpdateView',
        'as' => 'profile.update',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'service-providers/profile/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@update',
        'as' => 'profile.',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.generated::MALVPX9dv6h146BH' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'service-providers/profile/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@updatePassword',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@updatePassword',
        'as' => 'profile.generated::MALVPX9dv6h146BH',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.update-bank-info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/profile/update-bank-info/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@getBankInfoUpdateView',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@getBankInfoUpdateView',
        'as' => 'profile.update-bank-info',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.generated::tNYWgP4cVoEh2uzT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'service-providers/profile/update-bank-info/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@updateBankInfo',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@updateBankInfo',
        'as' => 'profile.generated::tNYWgP4cVoEh2uzT',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.profile.dispaly' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@display',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@display',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
        'as' => 'service-provider.profile.dispaly',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'service-providers/profile/update/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\ProfileController@update',
        'namespace' => NULL,
        'prefix' => 'service-providers/profile',
        'where' => 
        array (
        ),
        'as' => 'service-provider.profile.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'service-provider.estaes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'service-providers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'provider',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\EstaeController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\serviceProvider\\EstaeController@index',
        'namespace' => NULL,
        'prefix' => '/service-providers',
        'where' => 
        array (
        ),
        'as' => 'service-provider.estaes.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
