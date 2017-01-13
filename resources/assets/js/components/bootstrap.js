/*
 |--------------------------------------------------------------------------
 | Laravel Components
 |--------------------------------------------------------------------------
 |
 | Here we will load the components which makes up the core
 | application. This is also a convenient spot for you to load all of
 | your components that you write while building your applications.
 */

// Admin
require('./admin/admin-settings');

require('./admin/publishers');
require('./admin/publisher-profile');
require('./admin/modals/add-publisher');

require('./admin/modals/add-stat');
require('./admin/modals/edit-stat');

require('./admin/articles');
require('./admin/article-profile');
require('./admin/modals/add-article');
require('./admin/modals/edit-article');

require('./admin/widget-settings');