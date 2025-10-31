<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
|
| Routes for logged in users with a linked dA account.
|
*/

/**************************************************************************************************
    Users
**************************************************************************************************/

Route::group(['prefix' => 'notifications', 'namespace' => 'Users'], function () {
    Route::get('/', 'AccountController@getNotifications');
    Route::get('delete/{id}', 'AccountController@getDeleteNotification');
    Route::post('clear', 'AccountController@postClearNotifications');
    Route::post('clear/{type}', 'AccountController@postClearNotifications');
});

Route::group(['prefix' => 'account', 'namespace' => 'Users'], function () {
    Route::get('settings', 'AccountController@getSettings');
    Route::post('profile', 'AccountController@postProfile');
    Route::post('staff-profile', 'AccountController@postStaffProfile');
    Route::post('staff-links', 'AccountController@postStaffLinks');
    Route::post('theme', 'AccountController@postTheme');
    Route::post('password', 'AccountController@postPassword');
    Route::post('username', 'AccountController@postUsername');
    Route::post('email', 'AccountController@postEmail');
    Route::post('location', 'AccountController@postLocation');
    Route::post('faction', 'AccountController@postFaction');
    Route::post('avatar', 'AccountController@postAvatar');
    Route::post('theme', 'AccountController@postTheme');
    Route::post('username', 'AccountController@postUsername');
    Route::get('aliases', 'AccountController@getAliases');
    Route::get('make-primary/{id}', 'AccountController@getMakePrimary');
    Route::post('make-primary/{id}', 'AccountController@postMakePrimary');
    Route::get('hide-alias/{id}', 'AccountController@getHideAlias');
    Route::post('hide-alias/{id}', 'AccountController@postHideAlias');
    Route::get('remove-alias/{id}', 'AccountController@getRemoveAlias');
    Route::post('remove-alias/{id}', 'AccountController@postRemoveAlias');
    Route::post('dob', 'AccountController@postBirthday');
    Route::post('devlog-notif', 'AccountController@postdevLogNotif');
    Route::post('warning', 'AccountController@postWarningVisibility');
    Route::post('comments', 'AccountController@postProfileComments');

    Route::get('two-factor/confirm', 'AccountController@getConfirmTwoFactor');
    Route::post('two-factor/enable', 'AccountController@postEnableTwoFactor');
    Route::post('two-factor/confirm', 'AccountController@postConfirmTwoFactor');
    Route::post('two-factor/disable', 'AccountController@postDisableTwoFactor');

    Route::get('deactivate', 'AccountController@getDeactivate');
    Route::get('deactivate-confirm', 'AccountController@getDeactivateConfirmation');
    Route::post('deactivate', 'AccountController@postDeactivate');
    Route::post('warning', 'AccountController@postWarningVisibility');
    Route::post('border', 'AccountController@postBorder');
    Route::get('check-border', 'AccountController@getBorderVariants');
    Route::get('check-layers', 'AccountController@getBorderLayers');

    Route::get('bookmarks', 'BookmarkController@getBookmarks');
    Route::get('bookmarks/create', 'BookmarkController@getCreateBookmark');
    Route::get('bookmarks/edit/{id}', 'BookmarkController@getEditBookmark');
    Route::post('bookmarks/create', 'BookmarkController@postCreateEditBookmark');
    Route::post('bookmarks/edit/{id}', 'BookmarkController@postCreateEditBookmark');
    Route::get('bookmarks/delete/{id}', 'BookmarkController@getDeleteBookmark');
    Route::post('bookmarks/delete/{id}', 'BookmarkController@postDeleteBookmark');
});

Route::group(['prefix' => 'inventory', 'namespace' => 'Users'], function () {
    Route::get('/', 'InventoryController@getIndex');
    Route::post('edit', 'InventoryController@postEdit');
    Route::get('account-search', 'InventoryController@getAccountSearch');
    Route::get('full-inventory', 'InventoryController@getFullInventory');
    Route::get('consolidate-inventory', 'InventoryController@getConsolidateInventory');
    Route::post('consolidate', 'InventoryController@postConsolidateInventory');

    Route::get('selector', 'InventoryController@getSelector');
});

