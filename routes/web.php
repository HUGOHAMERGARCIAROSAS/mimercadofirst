<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * ADMIN
 */

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login');
Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

   

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/administrador/pyrus/jinatin/login', 'Admin\AdminController@index')->name('admin.index');

    Route::post('checkout/cambiar/{id}', 'Web\CheckoutController@cambiar')->name('admin.cambiar');
    Route::post('/admin/products/existSlider', 'Admin\ProductController@existSlider')->name('admin.product.existProduct');
    Route::post('/admin/products/updateOrder', 'Admin\ProductController@updateOrder')->name('admin.product.updateOrder');
    Route::post('update_orden', 'Admin\ProductController@update_orden');
    Route::post('update_disponible', 'Admin\ProductController@update_disponible');
    Route::post('update_product_today', 'Admin\ProductController@update_product_today');
    Route::post('update_productScale', 'Admin\ProductController@updateProductScale')->name('admin.product.updateProductScale');
    Route::post('update_productUnitMeasure', 'Admin\ProductController@updateProductUnitMeasure')->name('admin.product.updateProductUnitMeasure');
    Route::post('update_productPrice', 'Admin\ProductController@updateProductPrice')->name('admin.product.updateProductPrice');
    Route::post('update_product', 'Admin\ProductController@updateInIndex')->name('admin.product.updateInIndex');
    Route::get('/admin/products/updateCategory', 'Admin\ProductController@updateCategory')->name('admin.product.updateCategory');
    Route::post('/admin/products/updateCategory', 'Admin\ProductController@updateCategory2')->name('admin.product.updateCategory2');
    Route::post('/admin/products/searchSubCategoryAjax', 'Admin\ProductController@searchSubCategoryAjax')->name('admin.product.searchSubCategory');
    Route::post('/admin/products/searchSubCategory2Ajax', 'Admin\ProductController@searchSubCategory2Ajax')->name('admin.product.searchSubCategory2');
    Route::get('/admin/products/listProducts', 'Admin\ProductController@listProductsDataTable')->name('admin.product.listProducts');
    Route::get('/admin/products/listProducts/prov/{xd}', 'Admin\ProviderController@listProductsDataTable')->name('admin.product.listProducts.prov');
    Route::get('/admin/products/listProductsCategory', 'Admin\ProductController@listProductsDataTableCategory')->name('admin.product.listProductsCategory');
    Route::get('/admin/products/exportProducts/{id}', 'Admin\ProductController@exportProduct')->name('admin.product.exportProduct');
    Route::get('/admin/products/exportCategorias/{id}', 'Admin\ProductController@exportCategoria')->name('admin.product.exportCategory');
    Route::resource('/admin/products', 'Admin\ProductController');


    //GALERIA DEL PRODUCTO
