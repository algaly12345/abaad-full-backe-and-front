'use strict';
$('.search-business-chart').on('keyup',function (){
    let name = $(this).val();
    if (name.length > 0) {
        $.get($('#get-search-business-chart-route').data('action'), {searchValue: name}, (response) => {
            $('.search-result-box').empty().html(response.result);
        })
    }
})
let selectProductSearch = $('.select-business-chart-search');
let productIdsArray = [];
selectProductSearch.on('click', '.select-business-chart-item', function () {
    let productId = $(this).find('.business-chart-id').text();
    if(productIdsArray.indexOf(productId)){
        productIdsArray.push(productId);
        getProductDetails(productIdsArray);
    }


})
function removeSelectedProduct(){
    $('.remove-selected-business-chart').on('click', function () {
        productIdsArray.splice(productIdsArray.indexOf($(this).data('business-chart-id')));
        $(this).closest('.select-business-chart-item').remove();
    });
}
$('.reset-selected-products').on('click',function (){
    productIdsArray = [];
    $('#selected-products').empty();
})

function getProductDetails(productIds){
    $.ajax({
        url: $('#get-multiple-business-chart-details-route').data('action'),
        type: 'GET',
        data: { productIds: productIds },
        beforeSend: function () {
            $("#loading").fadeIn();
        },
        success: function(response) {
            $('#selected-products').empty().html(response.result);
            removeSelectedProduct();
        },
        complete: function () {
            $("#loading").fadeOut();
        },
    });

}

$('.search-business-chart-for-clearance-sale').on('keyup', function () {
    let name = $(this).val();
    $.get($('#get-search-business-chart-for-clearnace-route').data('action'), {searchValue: name}, (response) => {
        $('.search-result-box').empty().html(response.result);
    })
})

let selectClearanceProductSearch = $('.select-clearance-business-chart-search');
let clearanceProductIdsArray = [];
selectClearanceProductSearch.on('click', '.select-clearance-business-chart-item', function () {
    let productId = $(this).find('.business-chart-id').text();
    if (clearanceProductIdsArray.indexOf(productId)) {
        clearanceProductIdsArray.push(productId);
        getClearanceProductDetails(clearanceProductIdsArray);
    }
    checkClearanceProductArray()

})

function removeSelectedClearanceProduct() {
    $('.remove-selected-clearance-business-chart').on('click', function () {
        console.log(clearanceProductIdsArray, $(this).data('business-chart-id'))
        clearanceProductIdsArray.splice(clearanceProductIdsArray.indexOf($(this).data('business-chart-id')));
        $(this).closest('.remove-selected-clearance-parent').remove();
        checkClearanceProductArray()
    });
}

function getClearanceProductDetails(productIds) {
    $.ajax({
        url: $('#get-multiple-clearance-business-chart-details-route').data('action'),
        type: 'GET',
        data: {productIds: productIds},
        beforeSend: function () {
            $("#loading").fadeIn();
        },
        success: function (response) {
            $('#selected-products').empty().html(response.result);
            removeSelectedClearanceProduct();
        },
        complete: function () {
            $("#loading").fadeOut();
        },
    });

}

function checkClearanceProductArray() {
    if (clearanceProductIdsArray?.length > 0) {
        $('.search-and-add-business-chart').hide();
    } else {
        $('.search-and-add-business-chart').show();
    }
}

$(document).ready(function() {
    const $selectedProductsContainer = $('#selected-products');
    const $addProductsBtn = $('#add-products-btn');
    function toggleAddProductsButton() {
        $addProductsBtn.prop('disabled', $selectedProductsContainer.children().length === 0);
    }

    toggleAddProductsButton();

    const observer = new MutationObserver(toggleAddProductsButton);
    observer.observe($selectedProductsContainer[0], { childList: true });
});