Route::group(['prefix' => 'pets', 'namespace' => 'Users'], function () {
    Route::get('/', 'PetController@getIndex');
    Route::post('transfer/{id}', 'PetController@postTransfer');
    Route::post('delete/{id}', 'PetController@postDelete');
    Route::post('name/{id}', 'PetController@postName');
    Route::post('attach/{id}', 'PetController@postAttach');
    Route::post('detach/{id}', 'PetController@postDetach');
    Route::post('variant/{id}', 'PetController@postVariant');
    Route::post('evolution/{id}', 'PetController@postEvolution');

    Route::get('selector', 'PetController@getSelector');
    Route::post('collect/{id}', 'PetController@postClaimPetDrops');
    Route::post('collect-all', 'PetController@postClaimAllPetDrops');
    Route::post('image/{id}', 'PetController@postCustomImage');
    Route::post('description/{id}', 'PetController@postDescription');

    Route::get('view/{id}', 'PetController@getPetPage')->where('id', '[0-9]+');
    Route::post('view/{id}/edit', 'PetController@postEditPetProfile')->where('id', '[0-9]+');

    Route::post('bond/{id}', 'PetController@postBond');
});

Route::group(['prefix' => 'armoury', 'namespace' => 'Users'], function () {
    Route::get('/', 'ArmouryController@getArmoury');
    Route::get('{type}/{id}', 'ArmouryController@getStack');

    Route::post('{type}/transfer/{id}', 'ArmouryController@postTransfer');
    Route::post('{type}/delete/{id}', 'ArmouryController@postDelete');
    Route::post('{type}/name/{id}', 'ArmouryController@postName');
    Route::post('{type}/attach/{id}', 'ArmouryController@postAttach');
    Route::post('{type}/detach/{id}', 'ArmouryController@postDetach');
    Route::post('{type}/upgrade/{id}', 'ArmouryController@postUpgrade');
    Route::post('{type}/image/{id}', 'ArmouryController@postImage');

    Route::get('{type}/selector', 'ArmouryController@getSelector');
});

Route::group(['prefix' => __('safetydeposit.url'), 'namespace' => 'Users'], function () {
    Route::get('/', 'StorageController@getIndex');
    Route::post('withdraw', 'StorageController@postWithdraw');
});

Route::group(['prefix' => 'characters', 'namespace' => 'Users'], function () {
    Route::get('/', 'CharacterController@getIndex');
    Route::post('sort', 'CharacterController@postSortCharacters');
    Route::post('select-character', 'CharacterController@postSelectCharacter');

    Route::post('{slug}/pets/sort', 'CharacterController@postSortCharacterPets');

    Route::get('folder/create', 'CharacterController@getCreateFolder');
    Route::get('folder/edit/{id}', 'CharacterController@getEditFolder');
    Route::post('folder/create', 'CharacterController@postCreateEditFolder');
    Route::post('folder/edit/{id}', 'CharacterController@postCreateEditFolder');
    Route::post('folder/delete/{id}', 'CharacterController@postDeleteFolder');
    Route::get('transfers/{type}', 'CharacterController@getTransfers');
    Route::post('transfer/act/{id}', 'CharacterController@postHandleTransfer');

    Route::get('myos', 'CharacterController@getMyos');

    // CLASS
    Route::get('class/edit/{id}', 'CharacterController@getClassModal');
    Route::post('class/edit/{id}', 'CharacterController@postClassModal');
});

Route::group(['prefix' => __('awards.awardcase'), 'namespace' => 'Users'], function () {
    Route::get('/', 'AwardCaseController@getIndex');
    Route::post('edit', 'AwardCaseController@postEdit');
    Route::post('claim/{id}', 'AwardCaseController@postClaimAward');

    Route::get('selector', 'AwardCaseController@getSelector');
});