Route::get('/productos/galeria/{id}','Admin\GaleriaController@index')->name('productos.galeria');
Route::post('/productos/galeria/{id}','Admin\GaleriaController@store')->name('productos.galeria.agregar');
Route::get('/productos/galeria-delete/{id}','Admin\GaleriaController@delete')->name('productos.galeria-delete');

    Route::resource('/admin/coupons', 'Admin\CouponController');
    Route::get('/departamento/{departamento_id}/provincia', 'Admin\CouponController@getProvincias');
    Route::get('/provincia/{provincia_id}/distrito', 'Admin\CouponController@getDistritos');

    Route::get('/admin/providers/index','Admin\ProviderController@index')->name('admin.providers.index');
    Route::get('/admin/providers/create','Admin\ProviderController@create')->name('admin.providers.create');
    Route::post('/admin/providers/store','Admin\ProviderController@store')->name('admin.providers.store');
    Route::post('/admin/providers/guardar','Admin\ProviderController@guardar')->name('admin.providers.guardar');
        Route::get('/admin/providers/guardar/productos/{id}','Admin\ProviderController@createProduct')->name('products_provider.create');
        Route::get('/admin/providers/ver/categoria/{id}','Admin\ProviderController@categoryVer')->name('products_provider.category.ver');
        Route::post('/admin/providers/guardar/categoria','Admin\ProviderController@store_category')->name('categories_desde_prov.store');
        Route::get('/admin/providers/productos','Admin\ProviderController@productos')->name('admin.providers.productos');
        Route::get('/provider/update-visibilidad/{id}','Admin\ProviderController@updateVisibilidad')->name('provider.update-visibilidad');
        Route::get('/admin/users', 'Admin\UserController@index')->name('admin.users.index');
        Route::post('update_productOrden', 'Admin\ProductController@updateProductOrden')->name('admin.product.updateProductOrden');

    Route::post('update_productPorcentaje', 'Admin\ProductController@updateProductPorcentaje')->name('admin.product.updateProductPorcentaje');
    Route::post('update_productMonto', 'Admin\ProductController@updateProductMonto')->name('admin.product.updateProductMonto');
    Route::post('update_productFinal', 'Admin\ProductController@updateProductFinal')->name('admin.product.updateProductFinal');
    Route::resource('/admin/tips', 'Admin\TipController');

    Route::resource('/admin/recipes', 'Admin\RecipeController');

    Route::resource('/admin/store-image', 'Admin\StoreImageController');

    Route::get('/admin/orders', 'Admin\OrderController@index')->name('admin.order.index');
    Route::get('/admin/orders/{id}/show', 'Admin\OrderController@show')->name('admin.order.show');
    Route::delete('/admin/orders/{id}', 'Admin\OrderController@destroy')->name('admin.order.destroy');
    Route::get('/admin/export/{id}', 'Admin\OrderController@export')->name('admin.order.export');

    Route::get('/admin/subscribers', 'Admin\SubscriberController@index')->name('admin.subscriber.index');
    Route::get('/admin/subscribers/exportSubscribers', 'Admin\SubscriberController@exportSubscribers')->name('admin.subscriber.exportSubscribers');

    Route::group([], function () {
        Route::get('/admin/slider/slider_product/categories', 'Admin\SliderProductController@listCategories')->name('admin.slider.listCategories');
        Route::resource('/admin/slider', 'Admin\SliderController');
        Route::resource('/admin/slider/advertising', 'Admin\SliderAdvertisingController');
        Route::resource('/admin/slider/slider_product', 'Admin\SliderProductController');
        Route::post('/admin/slider/updateAvailable', 'Admin\SliderController@updateAvailable')->name('admin.slider.updateAvailable');
    });
    
    
    
     /*Proveedores*/
    
    Route::get('/admin/providers/index','Admin\ProviderController@index')->name('admin.providers.index');
    Route::get('/admin/providers/create','Admin\ProviderController@create')->name('admin.providers.create');
    Route::post('/admin/providers/store','Admin\ProviderController@store')->name('admin.providers.store');
    Route::post('/admin/providers/guardar','Admin\ProviderController@guardar')->name('admin.providers.guardar');
    Route::get('/admin/providers/orders', 'Admin\ProviderController@pedidos')->name('admin.providers.pedidos');
    
    //Route::get('/admin/providers/asignar','Admin\ProviderController@updateCategory')->name('admin.providers.asignar');
    //Route::post('/admin/products/asignacion', 'Admin\ProviderController@updateCategory2')->name('admin.provider.updateCategory2');
    Route::get('/admin/providers/productos/edit/{id}','Admin\ProviderController@edit')->name('admin.providers.edit');
    Route::get('/admin/providers/productos','Admin\ProviderController@productos')->name('admin.providers.productos');
    Route::get('/admin/provider/listProducts', 'Admin\ProviderController@listProductsDataTable')->name('admin.provider.listProducts');
    Route::post('provider/update_productPrice', 'Admin\ProviderController@updateProductPrice')->name('admin.provider.updateProductPrice');
    Route::get('provider/updateProductWithAjax', 'Admin\ProviderController@updateProductWithAjax')->name('admin.provider.updateAjaxProduct');
    Route::post('/admin/provider/existSlider', 'Admin\ProviderController@existSlider')->name('admin.provider.existProduct');
    Route::post('provider/update_productPrice', 'Admin\ProviderController@updateProductPrice')->name('admin.provider.updateProductPrice');
    Route::post('/admin/provider/updateOrder', 'Admin\ProviderController@updateOrder')->name('admin.provider.updateOrder');
    Route::post('provider/update_product', 'Admin\ProductController@updateInIndex')->name('admin.provider.updateInIndex');
    Route::get('/updateproviderproduct', 'Admin\ProviderProductoController@updateProductWithAjax')->name('admin.producto.updateAjaxProduct');
    Route::get('/admin/productos/listProductss', 'Admin\ProviderProductoController@listProductsDataTable')->name('admin.producto.listProducts');
    Route::delete('/provider/delete/{id}', 'Admin\ProviderProductoController@destroy')->name('admin.provider.destroy');
    Route::get('/admin/provider/ver/{id}', 'Admin\ProviderController@ver')->name('admin.provider.ver');
    Route::post('actualizar_usuario/{id}', 'Admin\ProviderController@updateUser')->name('admin.provider.update');

    Route::resource('/admin/shipping-cost', 'Admin\ShippingCostController');
    Route::post('/admin/shipping-cost/updateOrder', 'Admin\ShippingCostController@updateOrder')->name('admin.shipping.updateOrder');
    Route::post('/admin/shipping-cost/update_in_table', 'Admin\ShippingCostController@updateInTable')->name('admin.shipping.updateInTable');

    Route::resource('/admin/comments', 'Admin\CommentController');

    Route::resource('/admin/banners', 'Admin\BannerController');

    Route::resource('/admin/categories', 'Admin\CategoryController');
    Route::post('/admin/categories/changeOrder', 'Admin\CategoryController@changeOrder')->name('admin.category.changeOrder');
    Route::post('/admin/categories/update_in_table', 'Admin\CategoryController@updateInTable')->name('admin.category.updateInTable');
    Route::post('/admin/categories/search', 'Admin\CategoryController@search')->name('admin.category.search');
    Route::post('/admin/categories/searchSubCategories', 'Admin\CategoryController@searchSubCategories')->name('admin.category.searchSubCategories');

    //CATEGORIAS DEL PROVEEDOR
    Route::resource('/admin/categories_prov', 'Admin\CategoryProvController');
    Route::post('/admin/categories_prov/changeOrder', 'Admin\CategoryProvController@changeOrder')->name('admin.category_prov.changeOrder');
    Route::post('/admin/categories_prov/update_in_table', 'Admin\CategoryProvController@updateInTable')->name('admin.category_prov.updateInTable');
    Route::post('/admin/categories_prov/search', 'Admin\CategoryProvController@search')->name('admin.category_prov.search');
    Route::post('/admin/categories_prov/searchSubCategories', 'Admin\CategoryProvController@searchSubCategories')->name('admin.category_prov.searchSubCategories');
    
    Route::get('/categoria/{category_id}/buscar', 'Admin\CategoryProvController@buscarSubCategorias');
    //CATEGORIAS DEL PROVEEDOR

    Route::resource('/admin/subcategories-1', 'Admin\SubCategoryController');
    Route::post('/admin/subcategories/update_in_table', 'Admin\SubCategoryController@updateInTable')->name('admin.subcategory.updateInTable');

    Route::resource('/admin/subcategories-2', 'Admin\ProductSubCategoryController');
    Route::post('/admin/subcategories-2/update_in_table', 'Admin\ProductSubCategoryController@updateInTable')->name('admin.productsubcategory.updateInTable');

    // import
    Route::get('/admin/import', 'Admin\ImportController@index')->name('admin.import.index');
    Route::get('/admin/import/loadExcel', 'Admin\ImportController@loadExcel')->name('admin.import.loadExcel');


    Route::get('/updateProductWithAjax', 'Admin\ProductController@updateProductWithAjax')->name('admin.product.updateAjaxProduct');

});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin/users-web', 'admin.pages.users.users_web')->name('admin.users.Web');
    Route::view('/admin/user/roles', function () {

        $roles = \Spatie\Permission\Models\Role::all();
        dd($roles);

        return view('admin.pages.users.roles')->with(['roles' => $roles]);

    })->name('admin.users.rol');
    Route::get('/admin/user/roles/create', function () {

        $permissions = \Spatie\Permission\Models\Permission::all();
        return view('admin.pages.users.rol.create')->with(['permissions' => $permissions]);
    })->name('admin.users.rol.create');
    Route::post('/admin/user/roles/create', function (\Illuminate\Http\Request $request) {

        //dd($request->all());

        //$rol = \Spatie\Permission\Models\Role::create(['name' => $request->input('name')]);
        $rol = \Spatie\Permission\Models\Role::find(1);
        $rol->syncPermissions($request->get('permissions'));
        return redirect()->route('admin.users.rol');
    })->name('admin.users.rol.store');

});