Route::group(['prefix' => 'bank', 'namespace' => 'Users'], function () {
    Route::get('/', 'BankController@getIndex');
    Route::post('transfer', 'BankController@postTransfer');
    Route::get('convert/{id}', 'BankController@getConvertCurrency');
    Route::get('convert/{currency_id}/rate/{conversion_id}', 'BankController@getConvertCurrencyRate');
    Route::post('convert', 'BankController@postConvertCurrency');
});

Route::group(['prefix' => 'stats', 'namespace' => 'Users'], function () {
    Route::get('/', 'UserStatController@getIndex');
    Route::post('level', 'UserStatController@postLevel');
    Route::post('transfer', 'UserStatController@postTransfer');
});

Route::group(['prefix' => 'trades', 'namespace' => 'Users'], function () {
    // LISTINGS
    Route::get('listings', 'TradeController@getListingIndex');
    Route::get('listings/expired', 'TradeController@getExpiredListings');
    Route::get('listings/create', 'TradeController@getCreateListing');
    Route::get('listings/{id}', 'TradeController@getListing')->where('id', '[0-9]+');
    Route::get('listings/{id}/edit', 'TradeController@getEditListing')->where('id', '[0-9]+');
    Route::post('listings/create', 'TradeController@postCreateEditListing');
    Route::post('listings/{id}/edit', 'TradeController@postCreateEditListing')->where('id', '[0-9]+');
    Route::post('listings/{id}/expire', 'TradeController@postExpireListing')->where('id', '[0-9]+');

    // TRADES
    Route::get('{status}', 'TradeController@getIndex')->where('status', 'proposals|open|pending|completed|rejected|canceled');
    Route::get('create', 'TradeController@getCreateTrade');
    Route::get('{id}/edit', 'TradeController@getEditTrade')->where('id', '[0-9]+');
    Route::get('proposal/{id?}', 'TradeController@getCreateEditTradeProposal')->where('id', '[0-9]+');
    Route::get('proposal/user/{id}', 'TradeController@getUserTradeProposal')->where('id', '[0-9]+');
    Route::post('create', 'TradeController@postCreateTrade');
    Route::post('{id}/edit', 'TradeController@postEditTrade')->where('id', '[0-9]+');
    Route::post('propose/{id?}', 'TradeController@postCreateEditTradeProposal')->where('id', '[0-9]+');
    Route::post('proposal/{id}/{action}', 'TradeController@postRespondToTradeProposal')->where('id', '[0-9]+')->where('action', 'accept|reject');
    Route::get('{id}', 'TradeController@getTrade')->where('id', '[0-9]+');

    Route::get('{id}/confirm-offer', 'TradeController@getConfirmOffer');
    Route::post('{id}/confirm-offer', 'TradeController@postConfirmOffer');
    Route::get('{id}/confirm-trade', 'TradeController@getConfirmTrade');
    Route::post('{id}/confirm-trade', 'TradeController@postConfirmTrade');
    Route::get('{id}/cancel-trade', 'TradeController@getCancelTrade');
    Route::post('{id}/cancel-trade', 'TradeController@postCancelTrade');
});

Route::group(['prefix' => 'crafting', 'namespace' => 'Users'], function () {
    Route::get('/', 'CraftingController@getIndex');
    Route::get('craft/{id}', 'CraftingController@getCraftRecipe');
    Route::post('craft/{id}', 'CraftingController@postCraftRecipe');
});

/**************************************************************************************************
    Characters
**************************************************************************************************/
Route::group(['prefix' => 'character', 'namespace' => 'Characters'], function () {
    Route::get('{slug}/profile/edit', 'CharacterController@getEditCharacterProfile');
    Route::post('{slug}/profile/edit', 'CharacterController@postEditCharacterProfile');

    Route::post('{slug}/'.__('awards.awardcase').'/edit', 'CharacterController@postAwardEdit');
    Route::post('{slug}/inventory/edit', 'CharacterController@postInventoryEdit');

    Route::get('{slug}/breeding-permissions/new', 'CharacterController@getNewBreedingPermission');
    Route::post('{slug}/breeding-permissions/new', 'CharacterController@postNewBreedingPermission');
    Route::get('{slug}/breeding-permissions/{id}/transfer', 'CharacterController@getTransferBreedingPermission');
    Route::post('{slug}/breeding-permissions/{id}/transfer', 'CharacterController@postTransferBreedingPermission');

    Route::post('{slug}/bank/transfer', 'CharacterController@postCurrencyTransfer');
    Route::get('{slug}/transfer', 'CharacterController@getTransfer');
    Route::post('{slug}/transfer', 'CharacterController@postTransfer');
    Route::post('{slug}/transfer/{id}/cancel', 'CharacterController@postCancelTransfer');

    Route::post('{slug}/approval', 'CharacterController@postCharacterApproval');
    Route::get('{slug}/approval', 'CharacterController@getCharacterApproval');
    Route::get('{slug}/stats', 'CharacterStatController@getStats');
    Route::get('{slug}/stats/{id}', 'CharacterStatController@getStat');
    Route::post('{slug}/stats/{id}/level', 'CharacterStatController@postLevelStat'); // stat level up
    Route::post('{slug}/stats/{id}/count', 'CharacterStatController@postEditStatCurrentCount');
    Route::post('{slug}/stats/{id}/base', 'CharacterStatController@postEditBaseStat');
    Route::post('{slug}/stats/{id}/level-edit', 'CharacterStatController@postEditStatLevel');

    Route::get('{slug}/stats/logs', 'CharacterStatController@getStatLogs');
    Route::post('{slug}/stats/level', 'CharacterStatController@postLevel'); // level up

    // LINKS
    Route::get('{slug}/links/edit', 'CharacterController@getCreateEditCharacterLinks');
    Route::post('{slug}/links/edit', 'CharacterController@postCreateEditCharacterLinks');
    Route::post('{slug}/links/info/{id}', 'CharacterController@postEditCharacterLinkInfo');
    Route::get('{slug}/links/delete/{id}', 'CharacterController@getDeleteCharacterLink');
    Route::post('{slug}/links/delete/{id}', 'CharacterController@postDeleteCharacterLink');
});

// CHARACTER RELATIONSHIPS
Route::post('links/{action}/{id}', 'LinkController@postHandleLink')->where('action', 'accept|reject');

Route::group(['prefix' => 'myo', 'namespace' => 'Characters'], function () {
    Route::get('{id}/profile/edit', 'MyoController@getEditCharacterProfile');
    Route::post('{id}/profile/edit', 'MyoController@postEditCharacterProfile');

    Route::get('{id}/transfer', 'MyoController@getTransfer');
    Route::post('{id}/transfer', 'MyoController@postTransfer');
    Route::post('{id}/transfer/{id2}/cancel', 'MyoController@postCancelTransfer');

    Route::post('{id}/approval', 'MyoController@postCharacterApproval');
    Route::get('{id}/approval', 'MyoController@getCharacterApproval');
    // this is useless but im not sure if we dont include it things will get weird or not
    Route::post('{slug}/approval/{id}', 'CharacterController@postCharacterApprovalSpecificImage');
});
Route::group(['prefix' => 'breeding-permissions', 'namespace' => 'Users'], function () {
    Route::get('/', 'AccountController@getBreedingPermissions');
});

Route::group(['prefix' => 'stats', 'namespace' => 'Users'], function () {
    Route::get('/', 'UserStatController@getIndex');
});

/**************************************************************************************************
    Submissions
**************************************************************************************************/