/*
 * WEB
 */

Route::get('/login{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('client.login-with')->middleware('guest');
Route::get('/login{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback')->middleware('guest');

// Auth Client
Route::group([], function () {
// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('register.create');
// Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/mi-cuenta', 'Web\MyAccountController@index')->name('web.my.account');
    Route::get('/mi-cuenta/completar-perfil', 'Auth\SocialAuthController@completeProfile')->name('client.complete-profile');
    Route::post('/mi-cuenta/completar-perfil', 'Auth\SocialAuthController@updateProfile');
});

Route::get('/', 'Web\WebController@index')->name('web.home');
Route::get('busca', 'Web\WebController@search')->name('web.home.search');
Route::post('/listSliders', 'Web\WebController@listSliders')->name('web.home.listSliders');

Route::get('carrito', 'Web\CartController@index')->name('web.cart.index');
Route::post('carrito/addProduct', 'Web\CartController@addProduct')->name('web.cart.add.product');
Route::post('carrito/addProductWithQuantify', 'Web\CartController@addProductWithQuantify')->name('web.cart.add.productWithQuantify');
Route::post('carrito/removeProduct', 'Web\CartController@removeProduct')->name('web.cart.remove.product');
Route::post('carrito/removeProductInTable', 'Web\CartController@removeProductInTable')->name('web.cart.remove.productInTable');
Route::post('carrito/removeAllProduct', 'Web\CartController@removeAllProduct')->name('web.cart.remove.allProduct');
Route::post('carrito/updateProduct', 'Web\CartController@updateProduct')->name('web.cart.update.product');
Route::post('carrito/updateIncProduct', 'Web\CartController@updateIncProduct')->name('web.cart.update.incProduct');
Route::post('carrito/updateActual', 'Web\CartController@updateActual')->name('web.cart.update.Actual');
Route::post('carrito/updateDecProduct', 'Web\CartController@updateDecProduct')->name('web.cart.update.decProduct');
Route::post('carrito/review', 'Web\CartController@reviewProduct')->name('web.cart.review.product');

Route::post('cart/coupon-code', 'Web\CuponController@couponCode')->name('web.cart.coupon.store');
Route::delete('cart/coupon-code/destroy', 'Web\CuponController@destroy')->name('web.cart.coupon.destroy');

Route::group(['middleware' => 'auth'], function () {
    Route::get('checkout', 'Web\CheckoutController@index')->name('web.checkout.index');
    Route::post('checkout/store', 'Web\CheckoutController@store')->name('web.checkout.store');
    Route::post('checkout/store/transferencia', 'Web\CheckoutController@storeTransferencia')->name('web.checkout.storeTransferencia');
    Route::post('checkout/searchUrbanization', 'Web\CheckoutController@searchUrbanizationAjax')->name('web.checkout.searchUrbanization');
    Route::get('checkout/confirmation', 'Web\ConfirmationController@index')->name('web.checkout.confirmation');
});

// test mail
//Route::get('checkout/confirmation', 'Web\CheckoutController@testMail')->name('web.checkout.test');

Route::get('tips', 'Web\TipController@index')->name('web.tips.index');
Route::get('tip/{tip}/detalle', 'Web\TipController@detail')->name('web.tips.detail');
Route::get('promociones', 'Web\RecipeController@index')->name('web.recipes.index');
Route::get('promociones/{recipe}/detalle', 'Web\RecipeController@detail')->name('web.recipes.detail');

Route::get('ventas-mayoristas', 'Web\StoreImageController@index')->name('web.storeImage.index');

Route::post('subscriber/store', 'Web\SubscriberController@store')->name('web.subscriber.store');

// routes in footer
Route::group([], function () {
    Route::get('bienvenidos', 'Web\FooterController@welcome')->name('web.footer.welcome');
    Route::get('que-es-mimercado', 'Web\FooterController@queEsMiMercado')->name('web.footer.mimercado');
    Route::get('beneficios', 'Web\FooterController@beneficios')->name('web.footer.beneficios');
    Route::get('como-comprar', 'Web\FooterController@comoComprar')->name('web.footer.comocomprar');
    Route::get('costo-de-envio', 'Web\FooterController@costoDeEnvio')->name('web.footer.costoenvio');
    Route::get('medios-de-pago', 'Web\FooterController@mediosDePago')->name('web.footer.mediopago');
    Route::get('servicio-de-entrega', 'Web\FooterController@servicioDeEntrega')->name('web.footer.serviciosentrega');
    Route::get('terminos-y-condiciones', 'Web\FooterController@terminosYCondiciones')->name('web.footer.terminos');
    Route::get('preguntas-frecuentes', 'Web\FooterController@preguntasFrecuentes')->name('web.footer.preguntasFrecuentes');
    Route::get('contactenos', 'Web\ContactController@index')->name('web.contact.index');
    Route::post('contactenos', 'Web\ContactController@sendMail');
    Route::get('políticas-de-privacidad', 'Web\FooterController@politicasDePrivacidad')->name('web.footer.politicasDePrivacidad');
    Route::get('políticas-de-cookies', 'Web\FooterController@politicasDeCookies')->name('web.footer.politicasDeCookies');
    Route::get('protección-de-datos-personales', 'Web\FooterController@protecciónDatosPersonales')->name('web.footer.protecciónDatosPersonales');
});

Route::get('{slugCategory}', 'Web\CategoryController@searchProductsInCategory')->name('web.search.productsInCategory');
Route::get('{slugCategory}/{slugSubcategory}', 'Web\CategoryController@searchProductsInSubCategory')->name('web.search.productsInSubCategory');
Route::get('{slugCategory}/{slugSubcategory}/{slugProductSubCategory}', 'Web\CategoryController@searchProductsInProductSubCategory')->name('web.search.productsInProductSubCategory');

Route::post('/import-excel/{id}', 'Admin\ProductController@importarExcel')->name('import-excel');