Route::group(['prefix' => 'gallery'], function () {
    Route::get('submissions/{type}', 'GalleryController@getUserSubmissions')->where('type', 'draft|pending|accepted|rejected');

    Route::post('favorite/{id}', 'GalleryController@postFavoriteSubmission');

    Route::get('submit/{id}', 'GalleryController@getNewGallerySubmission');
    Route::get('submit/character/{slug}', 'GalleryController@getCharacterInfo');
    Route::get('edit/{id}', 'GalleryController@getEditGallerySubmission');
    Route::get('queue/{id}', 'GalleryController@getSubmissionLog');
    Route::post('queue/totals/{id}', 'GalleryController@postSubmissionTotals');
    Route::post('submit', 'GalleryController@postCreateEditGallerySubmission');
    Route::post('edit/{id}', 'GalleryController@postCreateEditGallerySubmission');

    Route::post('collaborator/{id}', 'GalleryController@postEditCollaborator');

    Route::get('archive/{id}', 'GalleryController@getArchiveSubmission');
    Route::post('archive/{id}', 'GalleryController@postArchiveSubmission');
});

Route::group(['prefix' => 'submissions', 'namespace' => 'Users'], function () {
    Route::get('/', 'SubmissionController@getIndex');
    Route::get('new', 'SubmissionController@getNewSubmission');
    Route::get('new/character/{slug}', 'SubmissionController@getCharacterInfo');
    Route::get('new/prompt/{id}', 'SubmissionController@getPromptInfo');
    Route::get('new/form/{id}', 'SubmissionController@getPromptForm');
    Route::get('new/prompt/{id}/requirements', 'SubmissionController@getPromptRequirementInfo');
    Route::post('new', 'SubmissionController@postNewSubmission');
    Route::post('new/{draft}', 'SubmissionController@postNewSubmission')->where('draft', 'draft');
    Route::get('draft/{id}', 'SubmissionController@getEditSubmission');
    Route::post('draft/{id}', 'SubmissionController@postEditSubmission');
    Route::post('draft/{id}/{submit}', 'SubmissionController@postEditSubmission')->where('submit', 'submit');
    Route::post('draft/{id}/delete', 'SubmissionController@postDeleteSubmission');
    Route::post('draft/{id}/cancel', 'SubmissionController@postCancelSubmission');
});

Route::group(['prefix' => 'claims', 'namespace' => 'Users'], function () {
    Route::get('/', 'SubmissionController@getClaimsIndex');
    Route::get('new', 'SubmissionController@getNewClaim');
    Route::post('new', 'SubmissionController@postNewClaim');
    Route::post('new/{draft}', 'SubmissionController@postNewClaim')->where('draft', 'draft');
    Route::get('draft/{id}', 'SubmissionController@getEditClaim');
    Route::post('draft/{id}', 'SubmissionController@postEditClaim');
    Route::post('draft/{id}/{submit}', 'SubmissionController@postEditClaim')->where('submit', 'submit');
    Route::post('draft/{id}/delete', 'SubmissionController@postDeleteClaim');
    Route::post('draft/{id}/cancel', 'SubmissionController@postCancelClaim');
});

Route::group(['prefix' => 'reports', 'namespace' => 'Users'], function () {
    Route::get('/', 'ReportController@getReportsIndex');
    Route::get('new', 'ReportController@getNewReport');
    Route::post('new', 'ReportController@postNewReport');
    Route::get('view/{id}', 'ReportController@getReport');
});

Route::group(['prefix' => 'designs', 'namespace' => 'Characters'], function () {
    Route::get('{type?}', 'DesignController@getDesignUpdateIndex')->where('type', 'draft|pending|approved|rejected');
    Route::get('{id}', 'DesignController@getDesignUpdate');

    Route::get('{id}/comments', 'DesignController@getComments');
    Route::post('{id}/comments', 'DesignController@postComments');

    Route::get('{id}/image', 'DesignController@getImage');
    Route::post('{id}/image', 'DesignController@postImage');

    Route::get('{id}/addons', 'DesignController@getAddons');
    Route::post('{id}/addons', 'DesignController@postAddons');

    Route::get('{id}/traits', 'DesignController@getFeatures');
    Route::post('{id}/traits', 'DesignController@postFeatures');
    Route::get('traits/subtype', 'DesignController@getFeaturesSubtype');
    Route::get('traits/transformation', 'DesignController@getFeaturesTransformation');

    Route::get('{id}/confirm', 'DesignController@getConfirm');
    Route::post('{id}/submit', 'DesignController@postSubmit');

    Route::get('{id}/delete', 'DesignController@getDelete');
    Route::post('{id}/delete', 'DesignController@postDelete');

    Route::get('{id}/cancel', 'DesignController@getCancel');
    Route::post('{id}/cancel', 'DesignController@postCancel');
});

Route::group(['prefix' => 'applications', 'namespace' => 'Users'], function () {
    Route::get('/', 'AdminApplicationController@getIndex');
    Route::get('new', 'AdminApplicationController@getNewApplication');
    Route::post('new', 'AdminApplicationController@postNewApplication')->name('applications.store');
    Route::get('{id}', 'AdminApplicationController@getApplication');
});

/**************************************************************************************************
    Shops
**************************************************************************************************/

Route::group(['prefix' => 'shops'], function () {
    Route::post('buy', 'ShopController@postBuy');
    Route::post('collect', 'ShopController@postCollect');
    Route::get('history', 'ShopController@getPurchaseHistory');
});

/**************************************************************************************************
    Dailies
**************************************************************************************************/

Route::group(['prefix' => __('dailies.dailies')], function () {
    // throttle requests to 1 per ~10 seconds
    Route::middleware('throttle:1,0.16')->group(function () {
        Route::post('{id}', 'DailyController@postRoll');
    });
});

/**************************************************************************************************
    Comments
**************************************************************************************************/
Route::group(['prefix' => 'comments', 'namespace' => 'Comments'], function () {
    Route::post('make/{model}/{id}', 'CommentController@store');
    Route::delete('{comment}', 'CommentController@destroy')->name('comments.destroy')->where('comment', '[0-9]+');
    Route::post('edit/{comment}', 'CommentController@update')->name('comments.update');
    Route::post('{comment}', 'CommentController@reply')->name('comments.reply');
    Route::post('{id}/feature', 'CommentController@feature')->name('comments.feature');
    Route::post('{id}/like/{action}', 'CommentController@like')->name('comments.like');
    Route::get('liked', 'CommentController@getLikedComments');
});

/**************************************************************************************************
    Comments
**************************************************************************************************/
Route::group(['prefix' => 'limits'], function () {
    Route::post('unlock/{id}', 'Admin\LimitController@postUnlockLimits');
});

/**************************************************************************************************
    Higher or Lower
**************************************************************************************************/

Route::group(['prefix' => 'higher-or-lower'], function () {
    Route::get('/', 'HolController@getIndex');

    Route::get('play', 'HolController@playHol');
    Route::post('play/guess', 'HolController@postGuess');
});

Route::group(['prefix' => 'criteria'], function () {
    Route::get('{entity}/{id}', 'CriterionController@getCriterionSelector')->where('entity', 'prompt|gallery');
    Route::get('{entity}/{id}/{entity_id}/{form_id}', 'CriterionController@getCriterionForm')->where('entity', 'prompt|gallery');
    Route::get('{id}', 'CriterionController@getCriterionFormLimited');
    Route::post('rewards/{id}', 'CriterionController@postCriterionRewards');

    Route::get('guide/{id}', 'CriterionController@getCriterionGuide');
});

// unique items
Route::get('adoption-center', 'uniqueitemsController@getItemIndex');
// Define the route for showing a unique item
Route::get('/uniqueitems/{id}', 'uniqueitemsController@show')->name('uniqueitems.adoption-center');
Route::delete('/uniqueitems/{id}', 'uniqueitemsController@destroy')->name('uniqueitems.destroy');

Route::get('adoption-center/create', 'UniqueItemController@getCreateItem');
Route::get('adoption-center/edit/{id}', 'UniqueItemController@getEditItem');
Route::post('adoption-center/create', 'UniqueItemController@postCreateEditItem');
Route::post('adoption-center/edit/{id?}', 'UniqueItemController@postCreateEditItem');
